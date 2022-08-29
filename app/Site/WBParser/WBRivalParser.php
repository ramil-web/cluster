<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser;

use App\Models\WBParser\WBBaseProduct;
use App\Models\WBParser\WBCategory;
use App\Models\WBParser\WBCity;
use App\Models\WBParser\WBProduct;
use App\Models\WBParser\WBProductParsingItem;
use App\Models\WBParser\WBRivalProduct;
use Carbon\Carbon;
use DB;
use Log;
use DiDom\Document;

class WBRivalParser
{

    // ID категории парсинга
    protected $category_id;

    // Название категории парсинга
    protected $category_title;

    // Кол-во страниц с которых мы снимаем всю инфу
    protected $full_data_stop_page = 0;

    // Кол-во страниц с которых мы снимаем инфу по указанным брендам
    protected $parsing_stop_page = 0;

    // Дата парсинга
    protected $parsing_time;

    // Категория для парсинга Главная » Женщинам » Белье https://www.wildberries.ru/catalog/zhenshchinam/bele
    protected $parsing_url = 'https://www.wildberries.ru/catalog/zhenshchinam/bele';

    // Куки города -Москва-
    protected $parsing_city_cookie = "__wbl=cityId%3D77%26regionId%3D77%26city%3D%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%26phone%3D84957755505%26latitude%3D55%2C7247%26longitude%3D37%2C7882;";
//    protected $parsing_city_cookie = "__wbl=cityId%3D5761%26regionId%3D63%26city%3D%D0%A2%D0%BE%D0%BB%D1%8C%D1%8F%D1%82%D1%82%D0%B8%26phone%3D88462151250%26latitude%3D53%2C510113%26longitude%3D49%2C415765;";
//    protected $parsing_city_cookie = "__wbl=cityId%3D3898%26regionId%3D27%26city%3D%D0%A5%D0%B0%D0%B1%D0%B0%D1%80%D0%BE%D0%B2%D1%81%D0%BA%26phone%3D88001007505%26latitude%3D48%2C468976%26longitude%3D135%2C064909;";

    protected $parsing_categories = array(

        array(
            'id'                   => 1,
            'title'                => 'Женское белье(Главная » Женщинам » Белье)',
            'full_data_stop_page'  => 10,
            'parsing_stop_page'    => 100,
            'parsing_url'          => 'https://www.wildberries.ru/catalog/zhenshchinam/bele',
            'parsing_city_cookie'  => "__wbl=cityId%3D77%26regionId%3D77%26city%3D%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%26phone%3D84957755505%26latitude%3D55%2C7247%26longitude%3D37%2C7882;",
            'parsing_rivals_sizes' => 1,
        ),
    );

    // Бренды для парсинга
    protected $parsing_rivals = array(
        array(
            'id'       => 1,
            'brand'    => 'Rose&Petal',
            'position' => 20,
        ),
        array(
            'id'       => 2,
            'brand'    => 'Infinity Lingerie',
            'position' => 1,
        ),
        array(
            'id'       => 3,
            'brand'    => 'Vis-a-vis',
            'position' => 2,
        ),
        array(
            'id'       => 4,
            'brand'    => 'CONTE Elegant',
            'position' => 3,
        ),
        array(
            'id'       => 5,
            'brand'    => 'Incanto',
            'position' => 4,
        ),
        array(
            'id'       => 6,
            'brand'    => 'Dea Fiori',
            'position' => 5,
        ),
        array(
            'id'       => 7,
            'brand'    => 'Дефиле',
            'position' => 16,
        ),
        array(
            'id'       => 8,
            'brand'    => 'Teyli',
            'position' => 17,
        ),
        array(
            'id'       => 9,
            'brand'    => 'FELINA',
            'position' => 18,
        ),
        array(
            'id'       => 10,
            'brand'    => 'ROSME',
            'position' => 19,
        ),
    );

    public function __construct()
    {
        $this->parsing_rivals = collect($this->parsing_rivals)->recursive();

        $this->set_current_category();
    }

    /**
     *
     *
     * @return  mixed
     */
    public function set_current_category()
    {
        foreach ($this->parsing_categories as $category) {

            $category = collect($category);

            try {

                Log::channel('parser_wb_rival')->info('Устанавливаем категорию - ' . $category->get('title'));

                $this->category_id         = $category->get('id');
                $this->category_title      = $category->get('title');
                $this->full_data_stop_page = $category->get('full_data_stop_page');
                $this->parsing_stop_page   = $category->get('parsing_stop_page');
                $this->parsing_url         = $category->get('parsing_url');
                $this->parsing_city_cookie = $category->get('parsing_city_cookie');
                $this->parsing_time        = Carbon::now()->format('Y-m-d H:i:s');

                $this->parsing();

                if ($category->get('parsing_rivals_sizes')) {
                    $this->parsing_rivals_sizes();
                    WBRivalProduct::whereDate('parsed_at', Carbon::today())->get();
                }


            } catch (\Throwable $ex) {

                Log::channel('parser_wb_rival')->critical('Ошибка категории - ' . collect($category)->toJson() . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
            }
        }

        Log::channel('parser_wb_rival')->info('Конец парсинга');
    }


    /**
     * Парсер
     *
     * @return  mixed
     */
    public function parsing()
    {
        try {

            /**
             *
             * @var $parsing_rivals\Illuminate\Support\Collection
             */
            $parsing_rivals      = $this->parsing_rivals;
            $parsing_city_cookie = $this->parsing_city_cookie;
            $parsing_url         = $this->parsing_url;
            $parsing_stop_page   = $this->parsing_stop_page;
            $full_data_stop_page = $this->full_data_stop_page;

            $offset = 0;
            $limit  = 1000;

            $page_counter              = 1;
            $category_products_counter = 1;
            $stop_parsing              = false;

            while (!$stop_parsing) {

                // Если спарсили запланированное кол-во страниц, завершаем
                if ($page_counter > $parsing_stop_page) {

                    $stop_parsing = true;
                    continue;
                }

                $cards = collect();

                if ($page_counter > 1) {

                    $full_parsing_url = $parsing_url . "?page=" . $page_counter;

                } else {

                    $full_parsing_url = $parsing_url . "?pagesize=100";
                }

                $result_page         = $this->get_web_page($full_parsing_url, $parsing_city_cookie);
                $result_page_content = $result_page['content'];


                if ($result_page_content) {

                    // https://github.com/Imangazaliev/DiDOM/blob/master/README-RU.md
                    $category_document = new Document($result_page_content);
                    $cards             = $category_document->find('.j-card-item');

                } else {

                    Log::channel('parser_wb_rival')->critical('Не получен контент страницы категории - ' . $full_parsing_url);
                }

                if ((count($cards) > 0)) {

                    $card_data   = array();
                    $cards_array = array();

                    foreach ($cards as $card) {

                        try {

                            $brand_name = null;
                            $now        = Carbon::now()->format('Y-m-d H:i:s');

                            $card_data = array(
                                'nmId'           => null,
                                'category_id'    => $this->category_id,
                                'category_place' => $category_products_counter,
                                'brand_name'     => null,
                                'lower_price'    => null,
                                'old_price'      => null,
                                'price_sale'     => null,
                                'comments_count' => null,
                                'stars_count'    => null,
                                'parsed_at'      => $this->parsing_time,
                                'created_at'     => $now,
                                'updated_at'     => $now,
                            );

                            $card_data['nmId'] = $card->getAttribute('data-popup-nm-id');

                            $card_brand_name = $card->first('.brand-name');

                            if ($card_brand_name) {

                                $brand_name = $card_data['brand_name'] = trim(str_replace('/', '', $card_brand_name->text()));
                            }

                            $card_lower_price = $card->first('.lower-price');

                            if ($card_lower_price) {
                                // "Убиваем" "неубиваемые пробелы" '&nbsp;' ...
                                $card_lower_price = $card_lower_price->text();
                                $card_lower_price = str_replace(["₽", ' '], [''], $card_lower_price);
                                $card_lower_price = utf8_decode($card_lower_price);
                                $card_lower_price = trim(str_replace(["\xA0"], [''], $card_lower_price));

                                $card_data['lower_price'] = $card_lower_price;
                            }

                            $card_old_price = $card->first('.price-old-block');


                            if ($card_old_price) {
                                // Процент скидки
                                $card_price_sale_tag = $card_old_price->first('.price-sale');

                                // "Старая" цена
                                $card_old_price_tag = $card_old_price->first('del');


                                if ($card_old_price_tag) {

                                    // "Убиваем" "неубиваемые пробелы" '&nbsp;' ...
                                    $card_old_price = $card_old_price_tag->text();
                                    $card_old_price = str_replace(["₽", ' '], [''], $card_old_price);
                                    $card_old_price = utf8_decode($card_old_price);
                                    $card_old_price = trim(str_replace(["\xA0"], [''], $card_old_price));

                                    $card_data['old_price'] = $card_old_price;
                                }

                                if ($card_price_sale_tag) {

                                    $price_sale = str_replace(["-", '%', ' '], [''], $card_price_sale_tag->text());;

                                    $card_data['price_sale'] = intval($price_sale);
                                }
                            }

                            $card_comments_count = $card->first('.dtList-comments-count');

                            if ($card_comments_count) {

                                $card_comments_count = $card_comments_count->text();

                                $card_data['comments_count'] = intval($card_comments_count);
                            }

                            $stars = array(
                                0 => $card->first('.j-stars.star0'),
                                1 => $card->first('.j-stars.star1'),
                                2 => $card->first('.j-stars.star2'),
                                3 => $card->first('.j-stars.star3'),
                                4 => $card->first('.j-stars.star4'),
                                5 => $card->first('.j-stars.star5'),
                            );

                            foreach ($stars as $key => $star) {
                                if ($star) {

                                    $card_data['stars_count'] = $key;

                                    break;
                                }
                            }

                            $is_brand = $parsing_rivals->where('brand', $brand_name)->first();

                            if (($full_data_stop_page >= $page_counter) || $is_brand) {

                                $cards_array[] = $card_data;
                            }

                            $category_products_counter++;


                        } catch (\Throwable $ex) {

                            Log::channel('parser_wb_rival')->critical('Ошибка разбора карточки - ' . collect($card_data)->toJson() . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
                        }
                    }

                    if (count($cards_array)) {

                        DB::table("w_b_rival_products")->insert(
                            $cards_array
                        );
                    }

                    $aaa = 0;

                } else {

                    Log::channel('parser_wb_rival')->info('Конец парсера. Страница - ' . $page_counter);

                    $stop_parsing = true;
                }

                Log::channel('parser_wb_rival')->info('Итерация парсера. Страница - ' . $page_counter);
                $page_counter++;
            }

            Log::channel('parser_wb_rival')->info('Конец парсинга категории - ' . $this->category_title);

        } catch (\Throwable $ex) {

            Log::channel('parser_wb_rival')->critical('Ошибка категории - ' . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
        }
    }

    /**
     * Парсер размеров
     *
     * @return  mixed
     */
    public function parsing_rivals_sizes()
    {
        Log::channel('parser_wb_rival')->info('Начало импорта размеров');

        try {

            $parsing_city_cookie = $this->parsing_city_cookie;
            // Образец 'https://www.wildberries.ru/catalog/4228163/detail.aspx'
            $page_url_start = 'https://www.wildberries.ru/catalog/';
            $page_url_end   = '/detail.aspx';
            $offset         = 0;
            $limit          = 500;
            $stop_parsing   = false;

            while (!$stop_parsing) {

                Log::channel('parser_wb_rival')->info('Итерация импорта размеров(offset) - ' . $offset);

                /**
                 * @var $rivals_products WBRivalProduct[]| \Illuminate\Support\Collection | bool
                 */
                $rivals_products = WBRivalProduct::whereDate('parsed_at', Carbon::today())->offset((int)$offset)->limit((int)$limit)->get();

                if (!$rivals_products->count()) {

                    $stop_parsing   = true;

                }else{

                    foreach ($rivals_products as $key => $product) {

                        $product_sizes   = array();

                        try {
                            $page_url_full = $page_url_start . $product->getNmId() . $page_url_end;

                            $result_page         = $this->get_web_page($page_url_full, $parsing_city_cookie);
                            $result_page_content = $result_page['content'];

                            if ($result_page_content) {

                                // https://github.com/Imangazaliev/DiDOM/blob/master/README-RU.md
                                $category_document = new Document($result_page_content);

                                // TODO Проблема, загружается JS!!!
//                            $orders_count = $category_document->first('.j-orders-count');

//                            if ($orders_count) {
//                                $aaa = $orders_count->text();
//                                $aaa = 0;
//                            }

                                $size_list = $category_document->find('.size-list .j-size');

                                if ($size_list) {

                                    foreach ($size_list as $size) {

                                        $size_name    = $size->getAttribute('data-size-name');
                                        $size_classes = $size->attr('class');
                                        $pos_disabled = strpos($size_classes, 'disabled');

                                        $arr = array(
                                            't' => $size_name,
                                            'd' => false,
                                        );

                                        if ($pos_disabled) {

                                            $arr['d'] = true;
                                        }

                                        $product_sizes[] = $arr;
                                    }

                                    /**
                                     * @var $product_sizes \Illuminate\Support\Collection
                                     */
                                    $product_sizes = collect($product_sizes)->recursive();

                                    $product->sizes = $product_sizes->toJson();
                                }

                                $product->save();

                                $aaa = 0;

                            } else {

                                Log::channel('parser_wb_rival')->critical('Не получен контент страницы товара - ' . $page_url_full);
                            }

                        } catch (\Throwable $ex) {

                            Log::channel('parser_wb_rival')->critical('Ошибка разбора страницы товара - NMID - ' . $product->getNmId() . $ex->getFile() . '; - ' . $ex->getLine() . '; - ' . $ex->getMessage());
                        }
                    }

                    $offset += $limit;
                }

                $aaa = 0;
            }

            Log::channel('parser_wb_rival')->info('Конец импорта размеров');

        } catch (\Throwable $ex) {

            Log::channel('parser_wb_rival')->critical('Ошибка товара2 - ' . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
        }
    }

    /**
     * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
     * array containing the HTTP server response header fields and content.
     */
    function get_web_page($url, $city)
    {

        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36';

        $options = array(

//            CURLOPT_PROXY  => $proxy,
            CURLOPT_CUSTOMREQUEST  => "GET",        //set request type post or get
            CURLOPT_POST           => false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent,  //set user agent
            CURLOPT_COOKIEFILE     => public_path('wb_parser/cookie.txt'), //set cookie file
            CURLOPT_COOKIEJAR      => public_path('wb_parser/cookie.txt'), //set cookie jar
            CURLOPT_COOKIE         => $city,
            CURLOPT_RETURNTRANSFER => true,         // return web page 91.199.197.118	8080
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => true,         // follow redirects
            CURLOPT_ENCODING       => "",           // handle all encodings
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
            CURLOPT_TIMEOUT        => 120,          // timeout on response
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);
        curl_close($ch);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;

        return $header;
    }
    //____________________WB Парсер
}
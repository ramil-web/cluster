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
use Carbon\Carbon;
use DB;
use Log;
use DiDom\Document;

class WBBaseParser
{
    protected $parsing_time;

    /**
     * @var $wb_categories WBCategory[]| \Illuminate\Support\Collection | bool
     */
    protected $wb_categories;

    /**
     * @var $wb_cities WBCity[]| \Illuminate\Support\Collection | bool
     */
    protected $wb_cities;

    /**
     * @var $products_categories [] | \Illuminate\Support\Collection | bool
     */
    protected $products_categories;

    protected $current_category;

    protected $base_search_url = "https://www.wildberries.ru/catalog/0/search.aspx?search=";

    public function __construct()
    {
        DB::update('UPDATE `w_b_products` SET `parser_history`=null');

        $this->parsing_time  = Carbon::now()->format('Y-m-d H:i:s');
        $this->wb_categories = WBCategory::get();
        $this->wb_cities     = WBCity::get();

        $this->products_categories = WBProduct::pluck('subject')->unique();

        $this->set_current_category();

        $this->parsing_items_create();
    }

    /**
     *
     *
     * @return  mixed
     */
    public function set_current_category()
    {
        try {

            $stop = false;

            Log::channel('parser_wb')->info('Старт парсера');

            while (!$stop) {

                foreach ($this->products_categories as $category) {

                    $this->current_category = $category;

                    $res = $this->parsing();
                }

                $stop = true;
            }

            Log::channel('parser_wb')->info('Конец парсера');

        } catch (\Exception $ex) {

            Log::channel('parser_wb')->critical('Ошибка категории - ' . $ex);
        }
    }


    /**
     * Парсер
     *
     * @return  mixed
     */
    public function parsing()
    {
        try {

            $current_category = $this->current_category;

            if (!$this->current_category) {

                Log::channel('parser_wb')->critical('Не установлена категория.');

                return false;
            }

            Log::channel('parser_wb')->info('Установлена категория ________________________: ' . $this->current_category);


            /**
             * @var $wb_category WBCategory | bool
             */
            $wb_category = $this->wb_categories->where('title', $current_category)->first();

            if (!$wb_category) {

                Log::channel('parser_wb')->critical('!!!Не найдена категория WB!!!');

                return false;
            }

            $wb_category_url = false;
            $wb_search_url   = false;

            if ($wb_category->getUrl()) {

                // URL для поиска в выдаче категории
                $wb_category_url = $wb_category->getUrl();
            }

            if ($wb_category->getSearch() && $this->base_search_url) {

                // Слово для поиска
                $wb_search_word = $wb_category->getSearch();

                // URL для поиска в поисковой выдаче
                $wb_search_url = $this->base_search_url . urlencode($wb_search_word);
            }

            $now    = $this->parsing_time;
            $stop   = false;
            $offset = 0;
            $limit  = 1000;

            while (!$stop) {

                Log::channel('parser_wb')->info('Итерация верхнего уровня offset - ' . $offset);

//                $products_by_category          = WBProduct::where('subject', $current_category)->orderBy('quantity', 'desc')->offset((int)$offset)->limit((int)$limit)->get();
                $products_by_category          = WBProduct::where('subject', $current_category)->offset((int)$offset)->limit((int)$limit)->get();
                $products_grouped_by_warehouse = $products_by_category->groupBy('warehouseName');
                $result_products               = collect();

                /**
                 * @var $products_groupe  WBProduct[]| \Illuminate\Support\Collection | bool
                 */
                foreach ($products_grouped_by_warehouse as $warehouse_name => $products_groupe) {

                    Log::channel('parser_wb')->info('Итерация в группах по складам, склад - ' . $warehouse_name . '; Кол-во в группе - ' . $products_groupe->count());

                    /**
                     * @var $wb_city WBCity | bool
                     */
                    $wb_city = $this->wb_cities->where('stock', $warehouse_name)->first();

                    if ($wb_city) {

                        $wb_city_cookie = $wb_city->getCookie();
                    } else {

                        $wb_city_cookie = '';
                        Log::channel('parser_wb')->critical('Не найден склад - << ' . $warehouse_name . ' >>;');
                    }

                    $products_wb_ids = $products_groupe->pluck('nmId')->unique();

                    // Создаем из массива коллекцию
                    $wb_ids_as_collection = collect($products_wb_ids);

                    // WB ids для категорий(Делаем ключами значения)
                    $wb_ids_for_category = $wb_ids_as_collection->flip();

                    // WB ids для выдачи(Делаем ключами значения)
                    $wb_ids_for_search = $wb_ids_as_collection->flip();

                    $page_counter             = 1;
                    $category_product_counter = 1;
                    $search_product_counter   = 1;
                    $stop_category            = false;
                    $stop_search              = false;
                    $stop_parsing             = false;

                    while (!$stop_parsing) {

                        $category_cards = collect();
                        $search_cards   = collect();

                        if ($page_counter > 1) {

                            $full_category_url = $wb_category_url . "?page=" . $page_counter;
                            $full_search_url   = $wb_search_url . "&page=" . $page_counter;

                        } else {

                            $full_category_url = $wb_category_url . "?pagesize=100";
                            $full_search_url   = $wb_search_url . "&pagesize=100";
                        }


                        if (!$stop_category) {

                            $result_category_page         = $this->get_web_page($full_category_url, $wb_city_cookie);
                            $result_category_page_content = $result_category_page['content'];


                            if ($result_category_page_content) {

                                $category_document = new Document($result_category_page_content);
                                $category_cards    = $category_document->find('.j-card-item');

                            } else {

                                Log::channel('parser_wb')->critical('Не получен контент страницы категории - ' . $full_category_url);
                            }
                        }

                        if ((count($category_cards) > 0) && ($wb_ids_for_category->count() > 0)) {

                            foreach ($category_cards as $card) {

                                $card_wb_id = $card->getAttribute('data-popup-nm-id');

                                $card_data = array(
                                    'lower_price'    => null,
                                    'old_price'      => null,
                                    'price_sale'     => null,
                                    'comments_count' => null,
                                    'stars_count'    => null,
                                );

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

                                $wb_id = $wb_ids_for_category->get($card_wb_id);

                                if (!is_null($wb_id)) {

                                    $result_product = $result_products
                                        ->where('warehouseName', $warehouse_name)
                                        ->where('nmId', $card_wb_id)
                                        ->first();

                                    if (!$result_product) {

                                        $result_product = collect(
                                            array(
                                                'nmId'           => $card_wb_id,
                                                'warehouseName'  => $warehouse_name,
                                                'category'       => $wb_category->getTitle(),
                                                'category_place' => $category_product_counter,
                                                'lower_price'    => $card_data['lower_price'],
                                                'old_price'      => $card_data['old_price'],
                                                'price_sale'     => $card_data['price_sale'],
                                                'comments_count' => $card_data['comments_count'],
                                                'stars_count'    => $card_data['stars_count'],
                                            )
                                        );

                                        $result_products->push($result_product);

                                    } else {

                                        $result_product->put('category', $wb_category->getTitle());
                                        $result_product->put('category_place', $category_product_counter);
                                        $result_product->put('lower_price', $card_data['lower_price']);
                                        $result_product->put('old_price', $card_data['old_price']);
                                        $result_product->put('price_sale', $card_data['price_sale']);
                                        $result_product->put('comments_count', $card_data['comments_count']);
                                        $result_product->put('stars_count', $card_data['stars_count']);
                                    }

                                    $wb_ids_for_category->forget($card_wb_id);
                                }

                                $category_product_counter++;
                            }
                        } else {

                            $stop_category = true;
                        }

                        if (!$stop_search) {

                            $result_search_page         = $this->get_web_page($full_search_url, $wb_city_cookie);
                            $result_search_page_content = $result_search_page['content'];

                            if ($result_search_page_content) {

                                $search_document = new Document($result_search_page_content);
                                $search_cards    = $search_document->find('.j-card-item');

                            } else {

                                Log::channel('parser_wb')->critical('Не получен контент поисковой страницы - ' . $full_search_url);
                            }
                        }

                        if ((count($search_cards) > 0) && ($wb_ids_for_search->count() > 0)) {

                            foreach ($search_cards as $card) {

                                $card_wb_id = $card->getAttribute('data-popup-nm-id');

                                $card_data = array(
                                    'lower_price'    => null,
                                    'old_price'      => null,
                                    'price_sale'     => null,
                                    'comments_count' => null,
                                    'stars_count'    => null,
                                );

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

                                $wb_id = $wb_ids_for_search->get($card_wb_id);

                                if (!is_null($wb_id)) {

                                    $result_product = $result_products
                                        ->where('warehouseName', $warehouse_name)
                                        ->where('nmId', $card_wb_id)
                                        ->first();

                                    if (!$result_product) {

                                        $result_product = collect(
                                            array(
                                                'nmId'           => $card_wb_id,
                                                'warehouseName'  => $warehouse_name,
                                                'search'         => $wb_category->getSearch(),
                                                'search_place'   => $search_product_counter,
                                                'lower_price'    => $card_data['lower_price'],
                                                'old_price'      => $card_data['old_price'],
                                                'price_sale'     => $card_data['price_sale'],
                                                'comments_count' => $card_data['comments_count'],
                                                'stars_count'    => $card_data['stars_count'],
                                            )
                                        );

                                        $result_products->push($result_product);

                                    } else {

                                        $result_product->put('search', $wb_category->getSearch());
                                        $result_product->put('search_place', $search_product_counter);
                                        $result_product->put('lower_price', $card_data['lower_price']);
                                        $result_product->put('old_price', $card_data['old_price']);
                                        $result_product->put('price_sale', $card_data['price_sale']);
                                        $result_product->put('comments_count', $card_data['comments_count']);
                                        $result_product->put('stars_count', $card_data['stars_count']);
                                    }

                                    $wb_ids_for_search->forget($card_wb_id);
                                }

                                $search_product_counter++;
                            }
                        } else {

                            $stop_search = true;
                        }

                        $page_counter++;

                        if ($stop_category && $stop_search) {

                            Log::channel('parser_wb')->info('Итерация парсера');

                            $stop_parsing = true;
                        }

                        $aaa = 0;
                    }

                    $aaa = 0;
                }

                $aaa = 0;

                Log::channel('parser_wb')->info('Старт обновления товаров WB в БД');

                /**
                 * @var  $wb_product WBProduct
                 */
                foreach ($products_by_category as $wb_product) {

                    $parser_history = $wb_product->getParserHistory();

                    if (!$parser_history) {

                        $parser_history = array();

                    } else {

                        $parser_history = json_decode($parser_history);
                    }

                    $result_product = $result_products
                        ->where('warehouseName', $wb_product->getWarehouseName())
                        ->where('nmId', $wb_product->getNmId())
                        ->first();

                    if ($result_product) {

                        $arr = array(
                            'date'           => $now,
                            'nmId'           => $wb_product->getNmId(),
                            'warehouseName'  => $wb_product->getWarehouseName(),
                            'q'              => $wb_product->getQuantity(),
                            'qf'             => $wb_product->getQuantityFull(),
                            'qnio'           => $wb_product->getQuantityNotInOrders(),
                            'iwtc'           => $wb_product->getInWayToClient(),
                            'iwfc'           => $wb_product->getInWayFromClient(),
                            'category'       => $wb_category->getTitle(),
                            'category_place' => $result_product->get('category_place', null),
                            'search'         => $wb_category->getSearch(),
                            'search_place'   => $result_product->get('search_place', null),
                            'lower_price'    => $result_product->get('lower_price', null),
                            'old_price'      => $result_product->get('old_price', null),
                            'price_sale'     => $result_product->get('price_sale', null),
                            'comments_count' => $result_product->get('comments_count', null),
                            'stars_count'    => $result_product->get('stars_count', null),
                        );

                        $wb_product->category_pars_new = $result_product->get('category_place', null);
                        $wb_product->category_pars_old = $wb_product->getCategoryParsNew();
                        $wb_product->search_pars_new   = $result_product->get('search_place', null);
                        $wb_product->search_pars_old   = $wb_product->getSearchParsNew();

                    } else {
                        $aaa = 0;

                        $arr = array(
                            'date'           => $now,
                            'nmId'           => $wb_product->getNmId(),
                            'warehouseName'  => $wb_product->getWarehouseName(),
                            'q'              => $wb_product->getQuantity(),
                            'qf'             => $wb_product->getQuantityFull(),
                            'qnio'           => $wb_product->getQuantityNotInOrders(),
                            'iwtc'           => $wb_product->getInWayToClient(),
                            'iwfc'           => $wb_product->getInWayFromClient(),
                            'category'       => $wb_category->getTitle(),
                            'category_place' => null,
                            'search'         => $wb_category->getSearch(),
                            'search_place'   => null,
                            'lower_price'    => null,
                            'old_price'      => null,
                            'price_sale'     => null,
                            'comments_count' => null,
                            'stars_count'    => null,
                        );

                        $wb_product->category_pars_new = null;
                        $wb_product->category_pars_old = $wb_product->getCategoryParsNew();
                        $wb_product->search_pars_new   = null;
                        $wb_product->search_pars_old   = $wb_product->getSearchParsNew();
                    }

                    $parser_history[] = $arr;
                    $parser_history   = collect($parser_history)->toJson();

                    Log::channel('parser_wb_data')->info(collect($arr)->toJson());

                    $wb_product->parser_history = $parser_history;
                    $wb_product->save();
                }

                Log::channel('parser_wb')->info('Окончание обновления товаров WB в БД');

                $offset += $limit;

                if (!$products_by_category->count()) {

                    $stop = true;
                }

                $aaa = 0;
            }

            Log::channel('parser_wb')->info('Конец итераций верхнего уровня offset - ' . $offset);

        } catch (\Exception $ex) {

            Log::channel('parser_wb')->critical('Ошибка категории - ' . $ex);
        }
    }


    /**
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function parsing_items_create()
    {
        try {

            Log::channel('parser_wb')->info('Создание ________________________: parsingItem');

            $stop   = false;
            $limit  = 500;
            $offset = 0;

            while (!$stop) {

                $base_products = WBBaseProduct::with('wb_products')->limit($limit)->offset($offset)->get();

                if ($base_products->count()) {

                    foreach ($base_products as $base_product) {

                        $wb_products                    = $base_product->wb_products;
                        $wb_products_group_by_warehouse = $wb_products->groupBy('warehouseName');

                        /**
                         * @var $warehouse WBProduct[]| \Illuminate\Support\Collection | bool
                         */
                        foreach ($wb_products_group_by_warehouse as $warehouse_name => $warehouse) {

                            $parsing_collection = $warehouse->pluck('parsing');

                            $parsing_collection_collapsed = $parsing_collection->collapse();

                            $parsing_collection_group_by_date = $parsing_collection_collapsed->groupBy('date');

                            /**
                             * @var $parsing_collection \Illuminate\Support\Collection
                             */
                            foreach ($parsing_collection_group_by_date as $date => $parsing_collection) {

                                /**
                                 * @var $first \Illuminate\Support\Collection
                                 */
                                $first = $parsing_collection->first();

                                $formated_date = (Carbon::createFromFormat('Y-m-d H:i:s', $date))->toRfc3339String();

                                $nmId                = $first->get('nmId', 00000000);
                                $warehouseName       = $warehouse_name ? $warehouse_name : 'Склад не указан';
                                $quantity            = $parsing_collection->sum('q');
                                $quantityFull        = $parsing_collection->sum('qf');
                                $quantityNotInOrders = $parsing_collection->sum('qnio');
                                $inWayToClient       = $parsing_collection->sum('iwtc');
                                $inWayFromClient     = $parsing_collection->sum('iwfc');
                                $category_place      = $first->get('category_place', '');
                                $search_place        = $first->get('search_place', '');
                                $category_title      = $first->get('category', '');
                                $search_word         = $first->get('search', '');
                                $lower_price         = $first->get('lower_price', null);
                                $old_price           = $first->get('old_price', null);
                                $price_sale          = $first->get('price_sale', null);
                                $comments_count      = $first->get('comments_count', null);
                                $stars_count         = $first->get('stars_count', null);
                                $date_rfc3339        = $formated_date;

                                $arr = array(
                                    'nmId'                => $nmId,
                                    'warehouseName'       => $warehouseName,
                                    'quantity'            => $quantity,
                                    'quantityFull'        => $quantityFull,
                                    'quantityNotInOrders' => $quantityNotInOrders,
                                    'inWayToClient'       => $inWayToClient,
                                    'inWayFromClient'     => $inWayFromClient,
                                    'category_place'      => $category_place,
                                    'search_place'        => $search_place,
                                    'category_title'      => $category_title,
                                    'search_word'         => $search_word,
                                    'date_rfc3339'        => $date_rfc3339,
                                    'lower_price'         => $lower_price,
                                    'old_price'           => $old_price,
                                    'price_sale'          => $price_sale,
                                    'comments_count'      => $comments_count,
                                    'stars_count'         => $stars_count,
                                );

                                WBProductParsingItem::create(
                                    $arr
                                );

                                $aaa = 0;
                            }
                        }
                    }

                    $aaa = 0;

                    Log::channel('parser_wb')->info('Итерация : parsingItem');
                    $offset += $limit;

                } else {

                    $stop = true;
                }
            }

            Log::channel('parser_wb')->info('Конец : parsingItem');

        } catch (\Exception $ex) {

            Log::channel('parser_wb')->critical('Ошибка -Создание parsingItem- ' . $ex);

            throw $ex;
        }
    }


    /**
     * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
     * array containing the HTTP server response header fields and content.
     */
    function get_web_page($url, $city)
    {
//        $proxy = '188.65.237.46:49733'; // MSK
//        $proxy = '109.167.249.41:4145'; // SPB
//        $proxy = '212.220.105.48:80'; // Yekaterinburg
        //$proxy = '62.106.122.90:36535'; //put your proxy here

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
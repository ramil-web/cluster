<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser;

use App\Models\WBParser\WBBaseProduct;
use App\Models\WBParser\WBOrder;
use App\Models\WBParser\WBProduct;
use App\Models\WBParser\WBQuantityHistory;
use App\Models\WBParser\WBSale;
use App\Models\WBParser\WBSupply;
use Carbon\Carbon;
use DB;
use Log;
use Session;

class WBImport
{
    protected $start_import = false;
//    protected $start_import = true;
    protected $current_date = "2017-03-25T21%3A00%3A00.000Z";
    protected $key = false;

    protected $import_arrays = array(

        array(
            "id"               => 1,
            "title"            => "Склад",
            "alias"            => "WBStock",
            "table"            => "w_b_products",
            "model"            => WBProduct::class,
            "url"              => "https://suppliers-stats.wildberries.ru/api/v1/supplier/stocks?",
            "flag"             => 0,
            "import"           => 1,
            "support_truncate" => 1,
        ),

        array(
            "id"               => 2,
            "title"            => "Поставки",
            "alias"            => "WBSupplies",
            "table"            => "w_b_supplies",
            "model"            => WBSupply::class,
            "url"              => "https://suppliers-stats.wildberries.ru/api/v1/supplier/incomes?",
            "flag"             => 0,
            "import"           => 1,
            "support_truncate" => 1,
        ),

        array(
            "id"               => 3,
            "title"            => "Заказы",
            "alias"            => "WBOrders",
            "table"            => "w_b_orders",
            "model"            => WBOrder::class,
            "url"              => "https://suppliers-stats.wildberries.ru/api/v1/supplier/orders?",
            "flag"             => 0,
            "import"           => 1,
            "support_truncate" => 0, // Заказы не поддерживают стартовый импорт(очищение таблиц), из-за сложностей с импортом > 90 дней
        ),

        array(
            "id"               => 4,
            "title"            => "Продажи",
            "alias"            => "WBSales",
            "table"            => "w_b_sales",
            "model"            => WBSale::class,
            "url"              => "https://suppliers-stats.wildberries.ru/api/v1/supplier/sales?",
            "flag"             => 0,
            "import"           => 1,
            "support_truncate" => 0, // Продажи не поддерживают стартовый импорт(очищение таблиц), из-за сложностей с импортом > 90 дней
        ),

    );

    protected $post_import_arrays = array(

        array(
            "id"               => 1,
            "title"            => "Склад",
            "alias"            => "WBStock",
            "table"            => "w_b_products",
            "model"            => WBProduct::class,
            "url"              => "",
            "flag"             => 0,
            "active"           => 1,
            "support_truncate" => 0,
        ),

        array(
            "id"               => 2,
            "title"            => "Базовый товар",
            "alias"            => "WBBaseProduct",
            "table"            => "w_b_base_products",
            "model"            => WBBaseProduct::class,
            "url"              => "",
            "flag"             => 0,
            "active"           => 1,
            "support_truncate" => 0,
        ),
    );

    //
    public function __construct()
    {
        $this->key = env('IMPORT_KEY', "");

        // Если это НЕ стартовый импорт определяем дату(на всякий случай получаем изменения за три дня)
        if (!$this->start_import) {

            $this->current_date = Carbon::now()->subDays(3)->toRfc3339String();
        }
    }

    public function import()
    {
        $wb_import_running = Session::get('wb_import_running');

//        $wb_import_running = false;

        try {

            if (!$wb_import_running && $this->key) {

                Session::put('wb_import_running', 1);

                foreach ($this->import_arrays as $arr) {

                    if ($this->start_import) {

                        if ($arr['import'] && $arr['support_truncate']) {

                            $this->startImportWithTruncate(collect($arr));
                        }
                    } else {

                        if ($arr['import']) {

                            $data_collection = $this->importWBItems(collect($arr));
                        }
                    }
                }

                foreach ($this->post_import_arrays as $arr) {

                    $aaa = 0;

                    if ($arr['active']) {

                        if ($arr['table'] === 'w_b_products') {

                            $this->postImportWBProductsAction(collect($arr));
                        }
                        if ($arr['table'] === 'w_b_base_products') {

                            $this->postImportBaseProductsAction(collect($arr));
                        }
                    }
                }

                Session::forget('wb_import_running');

            } else {
                Log::channel('cron')->alert('Авторизация при запущенном импорте!(WB)');
            }

        } catch (\Exception $ex) {

            Log::channel('import_wb')->critical('Ошибка импорта(WB)  - ' . $ex);

            throw $ex;
        }


        return true;
    }


    function curlWB($url = false)
    {
        if ($url) {

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            return $res;
        }
    }

    /**
     *
     * @param $params \Illuminate\Support\Collection
     * @throws \Exception
     *
     * @return mixed
     */
    public function importWBItems($params)
    {

        $date_from = "dateFrom=" . $this->current_date;
        $key       = "&key=" . $this->key;
        $flag      = $params->get('flag');
        $url       = $params->get('url');

        if ($flag) {
            $full_url = $url . $date_from . "&flag=1" . $key;
        } else {
            $full_url = $url . $date_from . $key;
        }

        $table       = $params->get('table');
        $model_class = $params->get('model');

        Log::channel('import_wb')->info('Старт импорта. Класс - ' . $model_class);

        try {
            $model  = (new $model_class);
            $stop   = false;
            $offset = 0;
            $limit  = 500;

            $data_json = $this->curlWB($full_url);

            $data_arr = json_decode($data_json, JSON_OBJECT_AS_ARRAY);

            $data_collection = collect($data_arr);

            $data_collection_count = $data_collection->count();

            while (!$stop) {

                Log::channel('import_wb')->info('Итерация импорта. Класс - ' . $model_class . '; offset - ' . $offset);

                $data_part = $data_collection->slice($offset, $limit);

                if ($data_part->count()) {

                    foreach ($data_part as $item) {

                        if ($table === 'w_b_products') {

                            $item_col = collect($item);

                            $model->updateOrCreate(
                                [
                                    'nmId'          => $item_col->get('nmId'),
                                    'warehouseName' => $item_col->get('warehouseName'),
                                    'techSize'      => $item_col->get('techSize'),
                                ],
                                array(
                                    'nmId'                => $item_col->get('nmId'),
                                    'warehouseName'       => $item_col->get('warehouseName'),
                                    'techSize'            => $item_col->get('techSize'),
                                    'lastChangeDate'      => $item_col->get('lastChangeDate'),
                                    'supplierArticle'     => $item_col->get('supplierArticle'),
                                    'barcode'             => $item_col->get('barcode'),
                                    'quantity'            => $item_col->get('quantity'),
                                    'isSupply'            => $item_col->get('isSupply'),
                                    'isRealization'       => $item_col->get('isRealization'),
                                    'quantityFull'        => $item_col->get('quantityFull'),
                                    'quantityNotInOrders' => $item_col->get('quantityNotInOrders'),
                                    'inWayToClient'       => $item_col->get('inWayToClient'),
                                    'inWayFromClient'     => $item_col->get('inWayFromClient'),
                                    'subject'             => $item_col->get('subject'),
                                    'category'            => $item_col->get('category'),
                                    'daysOnSite'          => $item_col->get('daysOnSite'),
                                    'brand'               => $item_col->get('brand'),
                                )
                            );
                        }

                        if ($table === 'w_b_supplies') {

                            $item_col = collect($item);

                            $model->updateOrCreate(
                                [
                                    'nmId'     => $item_col->get('nmId'),
                                    'techSize' => $item_col->get('techSize'),
                                    'date'     => $item_col->get('date'),
                                ],
                                array(
                                    'nmId'            => $item_col->get('nmId'),
                                    'incomeId'        => $item_col->get('incomeId'),
                                    'number'          => $item_col->get('number'),
                                    'date'            => $item_col->get('date'),
                                    'lastChangeDate'  => $item_col->get('lastChangeDate'),
                                    'supplierArticle' => $item_col->get('supplierArticle'),
                                    'techSize'        => $item_col->get('techSize'),
                                    'barcode'         => $item_col->get('barcode'),
                                    'quantity'        => $item_col->get('quantity'),
                                    'totalPrice'      => $item_col->get('totalPrice'),
                                    'dateClose'       => $item_col->get('dateClose'),
                                    'warehouseName'   => $item_col->get('warehouseName'),
                                )
                            );
                        }

                        if ($table === 'w_b_orders') {

                            $item_col = collect($item);

                            $order_date_rfc = $item_col->get('date');
                            $order_at       = null;

                            if ($order_date_rfc) {
                                $order_at = Carbon::createFromFormat("Y-m-d\TH:i:s", $order_date_rfc)->format('Y-m-d H:i:s');
                            }

                            $model->updateOrCreate(
                                [
                                    'number'  => $item_col->get('number'),
                                    'barcode' => $item_col->get('barcode'),
                                    'odid'    => $item_col->get('odid'),
                                ],
                                array(
                                    'nmId'            => $item_col->get('nmId'),
                                    'number'          => $item_col->get('number'),
                                    'oblast'          => $item_col->get('oblast'),
                                    'warehouseName'   => $item_col->get('warehouseName'),
                                    'supplierArticle' => $item_col->get('supplierArticle'),
                                    'subject'         => $item_col->get('subject'),
                                    'category'        => $item_col->get('category'),
                                    'brand'           => $item_col->get('brand'),
                                    'quantity'        => $item_col->get('quantity'),
                                    'techSize'        => $item_col->get('techSize'),
                                    'totalPrice'      => $item_col->get('totalPrice'),
                                    'discountPercent' => $item_col->get('discountPercent'),
                                    'barcode'         => $item_col->get('barcode'),
                                    'incomeID'        => $item_col->get('incomeID'),
                                    'odid'            => $item_col->get('odid'),
                                    'date'            => $item_col->get('date'),
                                    'lastChangeDate'  => $item_col->get('lastChangeDate'),
                                    'isCancel'        => $item_col->get('isCancel'),
                                    'order_at'        => $order_at,
                                )
                            );
                        }

                        if ($table === 'w_b_sales') {

                            $item_col = collect($item);

                            $sale_date_rfc = $item_col->get('date');
                            $sale_at       = null;

                            if ($sale_date_rfc) {
                                $sale_at = Carbon::createFromFormat("Y-m-d\TH:i:s", $sale_date_rfc)->format('Y-m-d H:i:s');
                            }

                            $model->updateOrCreate(
                                [
                                    'number' => $item_col->get('number'),
                                    'saleID' => $item_col->get('saleID'),
                                ],
                                array(
                                    'nmId'              => $item_col->get('nmId'),
                                    'number'            => $item_col->get('number'),
                                    'date'              => $item_col->get('date'),
                                    'lastChangeDate'    => $item_col->get('lastChangeDate'),
                                    'supplierArticle'   => $item_col->get('supplierArticle'),
                                    'techSize'          => $item_col->get('techSize'),
                                    'barcode'           => $item_col->get('barcode'),
                                    'quantity'          => $item_col->get('quantity'),
                                    'totalPrice'        => $item_col->get('totalPrice'),
                                    'discountPercent'   => $item_col->get('discountPercent'),
                                    'isSupply'          => $item_col->get('isSupply'),
                                    'isRealization'     => $item_col->get('isRealization'),
                                    'orderId'           => $item_col->get('orderId'),
                                    'promoCodeDiscount' => $item_col->get('promoCodeDiscount'),
                                    'warehouseName'     => $item_col->get('warehouseName'),
                                    'countryName'       => $item_col->get('countryName'),
                                    'oblastOkrugName'   => $item_col->get('oblastOkrugName'),
                                    'regionName'        => $item_col->get('regionName'),
                                    'incomeID'          => $item_col->get('incomeID'),
                                    'saleID'            => $item_col->get('saleID'),
                                    'odid'              => $item_col->get('odid'),
                                    'spp'               => $item_col->get('spp'),
                                    'forPay'            => $item_col->get('forPay'),
                                    'finishedPrice'     => $item_col->get('finishedPrice'),
                                    'priceWithDisc'     => $item_col->get('priceWithDisc'),
                                    'subject'           => $item_col->get('subject'),
                                    'category'          => $item_col->get('category'),
                                    'brand'             => $item_col->get('brand'),
                                    'sale_at'           => $sale_at,
                                )
                            );
                        }
                    }

                    $offset += $limit;

                } else {

                    $stop = true;
                }
            }

            Log::channel('import_wb')->info('Окончание импорта. Класс - ' . $model_class . '; кол-во - ' . $data_collection_count);

            Log::channel('import_wb_data')->info('DATA ' . $model_class . ' : ' . $data_json);

            return $data_collection;

        } catch (\Exception $ex) {

            Session::forget('wb_import_running');

            Log::channel('import_wb')->critical('Ошибка импорта(WB) - ' . $ex);

            throw $ex;
        }
    }


    /**
     *
     * @param $params \Illuminate\Support\Collection
     * @throws \Exception
     *
     * @return mixed
     */
    public function postImportBaseProductsAction($params)
    {

        $model_class = WBBaseProduct::class;

        Log::channel('import_wb')->info('Пост импорт. Класс - ' . $model_class);

        try {
            $model  = (new $model_class);
            $stop   = false;
            $offset = 0;
            $limit  = 500;

            /**
             * @var $data_collection \Illuminate\Support\Collection | bool
             */
            $data_collection = WBProduct::get()->groupBy('nmId');

            $data_collection_count = $data_collection->count();

            while (!$stop) {

                Log::channel('import_wb')->info('Итерация пост импорта. Класс - ' . $model_class . '; offset - ' . $offset);

                $data_part = $data_collection->slice($offset, $limit);

                if ($data_part->count()) {

                    /**
                     * @var $items WBProduct [] | \Illuminate\Support\Collection | bool
                     */
                    foreach ($data_part as $items) {

                        try {

                            /**
                             * @var $item WBProduct
                             */
                            $item = $items->first();

                            $orders = WBOrder::where('nmId', $item->getNmId())->get();
                            $sales  = WBSale::where('nmId', $item->getNmId())->get();

                            $quantity            = $items->sum('quantity');
                            $quantityFull        = $items->sum('quantityFull');
                            $quantityNotInOrders = $items->sum('quantityNotInOrders');
                            $inWayToClient       = $items->sum('inWayToClient');
                            $inWayFromClient     = $items->sum('inWayFromClient');

                            if ($item) {

                                $data = array(
                                    'nmId'                => $item->getNmId(),
                                    'tvc_flow_id'         => $item->getTvcFlowId(),
                                    'supplierArticle'     => $item->getSupplierArticle(),
                                    'brand'               => $item->getBrand(),
                                    'quantity'            => $quantity,
                                    'quantityFull'        => $quantityFull,
                                    'quantityNotInOrders' => $quantityNotInOrders,
                                    'category'            => $item->getCategory(),
                                    'subject'             => $item->getSubject(),
                                    'inWayToClient'       => $inWayToClient,
                                    'inWayFromClient'     => $inWayFromClient,
                                    'orders_count'        => $orders->count(),
                                    'sales_count'         => $sales->count(),
                                );

                                /**
                                 * @var $base_product WBBaseProduct
                                 */
                                $base_product = $model->updateOrCreate(
                                    [
                                        'nmId' => $item['nmId'],
                                    ],
                                    $data
                                );

                                if ($base_product) {

                                    $base_product->updateParsingData();
                                }
                            }

                        } catch (\Exception $ex) {

                            Log::channel('import_wb')->critical('Ошибка пост импорта(BaseProduct) - ' . $ex);
                        }
                    }

                    $offset += $limit;

                } else {

                    $stop = true;
                }
            }

            Log::channel('import_wb')->info('Окончание пост импорта. Класс - ' . $model_class . '; кол-во - ' . $data_collection_count);

            return $data_collection;

        } catch (\Exception $ex) {

            Session::forget('wb_import_running');

            Log::channel('import_wb')->critical('Ошибка пост импорта - ' . $ex);

            throw $ex;
        }
    }

    /**
     *
     * @param $params \Illuminate\Support\Collection
     * @throws \Exception
     *
     * @return mixed
     */
    public function postImportWBProductsAction($params)
    {

        $model_class = WBProduct::class;

        Log::channel('import_wb')->info('Пост импорт. Класс - ' . $model_class);

        try {
            $model                 = (new $model_class);
            $stop                  = false;
            $offset                = 0;
            $limit                 = 500;
            $data_collection_count = 0;
            $now                   = Carbon::now()->format('Y-m-d');

            while (!$stop) {

                Log::channel('import_wb')->info('Итерация пост импорта. Класс - ' . $model_class . '; offset - ' . $offset);

                /**
                 * @var $data_part \Illuminate\Support\Collection | bool
                 */
                $data_part             = WBProduct::offset((int)$offset)->limit((int)$limit)->get();
                $data_part_count       = $data_part->count();
                $data_collection_count += $data_part_count;

                if ($data_part->count()) {

                    /**
                     * @var $item WBProduct
                     */
                    foreach ($data_part as $item) {

                        if ($item) {

                            try {
                                if (!$item->getTvcFlowId()) {

                                    $barcode = $item->getBarcode();

                                    if ($barcode) {

                                        $flow_data = DB::connection('firebird')
                                            ->select('select * from PARISHOP_WB_BARCODES(?)', array($barcode));

                                        if ($flow_data) {

                                            $item->tvc_flow_id = $flow_data[0]->YTVC_ID;
                                        }
                                    }
                                }
                            } catch (\Exception $ex) {

                                Log::channel('import_wb')->critical('Ошибка пост импорта(PARISHOP_WB_BARCODES) - ' . $ex);
                            }

                            $id                  = $item->getId();
                            $warehouseName       = $item->getWarehouseName();
                            $barcode             = $item->getBarcode();
                            $quantity            = $item->getQuantity();
                            $quantityFull        = $item->getQuantityFull();
                            $quantityNotInOrders = $item->getQuantityNotInOrders();
                            $inWayToClient       = $item->getInWayToClient();
                            $inWayFromClient     = $item->getInWayFromClient();

                            $arr = array(
                                'date' => $now,
                                'q'    => $quantity,
                                'qf'   => $quantityFull,
                                'qnio' => $quantityNotInOrders,
                                'iwtc' => $inWayToClient,
                                'iwfc' => $inWayFromClient,
                            );

                            $quantity_history = collect($arr)->toJson();

                            $item->quantity_history = $quantity_history;
                            $item->save();

                            $arr2 = array(
                                'wb_product_id' => $id,
                                'warehouseName' => $warehouseName,
                                'barcode'       => $barcode,
                                'q'             => $quantity,
                                'qf'            => $quantityFull,
                                'qnio'          => $quantityNotInOrders,
                                'iwtc'          => $inWayToClient,
                                'iwfc'          => $inWayFromClient,
                                'parsed_at'     => $now,
                            );

                            WBQuantityHistory::create($arr2);

                            $item->updateConversion();
                        }
                    }

                    $offset += $limit;

                } else {

                    $stop = true;
                }
            }

            Log::channel('import_wb')->info('Окончание пост импорта. Класс - ' . $model_class . '; кол-во - ' . $data_collection_count);

        } catch (\Exception $ex) {

            Session::forget('wb_import_running');

            Log::channel('import_wb')->critical('Ошибка пост импорта - ' . $ex);

            throw $ex;
        }
    }


    /**
     * Стартовый импорт, с полным очищением таблиц!!!
     * @param $params \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function startImportWithTruncate($params)
    {
        $date_from = "dateFrom=" . $this->current_date;
        $key       = "&key=" . $this->key;
        $url       = $params->get('url');
        $full_url  = $url . $date_from . $key;

        $now         = Carbon::now()->format('Y-m-d H:i:s');
        $table       = $params->get('table');
        $model_class = $params->get('model');

        Log::channel('import_wb')->info('Стартовый импорт. Класс - ' . $model_class);

        try {
            $model = (new $model_class);

            $model->truncate();

            $stop   = false;
            $offset = 0;
            $limit  = 1000;

            $data_json = $this->curlWB($full_url);
            $data_arr  = json_decode($data_json, JSON_OBJECT_AS_ARRAY);

            $data_collection = collect($data_arr);

            $data_collection_count = $data_collection->count();

            while (!$stop) {

                Log::channel('import_wb')->info('Итерация стартового импорта. Класс - ' . $model_class . '; offset - ' . $offset);

                $data_part = $data_collection->slice($offset, $limit);

                if ($data_part->count()) {

                    DB::table($table)->insert(
                        $data_part->all()
                    );

                    $offset += $limit;

                } else {

                    $stop = true;
                }
            }

            DB::update("UPDATE `" . $table . "` SET `created_at`= '" . $now . "'");
            DB::update("UPDATE `" . $table . "` SET `updated_at`= '" . $now . "'");

            Log::channel('import_wb')->info('Окончание стартового импорта. Класс - ' . $model_class . '; кол-во - ' . $data_collection_count);

        } catch (\Exception $ex) {

            Session::forget('wb_import_running');

            Log::channel('import_wb')->critical('Ошибка стартового импорта(WB) - ' . $ex);

            throw $ex;
        }
    }
}
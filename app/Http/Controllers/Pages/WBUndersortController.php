<?php

namespace App\Http\Controllers\Pages;

use App;
use App\Jobs\WBUndersortRunJob;
use App\Jobs\WBUndersortXmlJob;
use App\Models\WBParser\WBBaseProduct;
use App\Models\WBParser\WBOrder;
use App\Models\WBParser\WBProduct;
use App\Models\WBParser\WBProductParsingItem;
use App\Models\WBParser\WBRivalProduct;
use App\Models\WBParser\WBSale;
use App\Models\WBParser\WBUndersort;
use App\Site\WBParser\WBBaseParser;
use App\Site\WBParser\WBImport;
use App\Site\WBParser\WBRivalParser;
use App\Site\WBParser\WBUndersortSite;
use Auth;
use Cache;
use Carbon\Carbon;
use DateTime;
use DB;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Queue;
use Session;
use SimpleXMLElement;

class WBUndersortController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:admin');


//        $aaa = Auth::guard('admin')->user();
//        $aaa1 = Auth::guard('admin');
//        $aaa = 0;

        $this->getPage('wb', 1);
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
     * @return \Illuminate\Http\Response
     */
    public function undersort_index()
    {

//        $full_url2 = "https://suppliers-stats.wildberries.ru/api/v1/supplier/stocks?dateFrom=2017-03-25T21%3A00%3A00.000Z&key=YjA3NDcwODQtMjcxYy00OTRkLTk5YjAtNmQ0YmJiZTU1ODBl";
//        $full_url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/orders?dateFrom=2020-02-01T17%3A00%3A00.000Z&flag=1&key=YjA3NDcwODQtMjcxYy00OTRkLTk5YjAtNmQ0YmJiZTU1ODBl";
//
//        $data_json = $this->curlWB($full_url);
//
//        $data_arr = json_decode($data_json, JSON_OBJECT_AS_ARRAY);
//
//        $col = collect($data_arr)->recursive();
//
//
////        $items = $col->where('nmId', 2682072);
//        $items = $col->where('barcode', 3131681548882);
//
//
//
//        $aaa = 0;


//        Cache::forget('undersort_xml_running');

        $HTTP_REFERER = request()->server('HTTP_REFERER');

        //^^^^^^^^^^^^^^^^^^^^XML
        // По кнопке запуска выгрузки в XML
        $undersort_xml_start = request('undersort_xml_start');
        // Флаг запущенного процесса выгрузки подсорта в XML
        $undersort_xml_running = Cache::get('undersort_xml_running');
        // ID подсорта
        $undersort_id = request('undersort_id', false);

        if ($undersort_xml_start && !$undersort_xml_running && $undersort_id) {

            Cache::put('undersort_xml_running', 1, 20);

            DB::table('jobs')->where('queue', 'WBUndersortXml')->delete();

            $job = (new WBUndersortXmlJob($undersort_id))->onQueue('WBUndersortXml');

            Cache::put('undersort_xml_job', $job, 20);

            return redirect($HTTP_REFERER);
        }

        // Флаг запущенного процесса выгрузки подсорта в XML
        $undersort_xml_running = Cache::get('undersort_xml_running');
        //____________________XML

        // Список готовых подсортов
        $undersorts_collection = WBUndersort::orderByDesc('id')
            ->sr_paginate(20);

        return view('cluster.pages.wb.undersort.index', [
            'breadcrumbs_alias'     => 'wb_undersort_index',
            'page'                  => $this->page,
            'undersorts_collection' => $undersorts_collection,
            'undersort_xml_running' => $undersort_xml_running,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function undersort_item()
    {

        // Флаг запущенного процесса выгрузки подсорта в XML
        $undersort_xml_running = Cache::get('undersort_xml_running');

        $undersort_id = request()->route('undersort_id');
        $order_by     = request('order_by', 'undersort_count');

        if ($undersort_id) {

            // Список готовых подсортов
            $undersort = WBUndersort::where('id', $undersort_id)
                ->with(['wb_undersort_products' => function ($query) use ($order_by) {

                    if ($order_by) {

                        $query->orderByDesc($order_by);
                    }

//                    $query->limit(10000);
                }])
                ->firstOrFail();


            $aaa = 0;

            return view('cluster.pages.wb.undersort.item', [
                'breadcrumbs_alias'     => 'wb_undersort_item',
                'breadcrumbs_item'      => $undersort,
                'page'                  => $this->page,
                'undersort'             => $undersort,
                'order_by'              => $order_by,
                'undersort_xml_running' => $undersort_xml_running,
            ]);
        } else {

            App::abort('404');
        }
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function undersort_run()
    {

//        Cache::forget('undersort_main_running');
//        Cache::forget('undersort_xml_running');

        // Склад
        $warehouse = request('warehouse', 'Подольск');

        $HTTP_REFERER = request()->server('HTTP_REFERER');

        //^^^^^^^^^^^^^^^^^^^^Подсорт
        // По кнопке запуска подсорта
        $undersort_start = request('undersort_start');
        // Флаг запущенного процесса подсортировки
        $undersort_main_running = Cache::get('undersort_main_running');
        // Дата начала базового периода
        $base_date_start = request('date_start', false);
        // Дата окончания базового периода
        $base_date_end = request('date_end', false);

        if ($undersort_start && !$undersort_main_running && $base_date_start && $base_date_end) {

            Cache::put('undersort_main_running', 1, 20);

            DB::table('jobs')->where('queue', 'WBUndersortRun')->delete();

            $job = (new WBUndersortRunJob($base_date_start, $base_date_end))->onQueue('WBUndersortRun');

            Cache::put('undersort_main_job', $job, 20);

            return redirect($HTTP_REFERER);
        }

        // Флаг запущенного процесса подсортировки
        $undersort_main_running = Cache::get('undersort_main_running');
        //____________________Подсорт


        // Дата начала базового периода
        $base_date_start = request('date_start', false);
        // Дата окончания базового периода
        $base_date_end = request('date_end', false);

        if ($base_date_start && $base_date_end) {
            /**
             * @var $base_products WBBaseProduct[]| \Illuminate\Support\Collection | bool
             */
            $base_products = WBBaseProduct::with('c_product', 'c_product.cbrand')
                ->whereHas('wb_products', function ($query) use ($warehouse) {
                    $query->where('warehouseName', $warehouse);
                    $query->whereNotNull('tvc_flow_id');
                })
                ->with(['wb_products' => function ($query) use ($warehouse) {
                    $query->where('warehouseName', $warehouse);
                    $query->with('wb_orders');
                    $query->with('wb_sales');
                    $query->with('wb_quantity_histories');
                }])
                ->orderByDesc('id')
                ->sr_paginate(10);

            foreach ($base_products as $key => $base_product) {

                foreach ($base_product->wb_products as $wb_product) {

                    $this->update_data($wb_product, $base_date_start, $base_date_end, $warehouse);
                }
            }
        } else {

            $base_products = collect();
        }

        return view('cluster.pages.wb.undersort.run', [
            'breadcrumbs_alias'      => 'wb_undersort_run',
            'page'                   => $this->page,
            'show_items'             => $base_products->count(),
            'base_products'          => $base_products,
            'base_date_start'        => $base_date_start,
            'base_date_end'          => $base_date_end,
            'undersort_main_running' => $undersort_main_running,
        ]);
    }

    /**
     * @param $wb_product WBProduct
     */
    public function update_data($wb_product, $base_date_start, $base_date_end, $warehouse)
    {
        $wb_product->undersort_data = collect();
        $wb_product->undersort_data->put('estimated_balance', $wb_product->getEstimatedBalanceAttribute());

        $wb_orders = $wb_product->wb_orders
            ->where('warehouseName', $warehouse)
            ->where('order_at', '>=', $base_date_start)
            ->where('order_at', '<=', $base_date_end);

        $orders_group = $wb_orders->groupBy(function ($order, $key) {
            /**
             * @var $order \App\Models\WBParser\WBOrder
             */
            return Carbon::parse($order->getOrderAt())->format('Y-m-d');
        });

        $wb_product->undersort_data->put('wb_orders', $wb_orders);
        $wb_product->undersort_data->put('orders_group', $orders_group);

        $wb_sales = $wb_product->wb_sales
            ->where('warehouseName', $warehouse)
            ->where('sale_at', '>=', $base_date_start)
            ->where('sale_at', '<=', $base_date_end);

        $sales_group = $wb_sales->groupBy(function ($sale, $key) {
            /**
             * @var $sale \App\Models\WBParser\WBSale
             */
            return Carbon::parse($sale->getSaleAt())->format('Y-m-d');
        });

        $wb_product->undersort_data->put('wb_sales', $wb_sales);
        $wb_product->undersort_data->put('sales_group', $sales_group);

        $parse_days_on_site = $wb_product->getParseDaysOnSiteAttribute($base_date_start, $base_date_end);

        $wb_product->undersort_data->put('parse_days_on_site', $parse_days_on_site);

        $orders_days_dif = 0;
        $sales_days_dif  = 0;

        if ($parse_days_on_site) {
            $orders_days_dif = round($wb_orders->count() / $parse_days_on_site, 2);
            $sales_days_dif  = round($wb_sales->count() / $parse_days_on_site, 2);
        }

        $wb_product->undersort_data->put('orders_days_dif', $orders_days_dif);
        $wb_product->undersort_data->put('sales_days_dif', $sales_days_dif);

        $conversion = $wb_product->getConversion();

        $product_need = round(($orders_days_dif * 14 * $conversion * 2) + $orders_days_dif * 10 * (1 - $conversion));
        $wb_product->undersort_data->put('product_need', $product_need);

        $undersort_count = $product_need - $wb_product->getEstimatedBalanceAttribute();

        if ($undersort_count < 1) {
            $undersort_count = 0;
        }

        $wb_product->undersort_data->put('undersort_count', $undersort_count);

        $aaa = 0;
    }


    public function dispatch_job($job)
    {

        if ($job) {
            $this->dispatchNow($job);
        }
    }
}

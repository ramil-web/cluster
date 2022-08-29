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
use App\Models\WBParser\WBSale;
use Cache;
use Carbon\Carbon;
use DateTime;
use DB;
use Log;
use Session;

class WBUndersortSite
{
    /**
     * @var $undersort \App\Models\WBParser\WBUndersort
     */
    protected $undersort;

    protected $undersort_time;

    // Дата начала базового периода
    protected $base_date_start;
    // Дата окончания базового периода
    protected $base_date_end;
    // Склад
    protected $warehouse;

    public function __construct($base_date_start, $base_date_end, $warehouse = 'Подольск')
    {
        $this->undersort_time = Carbon::now()->format('Y-m-d H:i:s');
        // Дата начала базового периода
        $this->base_date_start = $base_date_start;
        // Дата окончания базового периода
        $this->base_date_end = Carbon::parse($base_date_end)->endOfDay();
        // Склад
        $this->warehouse = $warehouse;
    }

    public function run()
    {

        if ($this->base_date_start && $this->base_date_end) {

            Cache::put('undersort_main_running', 1, 90);

            $title = 'Подсорт - (' . $this->base_date_start . ' - ' . $this->base_date_end . '). От ' . $this->undersort_time . '.';
            $alias = "base_undersort_" . Carbon::now()->format('Y_m_d__H_i_s') . ".xml";

            $undersort_arr = array(
                'title'        => $title,
                'alias'        => $alias,
                'start_at'     => $this->base_date_start,
                'end_at'       => $this->base_date_end,
                'undersort_at' => $this->undersort_time,
            );

            $this->undersort = \App\Models\WBParser\WBUndersort::create($undersort_arr);

            $this->setBaseProducts();

            Cache::forget('undersort_main_running');
        }
    }

    /**
     *
     * @throws \Throwable
     */
    public function setBaseProducts()
    {

        $start = microtime(true);

        try {

            Log::channel('undersort_log')->info('________________________Старт________________________');

            $undersort       = $this->undersort;
            $now             = $this->undersort_time;
            $base_date_start = $this->base_date_start;
            $base_date_end   = $this->base_date_end;
            $warehouse       = $this->warehouse;
            $stop            = false;
            $offset          = 0;
            $limit           = 100;

            while (!$stop) {

                $atime1 = 'Время выполнения скрипта: ' . round(microtime(true) - $start, 4) . ' сек.';

                Log::channel('undersort_log')->info('Итерация offset - ' . $offset);

                /**
                 * @var $base_products WBBaseProduct[]| \Illuminate\Support\Collection | bool
                 */
                $base_products = WBBaseProduct::with('c_product', 'c_product.cbrand')
                    ->whereHas('wb_products', function ($query) use ($warehouse) {
                        $query->where('warehouseName', $warehouse);
                        $query->whereNotNull('tvc_flow_id');
                    })
                    ->with(['wb_products' => function ($query) use ($warehouse, $base_date_start, $base_date_end) {
                        $query->where('warehouseName', $warehouse);
                        $query->with('wb_orders');
                        $query->with('wb_sales');
                        $query->with(['wb_quantity_histories' => function ($query) use ($base_date_start, $base_date_end) {
                            $query->whereDate('parsed_at', '>=', $base_date_start);
                            $query->whereDate('parsed_at', '<=', $base_date_end);
                        }]);

                    }])
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

                $atime2 = 'Время выполнения скрипта: ' . round(microtime(true) - $start, 4) . ' сек.';

                Log::channel('undersort_log')->info('Обновление товаров WB(данные подсортировки)');

                foreach ($base_products as $key => $base_product) {


                    foreach ($base_product->wb_products as $wb_product) {

                        $this->updateWbProductData($wb_product, $base_date_start, $base_date_end, $warehouse);
                    }
                }

                $atime3 = 'Время выполнения скрипта: ' . round(microtime(true) - $start, 4) . ' сек.';

                Log::channel('undersort_log')->info('Добавление записей в БД');

                $insert_data_arr = array();

                foreach ($base_products as $key => $base_product) {

                    foreach ($base_product->wb_products as $wb_product) {

                        $undersort_data = $wb_product->getUndersortData();
                        $dt             = new DateTime;

                        $undersort_pr_arr = array(
                            'undersort_id'      => $undersort->getId(),
                            'base_product_id'   => $base_product->getId(),
                            'nmId'              => $wb_product->getNmId(),
                            'barcode'           => $wb_product->getBarcode(),
                            'warehouseName'     => $wb_product->getWarehouseName(),
                            'supplierArticle'   => $wb_product->getSupplierArticle(),
                            'techSize'          => $wb_product->getTechSize(),
                            'conversion'        => $wb_product->getConversion(),
                            'estimated_balance' => $undersort_data->get('estimated_balance'),
                            'days_on_site'      => $undersort_data->get('parse_days_on_site'),
                            'orders'            => $undersort_data->get('wb_orders')->count(),
                            'sales'             => $undersort_data->get('wb_sales')->count(),
                            'orders_last_year'  => $wb_product->wb_orders_last_year()->count(),
                            'sales_last_year'   => $wb_product->wb_sales_last_year()->count(),
                            'product_need'      => $undersort_data->get('product_need'),
                            'undersort_count'   => $undersort_data->get('undersort_count'),
                            'created_at'        => $dt->format('Y.m.d H:i:s'),
                            'updated_at'        => $dt->format('Y.m.d H:i:s'),
                        );

                        $insert_data_arr[] = $undersort_pr_arr;

                        $aaa = 0;
                    }
                }

                // Добавляем в БД
                if (!empty($insert_data_arr)) {
                    DB::table('w_b_undersort_products')->insert(
                        $insert_data_arr
                    );
                }

                $offset += $limit;

                if (!$base_products->count()) {

                    $stop = true;
                }

                $aaa = 0;
            }

            Log::channel('undersort_log')->info('Конец итерации - ' . $offset);

        } catch (\Exception $ex) {

            Cache::forget('undersort_main_running');

            Log::channel('undersort_log')->critical('Ошибка undersort_main_running 1 - ' . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
        }
    }


    /**
     * @param $wb_product WBProduct
     *
     * @throws \Throwable
     */
    public function updateWbProductData($wb_product, $base_date_start, $base_date_end, $warehouse)
    {

        try {

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

        } catch (\Exception $ex) {

            Log::channel('undersort_log')->critical('Ошибка updateWbProductData 2 - ' . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
        }
    }


}
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

class WBAnalyticsController extends Controller
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

    /**
     * @return \Illuminate\Http\Response
     */
    public function base_index()
    {
        $wb_stock = WBBaseProduct::forIndex();

//        $aaa      = 0;

        return view('cluster.pages.wb.base_index', [
            'breadcrumbs_alias' => 'wb_base_index',
            'page'              => $this->page,
            'wb_stock'          => $wb_stock,
        ]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function base_item()
    {

//        new WBBaseParser();

        $wb_id             = request()->route('wb_id');
        $wb_date_start     = request('date_start');
        $wb_date_end       = request('date_end');
        $wb_warehouse_name = request('warehouse');

        if ($wb_id) {

            /**
             * @var $base_product WBBaseProduct
             */

            $base_product = WBBaseProduct::forItem()->where('nmId', $wb_id)->firstOrFail();

            $wb_products_group_by_warehouse = $base_product->wb_products->sortBy('techSize')->groupBy('warehouseName');
            $wb_parsing_items               = $base_product->wb_parsing_items->where('created_at', '>', Carbon::today()->subDays(9));

            //^^^^^^^^^^^^^^^^^^^^Парсер

            $counter = 1;

            $warehouse_items_collection = collect();
            foreach ($wb_products_group_by_warehouse as $warehouse => $group_wb_products) {

                $title = 'Выборка за последние 10 дней';
                if ($wb_date_start && $wb_date_end && ($warehouse == $wb_warehouse_name)) {
                    $title = "Выборка с $wb_date_start по $wb_date_end";

                    $parsing_items = $base_product->wb_parsing_items
                        ->whereBetween('created_at', [$wb_date_start, $wb_date_end])
                        ->where('warehouseName', $wb_warehouse_name);
                } else {
                    $parsing_items = $wb_parsing_items->where('warehouseName', $warehouse);
                }

                $collection = collect(
                    array(
                        'id'                     => $counter,
                        'warehouse_name'         => $warehouse,
                        'wb_products'            => $group_wb_products,
                        'parser_collection_base' => $parsing_items,
                        'parser_collection'      => collect(),
                        'title'                  => $title,
                    ));

                $items_col = collect();
                $counter2  = 1;
                /**
                 * @var $parsing_items WBProductParsingItem[]| \Illuminate\Support\Collection | bool
                 */
                foreach ($parsing_items as $parsing_item) {

                    $items_arr = array(
                        'id'             => $counter2,
                        'date'           => $parsing_item->getDateRfc3339(),
                        'category_place' => -1 * (is_null($parsing_item->getCategoryPlace()) ? 10000 : $parsing_item->getCategoryPlace()),
                        'search_place'   => -1 * (is_null($parsing_item->getSearchPlace()) ? 10000 : $parsing_item->getSearchPlace()),
                        'q'              => $parsing_item->getQuantity(),
                        'qf'             => $parsing_item->getQuantityFull(),
                        'qnio'           => $parsing_item->getQuantityNotInOrders(),
                        'iwtc'           => $parsing_item->getInWayToClient(),
                        'iwfc'           => $parsing_item->getInWayFromClient(),
                    );

                    $items_col->push(collect($items_arr));

                    $counter2++;
                }

                $collection->put('parser_collection', $items_col);

                $min_category_position = $items_col->min('category_place');
                $max_category_position = $items_col->max('category_place');

                $min_search_position = $items_col->min('search_place');
                $max_search_position = $items_col->max('search_place');

                $collection->put('min_position', min($min_search_position, $min_category_position));
                $collection->put('max_position', 0);

                $collection->put('min_category_position', $min_category_position);
                $collection->put('max_category_position', $max_category_position);

                $collection->put('min_search_position', $min_search_position);
                $collection->put('max_search_position', $max_search_position);

                $warehouse_items_collection->push($collection);
                $counter++;
            }
            //____________________Парсер


            $aaa = 0;

            $wb_products_group_by_warehouse_collection = collect($warehouse_items_collection->sortByDesc(function ($items, $key) {
                $warehouse_name = $items->get('warehouse_name');

                return $warehouse_name === 'Подольск' || $warehouse_name === 'Санкт-Петербург' || $warehouse_name === 'Краснодар';
            })->values()->all());
            /**
             * @var $sales WBSale[]| \Illuminate\Support\Collection | bool
             */
            $sales                   = $base_product->wb_sales;
            $sales_grouped_by_region = $sales->groupBy('regionName');

            $sales_price_collection       = collect();
            $sales_price_collection_items = collect();

            /**
             * @var $sales WBSale[]| \Illuminate\Support\Collection | bool
             */
            foreach ($sales as $iter => $sale) {

                if ($sale->getFinishedPrice()) {
                    $arr = array(
                        'id'                       => $iter + 1,
                        'date'                     => $sale->getDate(),
                        'quantity'                 => $sale->getQuantity(),
                        'price_forPay'             => $sale->getForPay(),
                        'price_finishedPrice'      => $sale->getFinishedPrice(),
                        'discount_discountPercent' => $sale->getDiscountPercent(),
                    );

                    $sales_price_collection_items->push(collect($arr));
                }
            }

            $sales_price_collection->put('items', $sales_price_collection_items);
            $sales_price_collection->put('max_value', max($sales_price_collection_items->max('price_forPay'), $sales_price_collection_items->max('price_finishedPrice')));
            $sales_price_collection->put('min_value', min($sales_price_collection_items->min('price_forPay'), $sales_price_collection_items->min('price_finishedPrice')));

            //^^^^^^^^^^^^^^^^^^^^Продажи\Цены
            $sales_grouped_by_date = $sales->groupBy(function ($sale, $key) {
                /**
                 * @var $sale WBSale
                 */
                return Carbon::createFromFormat("Y-m-d\TH:i:s", $sale->getDate())->format('Y-m-d');
            });

            $sales_by_date_collection       = collect();
            $sales_by_date_collection_items = collect();
            $iter                           = 1;

            /**
             * @var $sales WBSale[]| \Illuminate\Support\Collection | bool
             */
            foreach ($sales_grouped_by_date as $date => $sales) {

                $min_finishedPrice = $sales->min('finishedPrice');

                if ($min_finishedPrice && $min_finishedPrice > 0) {
                    $arr = array(
                        'id'                  => $iter,
                        'date'                => $date,
                        'quantity'            => $sales->count(),
                        'price_forPay'        => $sales->min('forPay'),
                        'price_finishedPrice' => $min_finishedPrice,
                    );

                    $sales_by_date_collection_items->push(collect($arr));

                    $iter++;
                }
            }

            $sales_by_date_collection->put('items', $sales_by_date_collection_items);

            //____________________Продажи\Цены


            $sales_diagram_collections = collect();
            $sales_diagram_collections->put('sales_price_collection', $sales_price_collection);
            $sales_diagram_collections->put('sales_by_date_collection', $sales_by_date_collection);

            $aaa = 0;

            return view('cluster.pages.wb.base_item', [
                'breadcrumbs_alias'              => 'wb_base_item',
                'page'                           => $this->page,
                'base_product'                   => $base_product,
                'wb_products_group_by_warehouse' => $wb_products_group_by_warehouse_collection,
                'sales_diagram_collections'      => $sales_diagram_collections,
            ]);

        } else {

            App::abort('404');
        }
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function analytics()
    {
        $wb_date_start = request('date_start');
        $wb_date_end   = request('date_end');

        $start = (new Carbon('first day of this month'))->subMonth(2)->toRfc3339String();
        $title = 'Заказы\Продажи за 3 месяца';

        if ($wb_date_start && $wb_date_end) {

            $wb_sales = WBSale::whereBetween('date', [$wb_date_start, $wb_date_end])
                ->orderBy('date', 'desc')->get();

            $wb_orders = WBOrder::whereBetween('date', [$wb_date_start, $wb_date_end])
                ->orderBy('date', 'desc')->get();
            $title     = "Выборка с $wb_date_start по $wb_date_end";

        } else {
            $wb_sales  = WBSale::where('date', '>=', $start)->orderBy('date', 'desc')->get();
            $wb_orders = WBOrder::where('date', '>=', $start)->orderBy('date', 'desc')->get();
        }

        $wb_sales_grouped_by_date  = $wb_sales->groupBy('format_date');
        $wb_orders_grouped_by_date = $wb_orders->groupBy('format_date');

        $result = array();

        /**
         * @var $group WBSale[]| \Illuminate\Support\Collection | bool
         */
        foreach ($wb_sales_grouped_by_date as $key => $group) {

            $count        = $group->count();
            $sail_sum     = $group->sum('finishedPrice');
            $orders_group = $wb_orders_grouped_by_date->get($key);

            if ($orders_group) {

                $orders_count = $orders_group->count();
            } else {

                $orders_count = 0;
            }

            $result[] = array(
                'year'         => $key,
                'count'        => $count,
                'orders_count' => $orders_count,
                'sail_sum'     => round($sail_sum),
                'title'        => $title,
            );
        }

        return view('cluster.pages.wb.analytics', [
            'breadcrumbs_alias' => 'wb_analytics',
            'page'              => $this->page,
            'wb_sales'          => $result,
        ]);
    }
}

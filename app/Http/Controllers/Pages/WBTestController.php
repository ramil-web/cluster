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
use App\Models\WBParser\WBSupply;
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
use Illuminate\Pagination\LengthAwarePaginator;
use Log;
use Queue;
use Session;
use SimpleXMLElement;

class WBTestController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:admin');

        $this->getPage('wb', 1);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Дата начала
        $date_start = request('date_start', '2020-02-14');
        // Дата окончания
        $date_end = request('date_end', '2020-02-29');

//        Cache::forget('undersort_main_running');
//        $aaa = (new WBUndersortSite($date_start, $date_end))->run();
//        $aaa = 0;

        $orders = WBOrder::whereDate('order_at', '>=', $date_start)
            ->whereDate('order_at', '<=', $date_end)
            ->orderBy('order_at')
            ->get();

        $orders_brands = $orders->groupBy('brand');

        // Сортируем группы
        $grouped_orders_brands = $orders_brands->sortBy(function ($products, $key) {

            return $key;
        });

        $arr = array();

        foreach ($grouped_orders_brands as $key => &$group) {
            $group2 = $group->groupBy(function ($order, $key) {
                /**
                 * @var $order WBOrder
                 */
                return Carbon::parse($order->getOrderAt())->format('Y-m-d');
            });

            $arr[$key . '_' . $group->count()] = $group2;
        }

        $grouped_orders_brands = collect($arr);

        $sales = WBSale::whereDate('sale_at', '>=', $date_start)
            ->whereDate('sale_at', '<=', $date_end)
            ->orderBy('sale_at')
            ->get();

        $sales_brands = $sales->groupBy('brand');

        // Сортируем группы
        $grouped_sales_brands = $sales_brands->sortBy(function ($products, $key) {

            return $key;
        });

        $arr = array();

        foreach ($grouped_sales_brands as $key => &$group) {
            $group2 = $group->groupBy(function ($sale, $key) {
                /**
                 * @var $sale WBSale
                 */
                return Carbon::parse($sale->getSaleAt())->format('Y-m-d');
            });

            $arr[$key . '_' . $group->count()] = $group2;
        }

        $grouped_sales_brands = collect($arr);


        $aaa = 0;

        return view('cluster.pages.wb.test.index', [
            'breadcrumbs_alias'     => 'wb_base_index',
            'page'                  => $this->page,
            'orders'                => $orders,
            'grouped_orders_brands' => $grouped_orders_brands,
            'grouped_sales_brands'  => $grouped_sales_brands,
            'date_start'            => $date_start,
            'date_end'              => $date_end,
        ]);
    }

}

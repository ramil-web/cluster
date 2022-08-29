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

class WBPivotController extends Controller
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
        // Limit
        $limit = request('limit', 5000);
        // Таблица
        $table = request('table', 'orders');
        // Дата начала базового периода
        $date_start = request('date_start', false);
        // Дата окончания базового периода
        $date_end = request('date_end', false);

        $wb_stock_query = false;

        if ($table === 'orders') {

            $wb_stock_query = WBOrder::query();

            if ($date_start) {
                $wb_stock_query->whereDate('order_at', '>=', $date_start);
            }
            if ($date_end) {
                $wb_stock_query->whereDate('order_at', '<=', $date_end);
            }
        } else if ($table === 'sales') {

            $wb_stock_query = WBSale::query();

            if ($date_start) {
                $wb_stock_query->whereDate('sale_at', '>=', $date_start);
            }
            if ($date_end) {
                $wb_stock_query->whereDate('sale_at', '<=', $date_end);
            }

        } else if ($table === 'supplies') {

            $wb_stock_query = WBSupply::query();

            if ($date_start) {
                $wb_stock_query->whereDate('date', '>=', $date_start);
            }
            if ($date_end) {
                $wb_stock_query->whereDate('date', '<=', $date_end);
            }
        } else if ($table === 'base_products') {

            $wb_stock_query = WBBaseProduct::query()->with('last_7_days_wb_parsing_items');

//            if ($date_start) {
//                $wb_stock_query->whereDate('date', '>=', $date_start);
//            }
//            if ($date_end) {
//                $wb_stock_query->whereDate('date', '<=', $date_end);
//            }
        } else if ($table === 'products') {

            $wb_stock_query = WBProduct::query();
        }

        if ($wb_stock_query) {

            if ($limit === 'all') {

                $limit = 100000;
            }

            /**
             * @var $wb_stock App\Pagination\CustomPaginator
             */
            $wb_stock = $wb_stock_query->sr_paginate($limit);

        }

        return view('cluster.pages.wb.pivot_table', [
            'breadcrumbs_alias' => 'wb_pivot',
            'page'              => $this->page,
            'wb_stock'          => $wb_stock,
            'limit'             => $limit,
            'table'             => $table,
        ]);
    }

}

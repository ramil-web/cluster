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
use Illuminate\Http\Response;
use Log;
use Queue;
use Session;
use SimpleXMLElement;

class WBRivalsController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:admin');

        $this->getPage('wb', 1);
    }

    /**
     * @return Response
     */
    public function index()
    {
        $wb_date_start     = request('date_start');
        $wb_date_end       = request('date_end');
        $date = Carbon::today()->subDays(29);

        $rivals_brands      = WBRivalProduct::pluck('brand_name')->unique();

        $rivals_brands_coll = collect();
        foreach ($rivals_brands as $key => $rivals_brand_title) {

            $arr = array(
                'id'    => $key + 1,
                'title' => $rivals_brand_title,
            );

            $rivals_brands_coll->push(collect($arr));
        }

        $current_brand = request('brand', false);

        if ($current_brand) {

            $rivals_items = WBRivalProduct::where('brand_name', $current_brand)
                ->orderByDesc('parsed_at')
                ->get();

        } else {
            if($wb_date_start && $wb_date_end){
                $rivals_items = WBRivalProduct::where('category_place', '<=', 100)
                    ->whereBetween('created_at', [$wb_date_start, $wb_date_end])
                    ->orderByDesc('parsed_at')
                    ->get();
            }else{
                $rivals_items = WBRivalProduct::where('category_place', '<=', 100)
                    ->where('created_at', '>', $date)
                    ->orderByDesc('parsed_at')
                    ->get();
            }

        }


//        $daily_rivals = WBRivalProduct::where('category_place', '<=', 100)->get()->groupBy('parsed_at');

        $aaa = 0;

        return view('cluster.pages.wb.rivals.index', [
            'breadcrumbs_alias' => 'wb_rivals',
            'page'              => $this->page,
            'rivals_brands'     => $rivals_brands_coll,
            'rivals_items'      => $rivals_items,
            'current_brand'     => $current_brand,
        ]);
    }
}

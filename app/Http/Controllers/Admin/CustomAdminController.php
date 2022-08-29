<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Pages\News;
use Carbon\Carbon;
use Config;
use FSOptions;
use Illuminate\Http\Request;
use SidorovRoman\ConfigWriter\FileWriter;
use SidorovRoman\ConfigWriter\Repository;
use SidorovRoman\ConfigWriter\Rewrite;

class CustomAdminController extends Controller
{

    public function __construct(Request $request)
    {
       
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function item(Request $request)
    {

        //FSOptions::set('site.header.phone', '333-333-3333');
        //FSOptions::set('site.header.url', 'df sdf sdf sdf sdf ');
        //$phone1 = FSOptions::get('site.header.url');
        //FSOptions::dell('site.header.al');
        //$phone2 = FSOptions::get('site.header');
    }
}

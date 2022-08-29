<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {

        $this->getPage('home', 1);
    }

    /**
     * Show the application dashboard. cluster.app.parishop.ru
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $admin = Auth::guard('admin')->user();

        if ($admin) {
            return redirect('/wb');
        }

        return view('cluster.pages.home.index',[
            'page' => $this->page,
        ]);
    }
}

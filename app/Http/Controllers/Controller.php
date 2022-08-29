<?php

namespace App\Http\Controllers;

use App;
use App\Classes\Page;
use App\Helpers\Helpers;
use App\Http\Controllers\PageBlocks\PageBlocksAppController;
use App\Mail\MailUserApplication;
use App\Mail\MailUserBackCall;
use App\Models\Admin;
use App\Models\Catalog\CShop;
use App\Models\PageModules\SubscribeEmail;
use App\Models\User\UserBackCall;
use App\Models\UserApplication;
use App\Models\UserNotValidApplication;
use App\Site\User\SiteUser;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mail;
use Illuminate\Support\Facades\Request;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @var \App\Classes\Page $page
     */
    public $page;

    public function __construct()
    {

    }

    public function getPage($url, $id = 1)
    {
        $this->page = new Page($url, $id);
    }

}

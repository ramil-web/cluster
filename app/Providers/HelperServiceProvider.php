<?php

namespace App\Providers;

use App;
use App\Helpers\Helpers;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('helper', function()
        {
            return new Helpers();
        });
    }
}

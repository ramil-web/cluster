<?php

namespace App\Providers;

use App\Helpers\Helpers;
use App\Models\PageModules\Icon;
use File;
use Illuminate\Support\ServiceProvider;
use View;

class SvgIconsServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //^^^^^^^^^^^^^^^^^^^^Иконки        
        $db_icons = app('site_icons');

        foreach ( $db_icons as $icon ) {

            $svg_icon = false;

            if ( $icon && $icon->readonly && $icon->alias ) {
                $icon_path = $icon->image;

                if ( File::exists(public_path($icon_path)) ) {
                    $svg_icon = File::get(public_path($icon_path));
                }
            }

            View::share($icon->alias, $svg_icon);
        }

        //____________________Иконки

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}

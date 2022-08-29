<?php

namespace App\Providers;

use App;
use App\Models\PageModules\Icon;
use App\Models\Settings\Setting;
use Illuminate\Support\ServiceProvider;
use Validator;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Макрос для рекурсивного преобразования в коллекцию вложенных массивов
        \Illuminate\Support\Collection::macro('recursive', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return collect($value)->recursive();
                }

                return $value;
            });
        });

        //подумать как прикрутить блоки ко всем страницам
        //View::composer('*', 'App\Http\ViewComposers\PageBlocksComposer');

        //^^^^^^^^^^^^^^^^^^^^Валидатор для админки
        Validator::extend('admin_url', function ($attribute, $value, $parameters, $validator) {
            $value = preg_match('/^[a-z0-9-_]+$|^$/i', $value, $matches, PREG_OFFSET_CAPTURE);
            return $value;
        });
        //____________________Валидатор для админки
        //^^^^^^^^^^^^^^^^^^^^Хлебные крошки
        View::share('breadcrumbs_alias', false);
        View::share('breadcrumbs_item', null);
        //____________________Хлебные крошки
        //^^^^^^^^^^^^^^^^^^^^Настройки сайта
        View::share('site_settings', (new Setting));
        //____________________Настройки сайта
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Все иконки
        App::singleton('site_icons', function ($app) {
            return (new Icon())->active()->get();
        });
    }
}

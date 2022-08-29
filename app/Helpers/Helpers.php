<?php

namespace App\Helpers;

use App;
use App\Models\PageModules\Icon;
use Config;
use File;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\Facades\Image;
use LocalizedCarbon;
use Request;
use Illuminate\Support\Facades\Facade;

/**
 * Class Helpers
 *
 * @package App\Helpers
 */
class Helpers extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'helper';
    }

    //Активный пункт меню
    public static function set_menu_active($routes, $class = 'active')
    {
        $active = '';
        foreach ($routes as $route) {
            if (Request::is($route) || Request::is($route . '/*')) {
                $active = $class;
                break;
            }
        }

        return $active;
    }

    //Активный пункт меню(выпадающий список)
    public static function set_drop_menu_active($route, $class = 'active')
    {
        $active = Request::is($route) ? ' ' . $class . ' ' : ' ';

        return $active;
    }

    //Локализованный формат даты
    public static function dateForHumans($date = null)
    {
        if ($date) {
            $resp = null;

            //Если опять после обновления возникнет ошибка в LocalizedCarbon
            //выводим обычную ф-цию Carbon  
            try {
                $resp = LocalizedCarbon::instance($date)->diffForHumans();
            } catch (\Exception $ex) {
                $resp = $date->diffForHumans();
            }

            return $resp;
        }

        return false;
    }

    //Вывод ошибки в зависимости от статуса debug
    public static function showError($error)
    {

        if (!Config::get('app.debug')) {
            App::abort('404');
        }
        dd($error);
    }

    /**
     * Получить svg иконку
     * @deprecated
     */
    public static function get_svg_icons($icon_path)
    {
        $svg_icon = false;

        if ($icon_path && File::exists(public_path($icon_path))) {
            $svg_icon = File::get(public_path($icon_path));
        }

        return $svg_icon;
    }

    //Получить svg иконку (синглтон)  
    public static function get_app_svg_icons($icon_id)
    {
        $svg_icon = false;

        $site_icons = app('site_icons');

        $db_icon = $site_icons->where('id', $icon_id)->first();

        if ($db_icon) {
            $icon_path = $db_icon->image;

            if (File::exists(public_path($icon_path))) {
                $svg_icon = File::get(public_path($icon_path));
            }
        }

        return $svg_icon;
    }

    //Получить svg иконку по alias (синглтон)  
    public static function get_app_svg_icons_alias($icon_alias)
    {
        $svg_icon = false;

        $site_icons = app('site_icons');

        $db_icon = $site_icons->where('alias', $icon_alias)->first();

        if ($db_icon) {
            $icon_path = $db_icon->image;

            if (File::exists(public_path($icon_path))) {
                $svg_icon = File::get(public_path($icon_path));
            }
        }

        return $svg_icon;
    }

    //Ресайз и сохранение изображений
    public static function get_image($image_path, $width = 0, $height = 0, $default_image = 0)
    {
        $result_path = $default_image ? $default_image : 'default.png';

        if ($image_path && File::exists(public_path($image_path))) {

            if (!$width && !$height) {

                $result_path = $image_path;

            } else {

                $height = $height ? $height : $width;

                $path_parts = pathinfo($image_path);

                $filename  = $path_parts['filename'];
                $dirname   = $path_parts['dirname'];
                $extension = $path_parts['extension'];

                $resize_image_name = $filename . '(' . $width . '_' . $height . ').' . $extension;
                $resize_image_path = $dirname . '/' . $resize_image_name;

                if (File::exists(public_path($resize_image_path))) {

                    $result_path = $resize_image_path;

                } else {

                    $image = Image::make(public_path($image_path));

                    $image->fit($width, $height);

                    if ($image->save(public_path($resize_image_path))) {

                        $result_path = $resize_image_path;
                    }
                }
            }
        } else {

            if ($width) {

                $height = $height ? $height : $width;
                $image  = Image::make('default.png');

                if (!is_dir($image->dirname . '/default_images/')) {
                    mkdir($image->dirname . '/default_images/');
                }

                $resize_image_name = $image->filename . '(' . $width . '_' . $height . ').' . $image->extension;
                $resize_image_path = $image->dirname . '/default_images/' . $resize_image_name;

                if (File::exists(public_path($resize_image_path))) {

                    $result_path = $resize_image_path;

                } else {

                    $image->fit($width, $height);

                    if ($image->save($resize_image_path)) {

                        $result_path = $resize_image_path;

                    }
                }
            }
        }

        return $result_path;
    }

    //Заглавная первая буква
    public static function mb_ucfirst($string, $encoding)
    {
        $strlen    = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then      = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    // Проверка боевого домена
    public static function check_main_domain()
    {

        if ((Request::getHttpHost() === 'parishop.ru')) {
            return true;
        }

        return false;
    }
}




















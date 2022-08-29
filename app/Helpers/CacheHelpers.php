<?php

namespace App\Helpers;

use App;
use App\Models\Catalog\CBrand;
use App\Models\Catalog\CCategory;
use App\Site\Catalog\BrandCatalog;
use App\Site\Catalog\Catalog;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Session;

/**
 * Class CacheHelpers
 *
 * @package App\Helpers
 */
class CacheHelpers extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'cache_helper';
    }

    /**
     * @return mixed
     *
     * Ф-ция кеширования категорий(фильтра)
     */
    public static function cachingCategoriesFilter(Request $request, $offset, $limit)
    {
//        if ($offset === 0) {
//            // Очищаем кеш
//            Cache::flush();
//        }

        // Все категории
        $all_categories_list = CCategory::offset((int)$offset)
            ->limit((int)$limit)
            ->get();

        foreach ($all_categories_list as $category) {

            $cashing_alias = $category->getAlias();

            // Устанавливаем alias категории
            if ($request->route()) {
                $request->route()->setParameter('alias',  $cashing_alias);
            }

            // Сохраняем в сессии путь(для фильтра)
            Session::put('cache_item_path', 'catalog/category/' . $cashing_alias);

            // Получаем каталог, тем самым кешируем фильтр
            $catalog = (new Catalog($request, $cashing_alias));

        }

        Session::forget('cache_item_path');

        $all_categories_list = CCategory::offset((int)$offset)
            ->limit((int)$limit)
            ->get();

        return $all_categories_list;
    }

    /**
     * @return mixed
     *
     * Ф-ция кеширования категорий(фильтра)
     */
    public static function cachingBrandsFilter(Request $request, $offset, $limit)
    {
        // Все бренды
        $all_brands_list = $brands_list = CBrand::withProducts()->offset((int)$offset)
            ->limit((int)$limit)
            ->get();

        foreach ($all_brands_list as $brand) {

            $cashing_alias = $brand->getShortTitle();

            // Устанавливаем alias категории
            if ($request->route()) {
                $request->route()->setParameter('alias',  $cashing_alias);
            }

            // Сохраняем в сессии путь(для фильтра)
            Session::put('cache_item_path', 'brands/' . $cashing_alias);

            // Получаем каталог, тем самым кешируем фильтр
            $catalog = (new BrandCatalog($request, $brand, $cashing_alias));

        }

        Session::forget('cache_item_path');

        return $all_brands_list;
    }

    /**
     * @return CCategory[] |\Illuminate\Database\Eloquent\Collection | boolean
     */
    public static function getCacheCategoriesListForCatalogNavigation()
    {
        $cache_item = Cache::get('CategoriesListForCatalogNavigation');
        $categories_list = false;

        //Если не находим
        if (!$cache_item) {

            // Очищаем список IDS категорий(для рекурсивных подкатегорий, например категорий брендов)
            Session::forget('categories_ids');

            $categories_list = CCategory::forCatalogNavigation()->get();

            Cache::put('CategoriesListForCatalogNavigation', $categories_list, 1200);

        }else{

            $categories_list = $cache_item;
        }

        return $categories_list;
    }

    /**
     * @return CBrand[] |\Illuminate\Database\Eloquent\Collection | boolean
     */
    public static function getCacheBrandsListForCatalogNavigation()
    {
        $cache_item = Cache::get('BrandsListForCatalogNavigation');
        $brands_list = false;

        //Если не находим
        if (!$cache_item) {

            $brands_list = CBrand::forCatalogNavigation()->get();

            Cache::put('BrandsListForCatalogNavigation', $brands_list, 1200);

        }else{

            $brands_list = $cache_item;
        }

        return $brands_list;
    }

}




















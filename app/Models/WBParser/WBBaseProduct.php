<?php

namespace App\Models\WBParser;

use App\Models\Catalog\CProduct;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBBaseProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $brand Бренд
 * @property string|null $category Категория
 * @property string|null $subject Предмет
 * @property int|null $quantity Количество доступное для продажи (все размеры)
 * @property int|null $quantityFull Количество полное (все размеры)
 * @property int|null $quantityNotInOrders Количество не в заказе (все размеры)
 * @property int|null $inWayToClient В пути к клиенту(штук) (все размеры)
 * @property int|null $inWayFromClient В пути от клиента(штук) (все размеры)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $tvc_flow_id ID(Flow)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBProduct[] $wb_products
 * @property-read int|null $wb_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereTvcFlowId($value)
 * @property int|null $orders_count Количество заказов
 * @property int|null $sales_count Количество продаж
 * @property-read \App\Models\Catalog\CProduct $c_product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct forIndex()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSalesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct forItem()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBProductParsingItem[] $wb_parsing_items
 * @property-read int|null $wb_parsing_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales
 * @property-read int|null $wb_sales_count
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property int|null $comments_count Кол-во комментариев
 * @property int|null $stars_count Рейтинг
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereStarsCount($value)
 * @property float|null $d_cat_pl Текущая позиция по выдаче в категории
 * @property float|null $w_cat_avg_pl Средняя позиция по выдаче в категории(7 дней)
 * @property float|null $w_cat_min_pl Мин. позиция по выдаче в категории(7 дней)
 * @property float|null $w_cat_max_pl Макс. позиция по выдаче в категории(7 дней)
 * @property float|null $w_cat_vl_prc Волатильность по позициям выдачи в категории(7 дней)
 * @property float|null $d_src_pl Текущая позиция по поисковой выдаче
 * @property float|null $w_src_min_pl Средняя позиция по поисковой выдаче (7 дней)
 * @property float|null $w_src_avg_pl Мин. позиция по поисковой выдаче (7 дней)
 * @property float|null $w_src_max_pl Макс. позиция по поисковой выдаче(7 дней)
 * @property float|null $w_src_vl_prc Волатильность по позициям поисковой выдачи(7 дней)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereDCatPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereDSrcPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWCatAvgPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWCatMaxPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWCatMinPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWCatVlPrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWSrcAvgPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWSrcMaxPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWSrcMinPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereWSrcVlPrc($value)
 */
class WBBaseProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['wb_item_route'];

    /**
     * Для списковой страницы
     *
     * @return WBBaseProduct [] | \Illuminate\Support\Collection | bool
     */
    public function scopeForIndex($query)
    {
        $query->with(['c_product', 'c_product.cbrand']);
        return $query->orderBy('sales_count', 'desc')->get();
    }

    /**
     * Для внутренней страницы $query->where('warehouseName', 'Подольск');
     *
     * @return WBBaseProduct [] | \Illuminate\Support\Collection | bool
     */
    public function scopeForItem($query)
    {

        return $query->with([
            'c_product',
            'c_product.cbrand',
            'wb_sales',
            'wb_products',
            'wb_parsing_items',
        ]);
    }

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ
    // Товары WB (Размеры)
    public function wb_products()
    {
        return $this->hasMany(WBProduct::class, 'nmId', 'nmId');
    }

    // Продажи WB
    public function wb_sales()
    {
        return $this->hasMany(WBSale::class, 'nmId', 'nmId');
    }

    // Товар (наш)
    public function c_product()
    {
        return $this->hasOne(CProduct::class, 'tvc_flow_id', 'tvc_flow_id');
    }

    // Итерации парсинга
    public function wb_parsing_items()
    {
        return $this->hasMany(WBProductParsingItem::class, 'nmId', 'nmId');
    }

    // Итерации парсинга
    public function last_7_days_wb_parsing_items()
    {
        return $this->wb_parsing_items()->where('warehouseName', 'Подольск')
            ->where('created_at', '>', Carbon::today()->subDays(6))
            ->orderByDesc('created_at');
    }
    //____________________ОТНОШЕНИЯ
    //^^^^^^^^^^^^^^^^^^^^Обновление данных парсинга
    public function updateParsingData()
    {
        $last_7_days_wb_parsing_items = $this->last_7_days_wb_parsing_items;

        $lower_price                      = null;
        $old_price                        = null;
        $price_sale                       = null;
        $comments_count                   = null;
        $stars_count                      = null;
        $day_category_place               = null;
        $week_average_category_place      = null;
        $week_min_category_place          = null;
        $week_max_category_place          = null;
        $week_category_volatility_percent = null;
        $day_search_place                 = null;
        $week_min_search_place            = null;
        $week_average_search_place        = null;
        $week_max_search_place            = null;
        $week_search_volatility_percent   = null;

        if ($last_7_days_wb_parsing_items->count()) {

            // Текущая цена
            $lower_price = $last_7_days_wb_parsing_items->where('lower_price', '!=', null)->pluck('lower_price')->first();
            // Старая цена
            $old_price = $last_7_days_wb_parsing_items->where('old_price', '!=', null)->pluck('old_price')->first();
            // Скидка
            $price_sale = $last_7_days_wb_parsing_items->where('price_sale', '!=', null)->pluck('price_sale')->first();
            // Кол-во комментариев
            $comments_count = $last_7_days_wb_parsing_items->where('comments_count', '!=', null)->pluck('comments_count')->first();
            // Рейтинг
            $stars_count = $last_7_days_wb_parsing_items->where('stars_count', '!=', null)->pluck('stars_count')->first();

            // Последняя(Текущая) запись парсинга
            $last_parsing_item = $last_7_days_wb_parsing_items->sortByDesc('created_at')->first();

            /**
             * @var $last_parsing_item WBProductParsingItem
             */
            if ($last_parsing_item) {
                $day_category_place = $last_parsing_item->getCategoryPlace() ? $last_parsing_item->getCategoryPlace() : null;
                $day_search_place   = $last_parsing_item->getSearchPlace() ? $last_parsing_item->getSearchPlace() : null;
            }

            // Средняя позиция по выдаче (7 дней)
            $category_average = $last_7_days_wb_parsing_items->avg('category_place');
            $search_average   = $last_7_days_wb_parsing_items->avg('search_place');

            /**
             * @var $category_average float|null
             * @var $search_average float|null
             */
            if ($category_average) {

                $week_average_category_place = intval($category_average);
            }
            if ($search_average) {

                $week_average_search_place = intval($search_average);
            }

            // Минимальная позиция по выдаче (7 дней)
            $category_min = $last_7_days_wb_parsing_items->min('category_place');
            $search_min   = $last_7_days_wb_parsing_items->min('search_place');

            /**
             * @var $category_min int|null
             * @var $search_min int|null
             */
            if ($category_min) {

                $week_min_category_place = $category_min;
            }
            if ($search_min) {

                $week_min_search_place = $search_min;
            }

            // Максимальная позиция по выдаче (7 дней)
            $category_max = $last_7_days_wb_parsing_items->max('category_place');
            $search_max   = $last_7_days_wb_parsing_items->max('search_place');

            /**
             * @var $category_max int|null
             * @var $search_max int|null
             */
            if ($category_max) {

                $week_max_category_place = $category_max;
            }
            if ($search_max) {

                $week_max_search_place = $search_max;
            }

            /**
             * @var $category_first_not_null WBProductParsingItem
             */
            $category_first_not_null = $last_7_days_wb_parsing_items->where('category_place', '!=', null)->first();
            $category_first          = $category_first_not_null ? $category_first_not_null->getCategoryPlace() : null;

            /**
             * @var $category_last_not_null WBProductParsingItem
             */
            $category_last_not_null = $last_7_days_wb_parsing_items->where('category_place', '!=', null)->last();
            $category_last          = $category_last_not_null ? $category_last_not_null->getCategoryPlace() : null;

            if ($category_first && $category_last) {

                $week_category_volatility_percent = round((($category_last - $category_first) * 100) / $category_first, 2);
            }

            /**
             * @var $search_first_not_null WBProductParsingItem
             */
            $search_first_not_null = $last_7_days_wb_parsing_items->where('search_place', '!=', null)->first();
            $search_first          = $search_first_not_null ? $search_first_not_null->getSearchPlace() : null;

            /**
             * @var $search_last_not_null WBProductParsingItem
             */
            $search_last_not_null = $last_7_days_wb_parsing_items->where('search_place', '!=', null)->last();
            $search_last          = $search_last_not_null ? $search_last_not_null->getSearchPlace() : null;

            if ($search_first && $search_last) {

                $week_search_volatility_percent = round((($search_last - $search_first) * 100) / $search_first, 2);
            }
        }

        $data_arr = array(
            'd_cat_pl'     => $day_category_place,
            'w_cat_avg_pl' => $week_average_category_place,
            'w_cat_min_pl' => $week_min_category_place,
            'w_cat_max_pl' => $week_max_category_place,
            'w_cat_vl_prc' => $week_category_volatility_percent,
            'd_src_pl'     => $day_search_place,
            'w_src_min_pl' => $week_min_search_place,
            'w_src_avg_pl' => $week_average_search_place,
            'w_src_max_pl' => $week_max_search_place,
            'w_src_vl_prc' => $week_search_volatility_percent,
        );

        if ($lower_price) {
            $data_arr['lower_price'] = $lower_price;
        }
        if ($old_price) {
            $data_arr['old_price'] = $old_price;
        }
        if ($price_sale) {
            $data_arr['price_sale'] = $price_sale;
        }
        if ($comments_count) {
            $data_arr['comments_count'] = $comments_count;
        }
        if ($stars_count) {
            $data_arr['stars_count'] = $stars_count;
        }

        $this->update($data_arr);
    }

    //____________________Обновление данных парсинга

    //^^^^^^^^^^^^^^^^^^^^ПРЕОБРАЗОВАТЕЛИ

    //____________________ПРЕОБРАЗОВАТЕЛИ

    //^^^^^^^^^^^^^^^^^^^^GETTERS
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getNmId()
    {
        return $this->nmId;
    }

    /**
     * @return int|null
     */
    public function getTvcFlowId()
    {
        return $this->tvc_flow_id;
    }

    /**
     * @return null|string
     */
    public function getSupplierArticle()
    {
        return $this->supplierArticle;
    }

    /**
     * @return null|string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return null|string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return null|string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return int|null
     */
    public function getQuantityFull()
    {
        return $this->quantityFull;
    }

    /**
     * @return int|null
     */
    public function getQuantityNotInOrders()
    {
        return $this->quantityNotInOrders;
    }

    /**
     * @return int|null
     */
    public function getInWayToClient()
    {
        return $this->inWayToClient;
    }

    /**
     * @return int|null
     */
    public function getInWayFromClient()
    {
        return $this->inWayFromClient;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return null|string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * @return int|null
     */
    public function getOrdersCount()
    {
        return $this->orders_count;
    }

    /**
     * @return float|null
     */
    public function getLowerPrice()
    {
        return $this->lower_price;
    }

    /**
     * @return float|null
     */
    public function getOldPrice()
    {
        return $this->old_price;
    }

    /**
     * @return float|null
     */
    public function getPriceSale()
    {
        return $this->price_sale;
    }

    /**
     * @return int|null
     */
    public function getCommentsCount()
    {
        return $this->comments_count;
    }

    /**
     * @return int|null
     */
    public function getStarsCount()
    {
        return $this->stars_count;
    }

    /**
     * @return float|null
     */
    public function getCurrentDayCategoryPlace()
    {
        return $this->d_cat_pl;
    }

    /**
     * @return float|null
     */
    public function getAverageWeekCategoryPlace()
    {
        return $this->w_cat_avg_pl;
    }

    /**
     * @return float|null
     */
    public function getMinWeekCategoryPlace()
    {
        return $this->w_cat_min_pl;
    }

    /**
     * @return float|null
     */
    public function getMaxWeekCategoryPlace()
    {
        return $this->w_cat_max_pl;
    }

    /**
     * @return float|null
     */
    public function getVolotilityCategoryPercent()
    {
        return $this->w_cat_vl_prc;
    }

    /**
     * @return float|null
     */
    public function getCurrentDaySearchPlace()
    {
        return $this->d_src_pl;
    }

    /**
     * @return float|null
     */
    public function getMinWeekSearchPlace()
    {
        return $this->w_src_min_pl;
    }

    /**
     * @return float|null
     */
    public function getAverageWeekSearchPlace()
    {
        return $this->w_src_avg_pl;
    }

    /**
     * @return float|null
     */
    public function getMaxWeekSearchPlace()
    {
        return $this->w_src_max_pl;
    }

    /**
     * @return float|null
     */
    public function getVolotilitySearchPercent()
    {
        return $this->w_src_vl_prc;
    }

    /**
     * @return int|null
     */
    public function getSalesCount()
    {
        return $this->sales_count;
    }

    /**
     * @return string|null
     */
    public function getWbItemRouteAttribute()
    {
        return route('wb.base_item', $this->getNmId());
    }

    //____________________GETTERS
}

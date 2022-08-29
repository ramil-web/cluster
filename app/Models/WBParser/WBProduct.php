<?php

namespace App\Models\WBParser;

use App\Models\Catalog\CProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property string|null $brand Бренд
 * @property int|null $quantity Количество доступное для продажи
 * @property int|null $quantityFull Количество полное
 * @property int|null $quantityNotInOrders Количество не в заказе
 * @property string|null $category Категория
 * @property string|null $subject Предмет
 * @property int|null $daysOnSite Количество дней на сайте
 * @property string|null $barcode Штрих-код
 * @property string|null $isSupply Договор поставки
 * @property string|null $isRealization Договор реализации
 * @property string|null $warehouseName Название склада
 * @property int|null $inWayToClient В пути к клиенту(штук)
 * @property int|null $inWayFromClient В пути от клиента(штук)
 * @property string|null $lastChangeDate Дата и время обновления информации в сервисе
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereDaysOnSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsSupply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereWarehouseName($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct withoutTrashed()
 * @property string|null $quantity_history История количества
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct baseProduct()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityHistory($value)
 * @property int|null $tvc_flow_id ID(Flow)
 * @property-read \App\Models\WBParser\WBBaseProduct|null $base_product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBOrder[] $wb_orders
 * @property-read int|null $wb_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales
 * @property-read int|null $wb_sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSupply[] $wb_supplies
 * @property-read int|null $wb_supplies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereTvcFlowId($value)
 * @property-read \App\Models\Catalog\CProduct $c_product
 * @property string|null $parser_history История парсинга
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereParserHistory($value)
 * @property int|null $search_pars_new Новая(текущая) позиция в поисковой выдаче
 * @property int|null $search_pars_old Старая позиция в поисковой выдаче
 * @property int|null $category_pars_new Новая(текущая) позиция в выдаче по категории
 * @property int|null $category_pars_old Старая позиция в выдаче по категории
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategoryParsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategoryParsOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSearchParsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSearchParsOld($value)
 * @property-read mixed $parsing
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBOrder[] $wb_orders_last_month
 * @property-read int|null $wb_orders_last_month_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales_last_month
 * @property-read int|null $wb_sales_last_month_count
 * @property float|null $conversion Конверсия за год
 * @property-read mixed $estimated_balance
 * @property-read mixed $parse_days_on_site
 * @property-read mixed $undersort_data
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereConversion($value)
 * @property int|null $rating Рейтинг(наш)
 * @property int|null $is_outgoing_goods Флаг -Уходящий товар-
 * @property int|null $is_new_goods Флаг -Новинка-
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsNewGoods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsOutgoingGoods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereRating($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBQuantityHistory[] $wb_quantity_histories
 * @property-read int|null $wb_quantity_histories_count
 */
class WBProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $undersort_data;

    protected $appends = ['parsing', 'estimated_balance', 'undersort_data'];

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ
    // Базовый товар
    public function base_product()
    {
        return $this->belongsTo(WBBaseProduct::class, 'nmId', 'nmId');
    }

    // Товар (наш)
    public function c_product()
    {
        return $this->hasOne(CProduct::class, 'tvc_flow_id', 'tvc_flow_id');
    }

    // Поставки TODO Отношение не поддерживает ленивую загрузку! Связь по двум полям!!!
    public function wb_supplies()
    {
        return $this->hasMany(WBSupply::class, 'nmId', 'nmId')
            ->where('techSize', '=', $this->techSize);
    }

    // Заказы  TODO Отношение не поддерживает ленивую загрузку! Связь по двум полям!!!
    public function wb_orders_OLD()
    {

        return $this->hasMany(WBOrder::class, 'nmId', 'nmId')
            ->where('techSize', '=', $this->techSize);
    }
    public function wb_orders()
    {

        return $this->hasMany(WBOrder::class, 'barcode', 'barcode');
    }

    // Заказы за год
    public function wb_orders_last_year()
    {
        return $this->wb_orders()
            ->where('order_at', '>', Carbon::now()->subDays(365));
    }

    // Продажи TODO Отношение не поддерживает ленивую загрузку! Связь по двум полям!!!
    public function wb_sales_OLD()
    {
        return $this->hasMany(WBSale::class, 'nmId', 'nmId')
            ->where('techSize', '=', $this->techSize);
    }
    public function wb_sales()
    {
        return $this->hasMany(WBSale::class, 'barcode', 'barcode');
    }

    // Продажи за год
    public function wb_sales_last_year()
    {
        return $this->wb_sales()
            ->where('sale_at', '>', Carbon::now()->subDays(365));
    }

    // Продажи за текущий месяц
    public function wb_sales_last_month()
    {
        $start = (new Carbon('first day of this month'))->toRfc3339String();

        return $this->wb_sales()
            ->whereDate('date', '>=', $start)
            ->orderBy('date', 'desc');
    }

    // Заказы за текущий месяц
    public function wb_orders_last_month()
    {
        $start = (new Carbon('first day of this month'))->toRfc3339String();

        return $this->wb_orders()
            ->whereDate('date', '>=', $start)
            ->orderBy('date', 'desc');
    }

    // История остатков
    public function wb_quantity_histories()
    {
        return $this->hasMany(WBQuantityHistory::class, 'wb_product_id', 'id');
    }


    //____________________ОТНОШЕНИЯ

    public function getConversionForLastYear()
    {
        $conversion = 0;

        $orders_last_year = $this->wb_orders_last_year()->count();
        $sales_last_year  = $this->wb_sales_last_year()->count();

        if ($orders_last_year) {
            $conversion = round($sales_last_year / $orders_last_year, 2);
        }

        if ($conversion > 1) {

            $conversion = 1;
        }

        return $conversion;
    }

    public function updateConversion()
    {
        $conversion       = $this->getConversionForLastYear();
        $this->conversion = $conversion;
        $this->save();
    }

    public function getUndersortDataAttribute()
    {
        $this->undersort_data = collect(
            array(
                'estimated_balance'  => null,
                'wb_orders'          => null,
                'orders_group'       => null,
                'wb_sales'           => null,
                'sales_group'        => null,
                'parse_days_on_site' => null,
                'orders_days_dif'    => null,
                'sales_days_dif'     => null,
                'product_need'       => null,
                'undersort_count'    => null,
            )
        );

        return $this->undersort_data;
    }

    public function getParsingAttribute()
    {
        $parser_history = $this->parser_history;

        if ($parser_history) {

            $parser_history = collect(json_decode($parser_history))->recursive();
        } else {

            $parser_history = null;
        }

        return $parser_history;
    }

    public function getEstimatedBalanceAttribute()
    {
        // Расчетный остаток =
        // Остаток доступный к заказу
        // + товар в пути ОТ клиента
        // + товар в пути к клиенту
        // * (1-0,6),
        // где 0,6 - константа (максимальное из наиболее вероятных по длительному периоду наблюдений значение конверсии)

        $quantity        = $this->getQuantity();
        $inWayFromClient = $this->getInWayFromClient();
        $inWayToClient   = $this->getInWayToClient();

        $estimated_balance = $quantity + $inWayFromClient + ($inWayToClient * (1 - 0.6));

        return floor($estimated_balance);
    }

    public function getParseDaysOnSiteAttributeOLD($base_date_start, $base_date_end)
    {
        $days_on_site = 0;

        $quantity_history = $this->getQuantityHistory();

        if ($quantity_history) {

            $quantity_history = collect(json_decode($quantity_history))->recursive();

            $quantity_history_by_date = $quantity_history->where('date', '>=', $base_date_start)->where('date', '<=', $base_date_end);

            foreach ($quantity_history_by_date as $day) {
                /**
                 * @var $day \Illuminate\Support\Collection
                 */

                // Количество доступное для продажи
                $quantity = $day->get('q', 0);

                if ($quantity) {
                    $days_on_site++;
                }
            }
        }

        return $days_on_site;
    }

    public function getParseDaysOnSiteAttribute($base_date_start, $base_date_end)
    {
        $days_on_site = $this->wb_quantity_histories
            ->where('parsed_at', '>=', $base_date_start)
            ->where('parsed_at', '<=', $base_date_end)
            ->where('q', '>', 0)
            ->count();

        return $days_on_site;
    }

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
    public function getTechSize()
    {
        return $this->techSize;
    }

    /**
     * @return null|string
     */
    public function getBrand()
    {
        return $this->brand;
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
    public function getDaysOnSite()
    {
        return $this->daysOnSite;
    }

    /**
     * @return null|string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return null|string
     */
    public function getisSupply()
    {
        return $this->isSupply;
    }

    /**
     * @return null|string
     */
    public function getisRealization()
    {
        return $this->isRealization;
    }

    /**
     * @return null|string
     */
    public function getWarehouseName()
    {
        return $this->warehouseName;
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
     * @return null|string
     */
    public function getLastChangeDate()
    {
        return $this->lastChangeDate;
    }

    /**
     * @return null|string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
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
    public function getQuantityHistory()
    {
        return $this->quantity_history;
    }

    /**
     * @return null|string
     */
    public function getParserHistory()
    {
        return $this->parser_history;
    }

    /**
     * @return int|null
     */
    public function getSearchParsNew()
    {
        return $this->search_pars_new;
    }

    /**
     * @return int|null
     */
    public function getSearchParsOld()
    {
        return $this->search_pars_old;
    }

    /**
     * @return int|null
     */
    public function getCategoryParsNew()
    {
        return $this->category_pars_new;
    }

    /**
     * @return int|null
     */
    public function getCategoryParsOld()
    {
        return $this->category_pars_old;
    }

    /**
     *
     * @return  \Illuminate\Support\Collection | bool
     */
    public function getParserData()
    {
        return $this->parsing;
    }

    /**
     * @return mixed
     */
    public function getUndersortData()
    {
        return $this->undersort_data;
    }

    /**
     * @return mixed
     */
    public function getConversion()
    {
        return $this->conversion;
    }


    //____________________GETTERS


}

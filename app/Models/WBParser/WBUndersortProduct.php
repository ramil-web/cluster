<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBUndersortProduct
 *
 * @property int $id
 * @property int|null $undersort_id ID подсортировки
 * @property int|null $nmId Код WB
 * @property string|null $barcode Штрих-код
 * @property string|null $warehouseName Название склада
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property float|null $conversion Конверсия за год
 * @property int|null $estimated_balance Расчетный остаток
 * @property int|null $days_on_site Кол.во дней на сайте(б\п)
 * @property int|null $orders Заказы за (б\п)
 * @property int|null $sales Продажи за (б\п)
 * @property int|null $orders_last_year Заказы за год
 * @property int|null $sales_last_year Продажи за год
 * @property int|null $product_need Потребность в товаре
 * @property int|null $undersort_count Товар к подсортировке
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersortProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereDaysOnSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereEstimatedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereOrdersLastYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereProductNeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereSalesLastYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereUndersortCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereUndersortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersortProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersortProduct withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $base_product_id ID w_b_base_product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersortProduct whereBaseProductId($value)
 */
class WBUndersortProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [];


    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ


    //____________________ОТНОШЕНИЯ

    public function getOrdersDivideDaysOnSite()
    {
        $res          = 0;
        $days_on_site = $this->getDaysOnSite();
        $orders       = $this->getOrders();

        if ($days_on_site > 0) {
            $res = $orders / $days_on_site;
        }

        return $res;
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
     * @return null|string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return null|string
     */
    public function getWarehouseName()
    {
        return $this->warehouseName;
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
     * @return float|null
     */
    public function getConversion()
    {
        return $this->conversion;
    }

    /**
     * @return int|null
     */
    public function getEstimatedBalance()
    {
        return $this->estimated_balance;
    }

    /**
     * @return int|null
     */
    public function getDaysOnSite()
    {
        return $this->days_on_site;
    }

    /**
     * @return int|null
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @return int|null
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @return int|null
     */
    public function getOrdersLastYear()
    {
        return $this->orders_last_year;
    }

    /**
     * @return int|null
     */
    public function getSalesLastYear()
    {
        return $this->sales_last_year;
    }

    /**
     * @return int|null
     */
    public function getProductNeed()
    {
        return $this->product_need;
    }

    /**
     * @return int|null
     */
    public function getUndersortCount()
    {
        return $this->undersort_count;
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

    //____________________GETTERS
}

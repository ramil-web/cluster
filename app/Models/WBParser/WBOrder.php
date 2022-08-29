<?php

namespace App\Models\WBParser;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBOrder
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $number Номер заказа WB
 * @property string|null $oblast Область
 * @property string|null $warehouseName Склад отгрузки
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $subject Предмет
 * @property string|null $category Категория
 * @property string|null $brand Бренд
 * @property int|null $quantity Количество
 * @property string|null $techSize Размер
 * @property float|null $totalPrice Цена до согласованной скидки\промо\спп
 * @property float|null $discountPercent Согласованный итоговый дисконт
 * @property string|null $barcode Штрих-код
 * @property string|null $incomeID Номер поставки
 * @property string|null $odid Уникальный идентификатор позиции заказа
 * @property string|null $date Дата заказа
 * @property string|null $lastChangeDate Дата время обновления информации в сервисе
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereIncomeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOblast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOdid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 * @property-read mixed $format_date
 * @property int|null $isCancel isCancel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereIsCancel($value)
 * @property string|null $order_at Дата Заказа
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOrderAt($value)
 */
class WBOrder extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = ['format_date'];

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ
    // Товары WB (Размеры)
    public function wb_products()
    {
        return $this->belongsTo(WBProduct::class, 'nmId', 'nmId');
    }
    //____________________ОТНОШЕНИЯ

    public function getFormatDateAttribute()
    {
        $format_date = $date = $this->getDate();

        if ($date) {

            $format_date = Carbon::createFromFormat("Y-m-d\TH:i:s",$date)->format('Y-m-d');
        }

        return $format_date;
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return null|string
     */
    public function getOblast()
    {
        return $this->oblast;
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
    public function getSubject()
    {
        return $this->subject;
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
     * @return null|string
     */
    public function getTechSize()
    {
        return $this->techSize;
    }

    /**
     * @return float|null
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @return float|null
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
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
    public function getIncomeID()
    {
        return $this->incomeID;
    }

    /**
     * @return null|string
     */
    public function getOdid()
    {
        return $this->odid;
    }

    /**
     * @return null|string
     */
    public function getDate()
    {
        return $this->date;
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
    public function getOrderAt()
    {
        return $this->order_at;
    }
    //____________________GETTERS


}

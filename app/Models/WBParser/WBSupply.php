<?php

namespace App\Models\WBParser;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBSupply
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $warehouseName Название склада
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property int|null $quantity Количество
 * @property string|null $totalPrice Цена из УПД
 * @property string|null $number Номер УПД
 * @property int|null $incomeId Номер поставки
 * @property string|null $barcode Штрих-код
 * @property string|null $date Дата поступления
 * @property string|null $lastChangeDate Дата и время обновления информации в сервисе
 * @property string|null $dateClose Дата принятия(закрытия) в WB
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDateClose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 * @property-read mixed $format_date
 */
class WBSupply extends Model
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
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return null|string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @return null|string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int|null
     */
    public function getIncomeId()
    {
        return $this->incomeId;
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
    public function getDateClose()
    {
        return $this->dateClose;
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
   //____________________GETTERS

}

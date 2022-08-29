<?php

namespace App\Models\WBParser;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBSale
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $number Номер документа
 * @property string|null $promoCodeDiscount Согласованный промокод
 * @property string|null $warehouseName Склад отгрузки
 * @property string|null $countryName Страна
 * @property string|null $oblastOkrugName Округ
 * @property string|null $regionName Регион
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property string|null $barcode Штрих-код
 * @property int|null $quantity Количество
 * @property float|null $totalPrice Начальная розничная цена товара
 * @property float|null $discountPercent Согласованная скидка на товар
 * @property string|null $isSupply Договор поставки
 * @property string|null $isRealization Договор реализации
 * @property string|null $orderId Номер исходного заказа
 * @property int|null $incomeID Номер поставки
 * @property string|null $saleID Уникальный идентификатор продажи\ возврата(SXXXX-продажа,RXXXX- возврат,DXXXX-доплата)
 * @property string|null $odid Уникальный идентификатор позиции заказа
 * @property string|null $spp Согласованная скидка постоянного покупателя(СПП)
 * @property float|null $forPay К перечислению поставщику
 * @property float|null $finishedPrice Фактическая цена из заказа(с учетом всех скидок, включая и от WB)
 * @property float|null $priceWithDisc Цена от которой считается вознаграждение поставщика forpay(с учетом всех согласованных скидок)
 * @property string|null $subject Предмет
 * @property string|null $category Категория
 * @property string|null $brand Бренд
 * @property string|null $date Дата продажи
 * @property string|null $lastChangeDate Дата время обновления информации в сервисе
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereFinishedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereForPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIncomeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIsRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIsSupply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOblastOkrugName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOdid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale wherePriceWithDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale wherePromoCodeDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSaleID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 * @property-read mixed $format_date
 * @property string|null $sale_at Дата Продажи
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSaleAt($value)
 */
class WBSale extends Model
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
    public function getPromoCodeDiscount()
    {
        return $this->promoCodeDiscount;
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
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @return null|string
     */
    public function getOblastOkrugName()
    {
        return $this->oblastOkrugName;
    }

    /**
     * @return null|string
     */
    public function getRegionName()
    {
        return $this->regionName;
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
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
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
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return int|null
     */
    public function getIncomeID()
    {
        return $this->incomeID;
    }

    /**
     * @return null|string
     */
    public function getSaleID()
    {
        return $this->saleID;
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
    public function getSpp()
    {
        return $this->spp;
    }

    /**
     * @return float|null
     */
    public function getForPay()
    {
        return $this->forPay;
    }

    /**
     * @return float|null
     */
    public function getFinishedPrice()
    {
        return $this->finishedPrice;
    }

    /**
     * @return float|null
     */
    public function getPriceWithDisc()
    {
        return $this->priceWithDisc;
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
     * @return null|string
     */
    public function getSaleAt()
    {
        return $this->sale_at;
    }
    //____________________GETTERS


}

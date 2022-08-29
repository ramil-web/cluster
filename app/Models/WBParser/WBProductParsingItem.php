<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBProductParsingItem
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $warehouseName Название склада
 * @property int|null $quantity Количество доступное для продажи(all sizes)
 * @property int|null $quantityFull Количество полное(all sizes)
 * @property int|null $quantityNotInOrders Количество не в заказе(all sizes)
 * @property int|null $inWayToClient В пути к клиенту(all sizes)
 * @property int|null $inWayFromClient В пути от клиента(all sizes)
 * @property int|null $category_place Позиция в выдаче по категории
 * @property int|null $search_place Позиция в поисковой выдаче
 * @property string|null $category_title Название категории
 * @property string|null $search_word Поисковое слово
 * @property string|null $date_rfc3339 Дата парсинга в формате Rfc3339
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCategoryPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCategoryTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereDateRfc3339($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereSearchPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereSearchWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBBaseProduct|null $base_product
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property int|null $comments_count Кол-во комментариев
 * @property int|null $stars_count Рейтинг
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereStarsCount($value)
 */
class WBProductParsingItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ
    // Базовый товар
    public function base_product()
    {
        return $this->belongsTo(WBBaseProduct::class, 'nmId', 'nmId');
    }
    //____________________ОТНОШЕНИЯ

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
     * @return int|null
     */
    public function getCategoryPlace()
    {
        return $this->category_place;
    }

    /**
     * @return int|null
     */
    public function getSearchPlace()
    {
        return $this->search_place;
    }

    /**
     * @return null|string
     */
    public function getCategoryTitle()
    {
        return $this->category_title;
    }

    /**
     * @return null|string
     */
    public function getSearchWord()
    {
        return $this->search_word;
    }

    /**
     * @return null|string
     */
    public function getDateRfc3339()
    {
        return $this->date_rfc3339;
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
}

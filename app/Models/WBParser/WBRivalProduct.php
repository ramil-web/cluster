<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBRivalProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property int|null $category_id ID категории парсинга
 * @property int|null $category_place Место в выдаче по категории
 * @property string|null $brand_name Название бренда
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property string|null $comments_count Кол-во комментариев
 * @property string|null $stars_count Рейтинг
 * @property string|null $parsed_at Дата парсинга
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCategoryPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereParsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereStarsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $sizes Размеры
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereSizes($value)
 */
class WBRivalProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @return int|null
     */
    public function getCategoryPlace()
    {
        return $this->category_place;
    }

    /**
     * @return null|string
     */
    public function getBrandName()
    {
        return $this->brand_name;
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
     * @return null|string
     */
    public function getCommentsCount()
    {
        return $this->comments_count;
    }

    /**
     * @return null|string
     */
    public function getStarsCount()
    {
        return $this->stars_count;
    }

    /**
     * @return null|string
     */
    public function getParsedAt()
    {
        return $this->parsed_at;
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
    public function getSizes()
    {
        return $this->sizes;
    }

}

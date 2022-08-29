<?php

namespace App\Models\Catalog;

use App\Models\PageModules\File;
use App\Models\Promotion\PrAssortmentPromotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Catalog\CBrand
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property null|string $title Название
 * @property string|null $short_title Короткое название
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Catalog\CBrandOption $cbrandoption
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProduct[] $cproducts
 * @property-read int|null $cproducts_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereShortTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrand withoutTrashed()
 * @mixin \Eloquent
 */
class CBrand extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['cbrandoption'];

    protected $selected = false;

    protected $disabled = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ

    // Товары
    public function cproducts()
    {
        return $this->hasMany(CProduct::class, 'brand_flow_id', 'flow_id');
    }

    // Опции бренда(иконка, описание)
    public function cbrandoption()
    {
        return $this->hasOne(CBrandOption::class, 'brand_flow_id', 'flow_id')
            ->withDefault();
    }
    //____________________ОТНОШЕНИЯ

    //^^^^^^^^^^^^^^^^^^^^GETTERS

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFlowId(): int
    {
        return $this->flow_id;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getShortTitle()
    {
        return $this->short_title;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->short_title;
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
    public function getIcon()
    {
        return $this->cbrandoption->icon_id;
    }

    /**
     * @return null|string
     */
    public function getText()
    {
        return $this->cbrandoption->getText();
    }

    /**
     * @return CProduct[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProducts()
    {
        return $this->cproducts;
    }


    //____________________GETTERS

    //^^^^^^^^^^^^^^^^^^^^Мутаторы
    //^^^^^^^^^^^^^^^^^^^^Title
    /**
     * @return null|string
     */
    public function getTitleAttribute($value)
    {
        return ucfirst(mb_strtolower($value));
    }
    //____________________Title
    //____________________Мутаторы
}

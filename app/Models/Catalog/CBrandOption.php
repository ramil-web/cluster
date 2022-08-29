<?php

namespace App\Models\Catalog;

use App\Models\PageModules\Icon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Catalog\CBrandOption
 *
 * @property int $id
 * @property int|null $brand_flow_id ID бренда(Flow)
 * @property int|null $icon_id Иконка бренда
 * @property string|null $brand_title Название бренда
 * @property string|null $text Описание бренда
 * @property string|null $image Основное изображение
 * @property int|null $sort Сортировка
 * @property int|null $is_active Флаг активности
 * @property int|null $for_main Флаг Для главной
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\PageModules\Icon|null $icon
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereBrandFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereBrandTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereForMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption withoutTrashed()
 * @mixin \Eloquent
 */
class CBrandOption extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = (int)$value ? (int)$value : null;
    }

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ

    /**
     * Иконка.
     */
    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    /**
     * @return int|null
     */
    public function getIconId()
    {
        return $this->icon_id;
    }

    /**
     * @return null|string
     */
    public function getBrandTitle()
    {
        return $this->brand_title;
    }

    /**
     * @return null|string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return null|string
     */
    public function getImage()
    {
        return $this->image;
    }
    //____________________ОТНОШЕНИЯ


}

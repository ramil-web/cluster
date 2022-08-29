<?php

namespace App\Models\Blocks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcSlider
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderImage[] $blc_slider_images
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $blc_slider_images_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider query()
 */
class BlcSlider extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function createNew($type, $page_type_id, $page_id, $sort) {
        $this->type         = $type;
        $this->page_type_id = $page_type_id;
        $this->page_id      = $page_id;
        $this->sort         = $sort;
        $this->save();

        return $this;
    }

    public function page_type()
    {
        return $this->belongsTo('App\Models\PageType');
    }

    public function blc_slider_images()
    {
        return $this->hasMany('App\Models\Blocks\BlcSliderImage');
    }
}

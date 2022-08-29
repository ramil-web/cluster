<?php

namespace App\Models\Blocks;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcSliderImage
 *
 * @property int $id
 * @property int $blc_slider_id ID блока слайдера
 * @property string $path Путь изображения
 * @property string $ext Расширение изображения
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Blocks\BlcSlider $blc_slider
 * @property-read mixed $src
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereBlcSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage query()
 */
class BlcSliderImage extends Model
{
    /**
     * @var array
     */
    protected $appends = ['src'];
    public $src = '';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->src = $this->get_src();
    }

    //https://stackoverflow.com/questions/31241419/add-custom-attribute-in-eloquent-model
    public function getSrcAttribute()
    {
        return $this->get_src();
    }

    //Атрибут добавляется только во время выполнения toJson(или передачи данных на страницу)
    public function get_src()
    {
        $src = '/default.png';
        if (!empty($this->path) && !empty($this->ext)) {
            $src = $this->path . 'image_' . $this->id . '.' . $this->ext;
        }

        if(!File::exists(public_path($src))){
            $src = '/default.png';
        }

        return $src;
    }

    public function blc_slider()
    {
        return $this->belongsTo('App\Models\Blocks\BlcSlider');
    }

    public function slider_image_remove()
    {
        $filename = public_path($this->path . 'image_' . $this->id . '.' . $this->ext);
        File::delete($filename);
        $this->delete();
    }
}

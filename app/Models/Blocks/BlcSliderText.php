<?php

namespace App\Models\Blocks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcSliderText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $resize_width Ширина изображений слайдера
 * @property string|null $resize_height Высота изображений слайдера
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $blc_image_texts
 * @property-read mixed $image_text_list
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereResizeHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereResizeWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $blc_image_texts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText query()
 */
class BlcSliderText extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates           = ['deleted_at'];
    protected $appends         = ['image_text_list'];
    public    $image_text_list = '';

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public function createNew($type, $version, $page_type_id, $page_id, $resize_width, $resize_height, $sort) {

        $image_text_block = (new BlcImageText)->createNew('component', 'default', $page_type_id, $page_id, $resize_width, $resize_height, $sort);

        $this->type          = $type;
        $this->version       = $version;
        $this->page_type_id  = $page_type_id;
        $this->page_id       = $page_id;
        $this->resize_width  = $resize_width;
        $this->resize_height = $resize_height;
        $this->sort          = $sort;

        $this->save();

        $this->blc_image_texts()->attach($image_text_block->id);

        return $this;
    }

    public function blc_image_texts() {
        return $this->belongsToMany(BlcImageText::class);
    }

    public function getImageTextListAttribute() {
        return $this->blc_image_texts;
    }

    public function addNewSliderTextItem() {

        $image_text_block = (new BlcImageText)->createNew('component', 'default', $this->page_type_id, $this->page_id, $this->resize_width, $this->resize_height, 0);
        $this->blc_image_texts()->attach($image_text_block->id);

        return $image_text_block;
    }
}

<?php

namespace App\Models\Blocks;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcImageText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property int $blc_image_id ID блока изображения
 * @property int $blc_text_id ID текстового блока
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $image
 * @property-read mixed $text
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereBlcImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereBlcTextId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText query()
 */
class BlcImageText extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates   = ['deleted_at'];
    protected $appends = ['image', 'text'];
    public    $image   = '';
    public    $text    = '';

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public function createNew($type, $version, $page_type_id, $page_id, $resize_width, $resize_height, $sort) {

        $image_block = (new BlcImage)->createNew('component', $page_type_id, $page_id, 'default', 'png', $resize_width, $resize_height, 0);
        $text_block  = (new BlcText)->createNew('component', $page_type_id, $page_id, '', 0);

        $this->type         = $type;
        $this->version      = $version;
        $this->page_type_id = $page_type_id;
        $this->page_id      = $page_id;
        $this->blc_image_id = $image_block->id;
        $this->blc_text_id  = $text_block->id;
        $this->sort         = $sort;
        $this->save();

        return $this;
    }

    public function getImageAttribute() {
        return $this->blc_image();
    }

    public function getTextAttribute() {
        return $this->blc_text();
    }

    public function blc_text() {
        return BlcText::find($this->blc_text_id);
    }

    public function blc_image() {
        return BlcImage::find($this->blc_image_id);
    }
}

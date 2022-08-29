<?php

namespace App\Models\Blocks;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcImage
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $name Название изображения
 * @property string|null $ext Разрешение изображения
 * @property string|null $alt Альт текст изображения
 * @property string|null $resize_width Ширина требуемого изображения
 * @property string|null $resize_height Высота требуемого изображения
 * @property string|null $width Ширина оригинального изображения
 * @property string|null $height Высота оригинального изображения
 * @property string|null $x Координаты для ресайза
 * @property string|null $y Координаты для ресайза
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $original_src
 * @property-read mixed $src
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereResizeHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereResizeWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage query()
 */
class BlcImage extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates        = [ 'deleted_at' ];
    protected $appends      = [ 'src', 'original_src' ];
    public    $src          = '';
    public    $original_src = '';

    public function __construct( array $attributes = array() ) {
        parent::__construct( $attributes );
        $this->src = $this->get_src();
    }

    public function createNew($type, $page_type_id, $page_id, $name, $ext, $resize_width, $resize_height, $sort) {
        $this->type          = $type;
        $this->page_type_id  = $page_type_id;
        $this->page_id       = $page_id;
        $this->name          = $name;
        $this->ext           = $ext;
        $this->resize_width  = $resize_width;
        $this->resize_height = $resize_height;
        $this->sort          = $sort;
        $this->save();
        
        return $this;
    }

    //https://stackoverflow.com/questions/31241419/add-custom-attribute-in-eloquent-model
    public function getSrcAttribute() {
        return $this->get_src();
    }

    public function getOriginalSrcAttribute() {
        return $this->get_original_src();
    }


    public function page_type() {
        return $this->belongsTo( 'App\Models\PageType' );
    }

    public function get_src() {
        $src = '/default.png';
        if ( !empty( $this->page_type_id ) && !empty( $this->page_id ) && !empty( $this->id ) && !empty( $this->ext ) ) {

            $src = '/images/pages/blocks/' . $this->page_type_id . '/' . $this->page_id . '/' . $this->id . '/crop_img.' . $this->ext;
        }

        if ( !File::exists( public_path( $src ) ) ) {
            $src = '/default.png';
        }

        return $src;
    }

    public function get_original_src() {
        $src = '/default.png';
        if ( !empty( $this->page_type_id ) && !empty( $this->page_id ) && !empty( $this->id ) ) {

            $src = '/images/pages/blocks/' . $this->page_type_id . '/' . $this->page_id . '/' . $this->id . '/original.png';
        }

        if ( !File::exists( public_path( $src ) ) ) {
            $src = '/default.png';
        }

        return $src;
    }
}

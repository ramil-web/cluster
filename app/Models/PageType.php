<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PageType
 *
 * @property int                                                                                    $id
 * @property string                                                                                 $name  Название страницы
 * @property string                                                                                 $alias Псевдоним страницы
 * @property bool                                                                                   $published
 * @property \Carbon\Carbon                                                                         $created_at
 * @property \Carbon\Carbon                                                                         $updated_at
 * @property string                                                                                 $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int                                                                                    $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType whereIsActive($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlockType[]           $block_types
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImage[]     $block_image_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSlider[]    $block_slider_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcText[]      $block_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sidebar[]                    $sidebars
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $block_image_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderText[] $block_slider_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImage[] $blc_images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $blc_image_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderText[] $blc_slider_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSlider[] $blc_sliders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcText[] $blc_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcGoogleMap[] $blc_google_maps
 * @property-read int|null $blc_google_maps_count
 * @property-read int|null $blc_image_texts_count
 * @property-read int|null $blc_images_count
 * @property-read int|null $blc_slider_texts_count
 * @property-read int|null $blc_sliders_count
 * @property-read int|null $blc_texts_count
 * @property-read int|null $block_types_count
 * @property-read int|null $sidebars_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType query()
 */
class PageType extends Model {

    /**
     * Сайдбары
     */
    public function sidebars() {
        return $this->belongsToMany('App\Models\Sidebar');
    }

    /**
     * Блоки страницы
     */
    public function block_types() {
        return $this->belongsToMany('App\Models\Blocks\BlockType');
    }

    public function blc_texts() {
        return $this->hasMany('App\Models\Blocks\BlcText')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }

    public function blc_images() {
        return $this->hasMany('App\Models\Blocks\BlcImage')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }

    public function blc_sliders() {
        return $this->hasMany('App\Models\Blocks\BlcSlider')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }

    public function blc_image_texts() {
        return $this->hasMany('App\Models\Blocks\BlcImageText')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }

    public function blc_slider_texts() {
        return $this->hasMany('App\Models\Blocks\BlcSliderText')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }

    public function blc_google_maps() {
        return $this->hasMany('App\Models\Blocks\BlcGoogleMap')->where('type', '!=', 'component')->orderBy('sort', 'asc');
    }


    public function blc_text_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_texts()->where('page_id', $page)->get();

            return $resp;
        }
    }

    public function blc_image_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_images()->where('page_id', $page)->get();

            return $resp;
        }
    }

    public function blc_slider_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_sliders()->where('page_id', $page)->with('blc_slider_images')->get();

            return $resp;
        }
    }

    public function blc_image_text_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_image_texts()->where('page_id', $page)
                         ->get();

            return $resp;
        }
    }

    public function blc_slider_text_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_slider_texts()->where('page_id', $page)
                         ->get();

            return $resp;
        }
    }

    public function blc_google_map_by_page($page = 0) {
        if ( $page ) {
            $resp = $this->blc_google_maps()->where('page_id', $page)
                         ->with('google_map_points')
                         ->get();

            return $resp;
        }
    }
}

<?php

namespace App\Http\Controllers\PageBlocks;

use App\Http\Controllers\Controller;
use App\Models\Blocks\BlcGoogleMap;
use App\Models\Blocks\BlcImage;
use App\Models\Blocks\BlcImageText;
use App\Models\Blocks\BlcSlider;
use App\Models\Blocks\BlcSliderImage;
use App\Models\Blocks\BlcSliderText;
use App\Models\Blocks\BlcText;
use App\Models\Blocks\Components\GoogleMapPoint;
use App\Models\PageType;
use Exception;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use View;

/**
 * Class PageBlocksAdminController
 *
 * @package App\Http\Controllers\PageBlocks
 */
class PageBlocksAdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     *
     * @return  mixed
     */
    public function getPageBlocks(Request $request) {
        $page_alias = $request->route('alias');
        //если нет id предполагается что это одна страница(главная, контакты) и id = 1
        $page_id = $request->route('id') ? $request->route('id') : 1;

        $page          = PageType::where('alias', $page_alias)->with('block_types')->first();
        $page_blocks   = PageBlocksAdminController::getPageBlocksAdmin($page, $page_id);
        $page->page_id = $page_id;

        return view('admin.pages.all_pages.index', [
            'page'        => $page,
            'page_blocks' => $page_blocks]);
    }

    /**
     *Попытка уйти от iframe(пока не до конца удачно)
     * @return  mixed
     * если нет id предполагается что это одна страница(главная, контакты) и id = 1
     *
     */
    public static function getPageContentBlocksAdmin($page_alias, $page_id = 1) {

        $page          = PageType::where('alias', $page_alias)->with('block_types')->first();
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         */
        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . '_by_page';

            if ( $page->{$method}($page_id) ) {
                $content_blocks[] = $page->{$method}($page_id);
            }
        }

        $page->content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()
                                                        ->all();
        $page->page_id        = $page_id;

        return $page;
    }

    /**
     * @param \App\Models\PageType $page
     * @param string               $page_id
     *
     * @return mixed
     */
    public static function getPageBlocksAdmin(PageType $page, $page_id) {
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         */

        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . '_by_page';

            if ( $page->{$method}($page_id) ) {
                $content_blocks[] = $page->{$method}($page_id);
            }
        }

        $page->content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()
                                                        ->all();
        $page->page_id        = $page_id;
        $view                 = View::make('admin.blocks.blocks', ['page' => $page]);

        return $view;
    }

    /**
     * @param \App\Models\PageType $page
     * @param string               $page_id
     *
     * @return mixed
     */
    public static function getPageBlocksAdminSort(PageType $page, $page_id) {
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         */

        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . '_by_page';

            if ( $page->{$method}($page_id) ) {
                $content_blocks[] = $page->{$method}($page_id);
            }
        }

        return collect($content_blocks)->collapse()->sortBy('sort')->values()->all();
    }

    /**
     * @return mixed
     */
    public static function getMainBlock(Request $request) {
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         * @var \App\Models\PageType         $page
         */

        if ( $request->ajax() ) {
            $uri = $request->get('page_alias');
        } else {
            $uri = $request->path();
        }

        $page = PageType::where('alias', $uri)->with('block_types')->first();

        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . 's';

            if ( $page->{$method} ) {
                $content_blocks[] = $page->{$method}->where('page_id', 1);
            }
        }

        $page->content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()
                                                        ->all();
        $sort                 = collect($page->content_blocks)->max('sort');
        $page->page_id        = 1;

        $page->start_block = [
            'content'      => '',
            'block_id'     => 0,
            'page_type_id' => $page->id,
            'page_id'      => $page->page_id,
            'sort'         => $sort + 1,
        ];

        $num = rand();

        return view('blocks.main', ['num' => $num, 'page' => $page, 'ajax' => $request->ajax()]);
    }


    /**
     * @return mixed
     */
    public static function saveTextBlock() {
        $type         = request('type', 'text');
        $block_id     = request('block_id');
        $page_type_id = request('page_type_id');
        $page_id      = request('page_id');
        $content      = htmlspecialchars_decode(request('content'));
        $sort         = request('sort');

        if ( !$sort ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        if ( $block_id ) {
            $text_block = BlcText::find($block_id);
        } else {
            $text_block = new BlcText;
        }

        $text_block = $text_block->createNew($type, $page_type_id, $page_id, $content, $sort);

        return ['text_block' => $text_block];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function saveImageBlock() {
        $block_id      = request('block_id');
        $page_type_id  = request('page_type_id');
        $page_id       = request('page_id');
        $name          = request('name', 'default');
        $ext           = request('ext', 'png');
        $resize_width  = request('resize_width', '700');
        $resize_height = request('resize_height', '400');
        $sort          = request('sort');

        if ( !$sort ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        if ( $block_id ) {
            $image_block = BlcImage::find($block_id);
        } else {
            $image_block = new BlcImage;
        }

        $image_block = $image_block->createNew('image', $page_type_id, $page_id, $name, $ext, $resize_width, $resize_height, $sort);

        //$aaa = $image_block;
        return ['image_block' => $image_block];
    }

    /**
     * @return mixed
     */
    public static function imageBlockUploadImage(Request $request) {
        $image_block  = '';
        $path         = '/images/pages/blocks/';
        $type         = request('type', 'image');
        $page_type_id = request('page_type_id');
        $page_id      = request('page_id');
        $block_id     = request('block_id');
        $width        = request('width');
        $height       = request('height');
        $x            = request('x');
        $y            = request('y');
        $file_name    = 'crop_img';
        $cropped      = $request->cropped;
        $original     = $request->original;

        if ( File::exists($cropped) ) {
            $ext       = $request->cropped->extension();
            $path      = $path . $page_type_id . '/' . $page_id . '/' . $block_id . '/';
            $file_name = $file_name . '.' . $ext;

            if ( !File::exists(public_path($path)) ) {
                File::makeDirectory(public_path($path), $mode = 0777, true, true);
            }

            try {
                Image::make($cropped->getRealPath())->save(public_path($path . $file_name));

                if ( $block_id ) {
                    $image_block         = BlcImage::find($block_id);
                    $image_block->type   = $type;
                    $image_block->ext    = $ext;
                    $image_block->width  = $width;
                    $image_block->height = $height;
                    $image_block->x      = $x;
                    $image_block->y      = $y;
                    $image_block->save();
                }
            } catch ( Exception $e ) {
                return ['error' => $e->getMessage()];
            }
        }

        $path = '/images/pages/blocks/';

        if ( File::exists($original) ) {
            $path      = $path . $page_type_id . '/' . $page_id . '/' . $block_id . '/';
            $file_name = 'original.png';

            if ( !File::exists(public_path($path)) ) {
                File::makeDirectory(public_path($path), $mode = 0777, true, true);
            }

            try {
                Image::make($original->getRealPath())->save(public_path($path . $file_name));
            } catch ( Exception $e ) {
                return ['error' => $e->getMessage()];
            }
        }

        $aaa = 0;

        return ['image_block' => $image_block];
    }

    /**
     * @return mixed
     */
    public static function sliderBlockUploadImage(Request $request) {
        $image_block  = '';
        $page_type_id = request('page_type_id');
        $page_id      = request('page_id');
        $block_id     = request('block_id');
        $width        = request('width');
        $height       = request('height');
        $path         = '/images/pages/blocks/' . $page_type_id . '/' . $page_id . '/slider_' . $block_id .
                        '/';

        $files     = $request->files;
        $image_arr = array();

        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $file
         */
        foreach ( $files as $key => $file ) {
            $slider_image = new BlcSliderImage;
            $ext          = $file->getClientOriginalExtension();
            $real_path    = $file->getRealPath();

            $slider_image->blc_slider_id = $block_id;
            $slider_image->path          = $path;
            $slider_image->ext           = $ext;
            $slider_image->save();

            $image_arr[] = $slider_image;

            $image_id  = $slider_image->id;
            $file_name = 'image_' . $image_id . '.' . $ext;

            if ( !File::exists(public_path($path)) ) {
                File::makeDirectory(public_path($path), $mode = 0777, true, true);
            }

            try {
                Image::make($real_path)->resize($width, $height)->save(public_path($path .
                                                                                   $file_name));
            } catch ( Exception $e ) {
                return ['error' => $e->getMessage()];
            }

            $aaa = 0;
        }

        return ['image_arr' => $image_arr];
    }

    /**
     * @return mixed
     */
    public static function saveSliderBlock() {
        $type         = request('type', 'slider');
        $block_id     = request('block_id');
        $page_type_id = request('page_type_id');
        $page_id      = request('page_id');
        $sort         = request('sort');

        if ( !$sort ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        if ( $block_id ) {
            $slider_block = BlcSlider::find($block_id);
        } else {
            $slider_block = new BlcSlider;
        }
        $slider_block = $slider_block->createNew($type, $page_type_id, $page_id, $sort);

        return ['slider_block' => $slider_block];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function saveImageTextBlock() {
        $version       = request('version', 'default');
        $page_type_id  = request('page_type_id');
        $page_id       = request('page_id');
        $resize_width  = request('resize_width', '700');
        $resize_height = request('resize_height', '400');
        $sort          = request('sort');

        if ( !$sort ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        $image_text_block = (new BlcImageText)->createNew('image_text', $version, $page_type_id, $page_id, $resize_width, $resize_height, $sort);

        return ['image_text_block' => $image_text_block];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function dellImageTextBlock($id = 0) {
        $block_id = request('block_id');
        if ( $id ) {
            $block_id = $id;
        }
        $image_text_block = BlcImageText::find($block_id);

        $image = $image_text_block->blc_image();
        $text  = $image_text_block->blc_text();
        if ( $image ) {
            PageBlocksAdminController::dellImageBlock($image->id);
        }
        if ( $text ) {
            PageBlocksAdminController::dellTextBlock($text->id);
        }

        $image_text_block->delete();
    }

    /**
     * @return mixed
     */
    public static function saveSliderTextBlock() {
        $version       = request('version', 'default');
        $page_type_id  = request('page_type_id');
        $page_id       = request('page_id');
        $resize_width  = request('resize_width', '700');
        $resize_height = request('resize_height', '400');
        $sort          = request('sort');

        if ( !$sort ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        $slider_text_block = (new BlcSliderText)->createNew('slider_text', $version, $page_type_id, $page_id, $resize_width, $resize_height, $sort);

        return ['slider_text_block' => $slider_text_block];
        //        $aaa = 0;
    }

    public function addNewSliderTextItem(Request $request) {

        $block_id          = request('block_id');
        $slider_text_block = BlcSliderText::find($block_id);

        return ['image_text_block' => $slider_text_block->addNewSliderTextItem()];
    }

    /**
     * @return mixed
     */
    public static function dellSliderTextBlock() {
        $block_id          = request('block_id');
        $slider_text_block = BlcSliderText::find($block_id);

        $image_text_blocks = $slider_text_block->blc_image_texts;

        foreach ( $image_text_blocks as $image_text_block ) {
            //$slider_text_block->blc_image_texts()->detach($image_text_block->id);
            PageBlocksAdminController::dellImageTextBlock($image_text_block->id);
        }

        $slider_text_block->delete();

        return ['success' => true];
    }

    /**
     * @return mixed
     */
    public static function dellTextBlock($id = 0) {
        $block_id = request('block_id');
        if ( $id ) {
            $block_id = $id;
        }
        $text_block = BlcText::find($block_id);

        $text_block->delete();
    }

    /**
     * @return mixed
     */
    public static function dellImageBlock($id = 0) {
        $block_id = request('block_id');
        if ( $id ) {
            $block_id = $id;
        }
        $image_block = BlcImage::find($block_id);

        $path_crop = '/images/pages/blocks/' . $image_block->page_type_id . '/' . $image_block->page_id . '/' .
                     $image_block->id . '/crop_img.png';

        $path_original = '/images/pages/blocks/' . $image_block->page_type_id . '/' . $image_block->page_id . '/' .
                         $image_block->id . '/original.png';

        $filename_crop     = public_path($path_crop);
        $filename_original = public_path($path_original);

        File::delete($filename_crop);
        File::delete($filename_original);

        $image_block->delete();
    }

    /**
     * @return mixed
     */
    public static function dellSliderBlock() {
        $block_id     = request('block_id');
        $slider_block = BlcSlider::find($block_id);

        /**
         * @var \App\Models\Blocks\BlcSliderImage $image
         */
        if ( $slider_block->block_slider_images ) {
            foreach ( $slider_block->block_slider_images as $image ) {
                $image->slider_image_remove();
            }
        }
        $slider_block->delete();

        return ['success' => true];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function sliderBlockDeleteImage() {
        $image_id = request('id');
        $image    = BlcSliderImage::find($image_id);

        $image->slider_image_remove();

        return ['success' => true];
    }

    /**
     * @return mixed
     */
    public static function saveGoogleMapBlock() {
        $type         = request('type', 'google_map');
        $block_id     = request('block_id');
        $page_type_id = request('page_type_id');
        $page_id      = request('page_id');
        $zoom         = request('zoom', '10');
        $height       = request('height', '200');
        $sort         = request('sort');

        if ( is_null($sort) ) {
            $sort = PageBlocksAdminController::getSort($page_type_id, $page_id);
        }

        if ( $block_id ) {
            $google_map_block = BlcGoogleMap::find($block_id);
        } else {
            $google_map_block = new BlcGoogleMap();
        }

        $google_map_block = $google_map_block->createNew($type, $page_type_id, $page_id, $zoom, $height, $sort);

        return ['google_map_block' => $google_map_block];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function dellGoogleMapBlock() {
        $map_id = request('id');
        $map    = BlcGoogleMap::find($map_id);

        /**
         * @var $map_points GoogleMapPoint[]
         */
        $map_points = $map->google_map_points;

        if ( $map_points ) {
            foreach ( $map_points as $point ) {
                $point->delete();
            }
        }

        $map->delete();
        return ['success' => true];
    }

    public function saveGoogleMapPoint(Request $request) {

        $point_id          = request('point_id', 0);
        $point_name        = request('point_name', 'Нет названия');
        $address           = request('address', '');
        $blc_google_map_id = request('blc_google_map_id');
        $latitude          = request('latitude');
        $longitude         = request('longitude');
        $is_center         = request('is_center');
        $is_info           = request('is_info');
        $info_title        = request('info_title');
        $info_text         = request('info_text');
        $info_link_title   = request('info_link_title');
        $info_link_url     = request('info_link_url');

        if ( $point_id ) {
            $google_map_point = GoogleMapPoint::find($point_id);
        } else {
            $google_map_point = new GoogleMapPoint();
        }

        if ( $is_center ) {
            $google_map_points = GoogleMapPoint::where('is_center', '=', 1)
                                               ->where('blc_google_map_id', '=', $blc_google_map_id)
                                               ->get();

            foreach ( $google_map_points as $point ) {
                $point->is_center = 0;
                $point->save();
            }
        }

        $google_map_point = $google_map_point->createNew($point_name, $address, $blc_google_map_id, $latitude, $longitude, $is_center, $is_info, $info_title, $info_text, $info_link_title, $info_link_url);

        return ['google_map_point' => $google_map_point];
        //        $aaa = 0;
    }

    /**
     * @return mixed
     */
    public static function dellGoogleMapPoint() {
        $point_id = request('point_id');
        $point    = GoogleMapPoint::find($point_id);

        $point->delete();

        return ['success' => true];
    }

    /**
     * @return mixed
     */
    public static function sortBlocks(Request $request) {
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         * @var \App\Models\PageType         $page
         */

        $uri          = $request->get('page_alias');
        $new_sortable = request('new_sortable');
        $page_id      = request('page_id') ? request('page_id') : 1;

        $page = PageType::where('alias', $uri)->with('block_types')->first();

        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . 's';

            if ( $page->{$method} ) {
                $content_blocks[] = $page->{$method}->where('page_id', $page_id);
            }
        }

        $content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()->all();

        foreach ( $new_sortable as $key => $sort ) {
            $block_count = collect($content_blocks)->where('sort', $sort)->count();

            $save_new_sort = function ($block, $key) {
                $DB_block = false;

                if ( $block ) {
                    if ( $block->type == 'text' ) {
                        $DB_block = BlcText::find($block->id);
                    }

                    if ( $block->type == 'image' ) {
                        $DB_block = BlcImage::find($block->id);
                    }

                    if ( $block->type == 'slider' ) {
                        $DB_block = BlcSlider::find($block->id);
                    }

                    if ( $block->type == 'image_text' ) {
                        $DB_block = BlcImageText::find($block->id);
                    }

                    if ( $block->type == 'slider_text' ) {
                        $DB_block = BlcSliderText::find($block->id);
                    }

                    if ( $block->type == 'google_map' ) {
                        $DB_block = BlcGoogleMap::find($block->id);
                    }

                    if ( $DB_block ) {
                        $DB_block->sort = $key;
                        $DB_block->save();
                    }
                }
            };

            if ( $block_count < 2 ) {
                $block = collect($content_blocks)->where('sort', $sort)->first();
                $save_new_sort($block, $key);
            } else {
                //Если два блока сохранились под одной сортировкой(почему то бывает)
                $blocks = collect($content_blocks)->where('sort', $sort)->all();

                $i = 0;
                foreach ( $blocks as $block ) {
                    $save_new_sort($block, ($key + $i));
                    $i = $i + 50;
                }
            }


        }

        return ['page_blocks' => PageBlocksAdminController::getPageBlocksAdminSort($page, $page_id)];
    }

    /**
     * @param $page_type_id string
     *
     * @return mixed
     */
    public static function getSort($page_type_id, $page_id) {
        $page = PageType::where('id', $page_type_id)->with('block_types')->first();

        $content_blocks = array();
        foreach ( $page->block_types as $block_type ) {
            $method = 'blc_' . $block_type->alias . 's';

            if ( $page->{$method} ) {
                $content_blocks[] = $page->{$method}->where('page_id', $page_id);
            }
        }

        $page->content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()
                                                        ->all();

        $sort = (collect($page->content_blocks)->max('sort')) + 1;

        return $sort;
    }

}

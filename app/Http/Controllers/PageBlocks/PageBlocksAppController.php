<?php

namespace App\Http\Controllers\PageBlocks;

use App;
use App\Http\Controllers\Controller;
use App\Models\PageType;
use Config;
use Illuminate\Http\Request;
use View;

class PageBlocksAppController extends Controller
{
    /**
     * @param \App\Models\PageType $page_type
     * @param string $page_id
     * @return mixed
     */
    public static function getPageBlocks($page_type, $page_id)
    {
        /**
         * @var \App\Models\Blocks\BlockType $block_type
         */
        if ($page_type) {
            $content_blocks = array();
            foreach ($page_type->block_types as $block_type) {
                $method = 'blc_' . $block_type->alias . '_by_page';

                try{
                    $content_blocks[] = $page_type->{$method}($page_id);
                } catch (\Exception $ex){

                    App\Helpers\Helpers::showError($ex->getMessage());
                }
            }

            $page_type->content_blocks = collect($content_blocks)->collapse()->sortBy('sort')->values()->all();
            $page_type->page_id = $page_id;
            
            if ($page_type->content_blocks) {
                $view = View::make('blocks.main', ['page' => $page_type]);
            }else {
                $view = false;
            }
            
            return array('view' => $view, 'page_type' => $page_type );
        }

        $a = 0;
    }
}

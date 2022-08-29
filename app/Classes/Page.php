<?php
namespace App\Classes;


use App\Http\Controllers\PageBlocks\PageBlocksAppController;
use App\Models\PageType;

class Page {
    public $page_type        = false;
    public $page_blocks_view = false;
    public $page_blocks_list = false;
    public $page_sidebars    = false;


    public function __construct($alias, $id = 1) {
        $this->page_type = PageType::where('alias', $alias)->with('block_types')->with('sidebars')->first();

        if ( $this->page_type ) {
            $prepare_page           = PageBlocksAppController::getPageBlocks($this->page_type, $id);
            $this->page_blocks_view = $prepare_page['view'];
            $this->page_blocks_list = $prepare_page['page_type']->content_blocks;
            $this->page_sidebars    = count($this->page_type->sidebars) ? $this->page_type->sidebars : false;
        }
    }
}
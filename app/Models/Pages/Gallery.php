<?php

namespace App\Models\Pages;

use App\Classes\Page;
use App\Http\Controllers\PageBlocks\PageBlocksAppController;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Pages\Gallery
 *
 * @property int $id
 * @property string $name Название галереи
 * @property string $alias Псевдоним галереи
 * @property string|null $short_text Короткое описание галереи
 * @property int $is_show Флаг показа
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $anons
 * @property-read mixed $blocks_list
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery query()
 */
class Gallery extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates       = ['deleted_at'];
    protected $appends     = ['blocks_list'];
    public    $blocks_list = '';

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $aaa = 0;
    }

    public function getBlocksListAttribute() {
        if ( $this->id ) {
            $page_type    = PageType::where('alias', 'gallery')->with('block_types')->first();
            $page_content = PageBlocksAppController::getPageBlocks($page_type, $this->id);

            return $page_content['page_type']->content_blocks;
        }
    }

    public function getAnonsAttribute() {

        if ( $this->short_text ) {
            return str_limit($this->short_text, $limit = 200, $end = '...');
        }
    }
}

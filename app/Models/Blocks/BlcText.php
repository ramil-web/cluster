<?php

namespace App\Models\Blocks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Blocks\BlcText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $content Контент страницы
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText query()
 */
class BlcText extends Model {
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function page_type() {
        return $this->belongsTo('App\Models\PageType');
    }

    public function createNew($type, $page_type_id, $page_id, $content, $sort) {
        $this->type         = $type;
        $this->page_type_id = $page_type_id;
        $this->page_id      = $page_id;
        $this->content      = $content;
        $this->sort         = $sort;
        $this->save();

        return $this;
    }
}

<?php

namespace App\Models\Pages;

use App\Models\Components\Tag;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Pages\Post
 *
 * @property int                                                                        $id
 * @property string|null                                                                $alias      URL поста
 * @property string|null                                                                $title      Название поста
 * @property string|null                                                                $short_text Короткий текст поста
 * @property int                                                                        $is_show    Флаг показа
 * @property \Carbon\Carbon|null                                                        $created_at
 * @property \Carbon\Carbon|null                                                        $updated_at
 * @property string|null                                                                $deleted_at
 * @property-write mixed                                                                $new_tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Components\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $anons
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post withoutTrashed()
 * @property int|null $post_category_id
 * @property int|null $post_author_id
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $title_en Название поста EN
 * @property string|null $image Путь к изображению
 * @property string|null $short_text_en Короткий текст поста EN
 * @property int $views Кол-во просмотров
 * @property int $sort Сортировка
 * @property int $is_requires_editing
 * @property int $is_active Флаг показа
 * @property int $is_home Флаг -закрепить на главной-
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsRequiresEditing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post wherePostAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post wherePostCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereShortTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereViews($value)
 */
class Post extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public $new_tag;

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public function setNewTagAttribute($value) {

        if ( $value ) {
            try {
                $tag        = new Tag;
                $tag->name  = $value;
                $tag->alias = str_slug($value, '_');
                $tag->save();

            } catch ( Exception $e ) {

            }
        }
    }
    
    public function getAnonsAttribute() {
    
        if ( $this->short_text ) {
            return str_limit($this->short_text, $limit = 200, $end = '...');
        }
    }    
    
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}

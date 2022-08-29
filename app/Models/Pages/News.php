<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Pages\News
 *
 * @property int $id
 * @property string|null $alias URL новости
 * @property string|null $title Название новости
 * @property string|null $short_text Короткий текст новости
 * @property int $is_show Флаг показа
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News query()
 */
class News extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}

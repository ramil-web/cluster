<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sidebar
 *
 * @property int $id
 * @property string|null $name Название типа сайдбара
 * @property string|null $alias Псевдоним типа сайдбара
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PageType[] $page_types
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $page_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar query()
 */
class Sidebar extends Model
{
    /**
     * Типы страниц
     */
    public function page_types()
    {
        return $this->belongsToMany('App\Models\PageType');
    }
}

<?php

namespace App\Models\Components;

use App\Models\Pages\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Components\Tag
 *
 * @property int $id
 * @property string $name Название тега
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pages\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $alias Псевдоним тега
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag whereAlias($value)
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Components\Tag query()
 */
class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}

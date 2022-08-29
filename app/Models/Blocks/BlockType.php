<?php

namespace App\Models\Blocks;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Blocks\BlockType
 *
 * @property int $id
 * @property string|null $name Название блока
 * @property string|null $alias Псевдоним блока
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlockType query()
 */
class BlockType extends Model
{
    //
}

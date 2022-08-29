<?php

namespace App\Models\PageModules;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PageModules\Icon
 *
 * @property int $id
 * @property string|null $image Путь
 * @property string|null $name Название
 * @property int $is_active Флаг активности
 * @property int $readonly Только чтение
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageModules\Icon onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereReadonly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageModules\Icon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageModules\Icon withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon active()
 * @property string|null $alias Псевдоним
 * @property mixed $icon_alias
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageModules\Icon query()
 */
class Icon extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getIconAliasAttribute() {

        return $this->alias;
    }

    public function setIconAliasAttribute($value) {
        
        if ( $value ) {
            try {
                $this->alias = $value;
                $this->save();
        
            } catch ( Exception $e ) {

                if ($e->getCode() == 23000) {
                    $this->alias = $value . '_' . str_random(7);
                    $this->save();
                }
            }
        }
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeActive($query) {
        return $query->where('is_active', '=', 1);
    }
}

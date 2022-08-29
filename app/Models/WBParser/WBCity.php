<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBCity
 *
 * @property int $id
 * @property string|null $stock Название склада
 * @property string|null $city Название города
 * @property string|null $cookie Куки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCity withoutTrashed()
 * @mixin \Eloquent
 */
class WBCity extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return null|string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }


}

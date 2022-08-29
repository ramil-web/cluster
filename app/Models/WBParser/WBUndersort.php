<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBUndersort
 *
 * @property int $id
 * @property string|null $title Название подсортировки
 * @property string|null $start_at Дата старта выборки
 * @property string|null $end_at Дата окончания выборки
 * @property string|null $undersort_at Дата проведения
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersort onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereUndersortAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersort withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersort withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $alias Для XML
 * @property mixed $xml_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBUndersortProduct[] $wb_undersort_products
 * @property-read int|null $wb_undersort_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereAlias($value)
 */
class WBUndersort extends Model
{
    use SoftDeletes;

    public $xml_path = null;

    protected $guarded = [];

    protected $appends = ['xml_path'];



    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ
    // Товары подсортировки
    public function wb_undersort_products()
    {
        return $this->hasMany(WBUndersortProduct::class, 'undersort_id', 'id');
    }
    //____________________ОТНОШЕНИЯ

    public function setXmlPathAttribute($value)
    {
        $this->xml_path = $value;
    }

    public function getXmlPathAttribute()
    {
        return $this->xml_path;
    }


    //^^^^^^^^^^^^^^^^^^^^GETTERS
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
    public function getStartAt()
    {
        return $this->start_at;
    }

    /**
     * @return null|string
     */
    public function getEndAt()
    {
        return $this->end_at;
    }

    /**
     * @return null|string
     */
    public function getUndersortAt()
    {
        return $this->undersort_at;
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

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return null
     */
    public function getXmlPath()
    {
        $file_path = public_path() . '/files/undersort_xml/' . $this->getAlias();

        if (file_exists($file_path)) {

            $this->xml_path = '/files/undersort_xml/' . $this->getAlias();
        }

        return $this->xml_path;
    }

    //____________________GETTERS


}

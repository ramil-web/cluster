<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBCategory
 *
 * @property int $id
 * @property string|null $title Название категории(поле subject)(WB)
 * @property string|null $breadcrumbs Хлебные крошки(WB)
 * @property string|null $url URL категории(WB)
 * @property string|null $search Слово для поиска
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereBreadcrumbs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereSearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBCategory whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBCategory withoutTrashed()
 * @mixin \Eloquent
 */
class WBCategory extends Model
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getSearch()
    {
        return $this->search;
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

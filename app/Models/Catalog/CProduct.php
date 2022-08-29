<?php

namespace App\Models\Catalog;

use App\Models\Flow\FlowBrand;
use App\Models\Flow\FlowImage;
use App\Models\Flow\FlowLine;
use App\Models\Flow\FlowMainColor;
use App\Models\Flow\FlowProductAttribute;
use App\Models\Flow\FlowProductType;
use App\Models\Flow\FlowSeason;
use App\Models\Promotion\PrAssortmentPromotion;
use App\Models\Promotion\PrProductsCompilation;
use App\Models\Reviews\review;
use App\Site\Image\ParishopUploadImage;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Catalog\CProduct
 *
 * @property int $id
 * @property int|null $tv_flow_id ID(Flow)
 * @property int|null $tvc_flow_id ID(Flow)
 * @property int|null $product_type_flow_id ID типа товара(Flow)
 * @property int|null $maincolor_flow_id ID цвета(Flow)
 * @property int|null $brand_flow_id ID бренда(Flow)
 * @property int|null $gender_flow_id ID пола(Flow)
 * @property int|null $line_flow_id ID линии(Flow)
 * @property int|null $season_flow_id ID сезона(Flow)
 * @property int|null $product_part_flow_id ID компоновки(Flow)
 * @property int|null $product_sizerange_flow_id ID размерного ряда(Flow)
 * @property int $has_full_options Флаг что товар имеет все опции для вывода в каталоге(остатки, цену, изображения), обновляется после импорта
 * @property string|null $image Изображение
 * @property string|null $title Название
 * @property string|null $alias Псевдоним
 * @property string|null $description Описание(Flow)
 * @property int|null $rating Рейтинг
 * @property int|null $views_count Кол-во просмотров
 * @property int|null $orders_count Кол-во заказов
 * @property int|null $special Special(Flow)
 * @property string|null $art Артикул(Flow)
 * @property float|null $weight Вес(Flow)
 * @property string|null $material Материал(Flow)
 * @property float|null $price Цена(Flow)
 * @property float|null $old_price Старая цена(Flow)
 * @property int|null $price_type Тип цены спец(18)\склад(7) (Flow)
 * @property int $is_new Новинка(Flow)
 * @property string|null $imported_at Дата последнего импорта
 * @property string|null $modified_at Дата изменения(Flow)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Catalog\CBrand|null $cbrand
 * @property-read mixed $full_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereBrandFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereGenderFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereHasFullOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereImportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereLineFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereMaincolorFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereModifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereProductPartFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereProductSizerangeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereProductTypeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereSeasonFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereTvFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereTvcFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereViewsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProduct whereWeight($value)
 * @mixin \Eloquent
 */
class CProduct extends Model
{
    protected $guarded = [];

    protected $appends = ['full_title'];

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ

    // Бренды(FLOW)
    public function cbrand()
    {
        return $this->belongsTo(CBrand::class, 'brand_flow_id', 'flow_id');
    }
    //____________________ОТНОШЕНИЯ

    //^^^^^^^^^^^^^^^^^^^^GETTERS

    public function getFullTitleAttribute()
    {
        $title       = $this->getTitle();
        $brand_title = $this->getBrand()->getTitle();
        $art         = $this->getArt();

        $full_title = $title . ' ' . $brand_title . ' ' . $art;

        return $full_title;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getTvFlowId()
    {
        return $this->tv_flow_id;
    }

    /**
     * @return int|null
     */
    public function getTvcFlowId()
    {
        return $this->tvc_flow_id;
    }

    /**
     * @return int|null
     */
    public function getProductTypeFlowId()
    {
        return $this->product_type_flow_id;
    }

    /**
     * @return int|null
     */
    public function getMaincolorFlowId()
    {
        return $this->maincolor_flow_id;
    }

    /**
     * @return int|null
     */
    public function getBrandFlowId()
    {
        return $this->brand_flow_id;
    }

    /**
     * @return int|null
     */
    public function getGenderFlowId()
    {
        return $this->gender_flow_id;
    }

    /**
     * @return int|null
     */
    public function getLineFlowId()
    {
        return $this->line_flow_id;
    }

    /**
     * @return int|null
     */
    public function getSeasonFlowId()
    {
        return $this->season_flow_id;
    }

    /**
     * @return int|null
     */
    public function getProductPartFlowId()
    {
        return $this->product_part_flow_id;
    }

    /**
     * @return int|null
     */
    public function getProductSizerangeFlowId()
    {
        return $this->product_sizerange_flow_id;
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
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return int|null
     */
    public function getViewsCount()
    {
        return $this->views_count;
    }

    /**
     * @return int|null
     */
    public function getOrdersCount()
    {
        return $this->orders_count;
    }

    /**
     * @return int|null
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * @return null|string
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * @return float|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return null|string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getOldPrice()
    {
        return $this->old_price;
    }

    /**
     * @return null|string
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
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
     * @return CBrand|null
     */
    public function getBrand()
    {
        return $this->cbrand;
    }

    /**
     * @return CGender|null
     */
    public function getGender()
    {
        return $this->cgender;
    }

    /**
     * @return CLine|null
     */
    public function getLine()
    {
        return $this->cline;
    }

    /**
     * @return CMainColor|null
     */
    public function getMaincolor()
    {
        return $this->cmaincolor;
    }

    /**
     * @return null|string
     */
    public function getImage()
    {

        return $this->image;
    }


       //____________________GETTERS
}

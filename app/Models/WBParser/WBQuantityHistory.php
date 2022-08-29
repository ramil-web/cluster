<?php

namespace App\Models\WBParser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WBParser\WBQuantityHistory
 *
 * @property int $id
 * @property int $wb_product_id ID товара(WB)
 * @property int|null $q Количество доступное для продажи
 * @property int|null $qf Количество полное
 * @property int|null $qnio Количество не в заказе
 * @property int|null $iwtc В пути к клиенту(штук)
 * @property int|null $iwfc В пути от клиента(штук)
 * @property string|null $parsed_at Дата парсинга
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereIwfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereIwtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereParsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereQ($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereQf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereQnio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereWbProductId($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBQuantityHistory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBQuantityHistory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBQuantityHistory withoutTrashed()
 * @property string|null $warehouseName Название склада
 * @property string|null $barcode Штрих-код
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBQuantityHistory whereWarehouseName($value)
 * @property-read \App\Models\WBParser\WBProduct $wb_product
 */
class WBQuantityHistory extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    //^^^^^^^^^^^^^^^^^^^^ОТНОШЕНИЯ

    // Товар WB (Размер)
    public function wb_product()
    {
        return $this->belongsTo(WBProduct::class, 'wb_product_id', 'id');
    }

    //____________________ОТНОШЕНИЯ

    //^^^^^^^^^^^^^^^^^^^^GETTERS
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getWbProductId(): int
    {
        return $this->wb_product_id;
    }

    /**
     * @return int|null
     */
    public function getQ()
    {
        return $this->q;
    }

    /**
     * @return int|null
     */
    public function getQf()
    {
        return $this->qf;
    }

    /**
     * @return int|null
     */
    public function getQnio()
    {
        return $this->qnio;
    }

    /**
     * @return int|null
     */
    public function getIwtc()
    {
        return $this->iwtc;
    }

    /**
     * @return int|null
     */
    public function getIwfc()
    {
        return $this->iwfc;
    }

    /**
     * @return null|string
     */
    public function getParsedAt()
    {
        return $this->parsed_at;
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
    public function getWarehouseName()
    {
        return $this->warehouseName;
    }

    /**
     * @return null|string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return null|string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    //____________________GETTERS


}

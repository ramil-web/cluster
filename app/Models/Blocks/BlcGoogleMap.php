<?php

namespace App\Models\Blocks;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blocks\BlcGoogleMap
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $zoom Масштабирование карты
 * @property string|null $height Высота карты
 * @property int $sort
 * @property int $is_active Флаг активности
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\Components\GoogleMapPoint[] $google_map_points
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap whereZoom($value)
 * @mixin \Eloquent
 * @property-read int|null $google_map_points_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcGoogleMap query()
 */
class BlcGoogleMap extends Model {

    public function google_map_points() {
        return $this->hasMany('App\Models\Blocks\Components\GoogleMapPoint');
    }

    public function createNew($type, $page_type_id, $page_id, $zoom, $height, $sort) {
        $this->type         = $type;
        $this->page_type_id = $page_type_id;
        $this->page_id      = $page_id;
        $this->zoom         = $zoom;
        $this->height       = $height;
        $this->sort         = $sort;
        $this->save();

        return $this->load('google_map_points');
    }
}

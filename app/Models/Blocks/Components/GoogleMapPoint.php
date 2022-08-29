<?php

namespace App\Models\Blocks\Components;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blocks\Components\GoogleMapPoint
 *
 * @property int $id
 * @property int $blc_google_map_id ID блока карты
 * @property string $point_name Название точки
 * @property string|null $address Адрес
 * @property string $latitude Широта
 * @property string $longitude Долгота
 * @property int $is_center Установить точку центром карты
 * @property int $is_info Добавить точке инфо окно
 * @property string|null $info_title Заголовок инфо окна
 * @property string|null $info_text Текст инфо окна
 * @property string|null $info_link_title Текст ссылки в инфо окне
 * @property string|null $info_link_url Url ссылки в инфо окне
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereBlcGoogleMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereInfoLinkTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereInfoLinkUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereInfoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereInfoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereIsCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereIsInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint wherePointName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\Components\GoogleMapPoint query()
 */
class GoogleMapPoint extends Model {

    public function createNew($point_name, $address, $blc_google_map_id, $latitude, $longitude, $is_center, $is_info, $info_title, $info_text, $info_link_title, $info_link_url) {

        $this->point_name        = $point_name;
        $this->address           = $address;
        $this->blc_google_map_id = $blc_google_map_id;
        $this->latitude          = $latitude;
        $this->longitude         = $longitude;
        $this->is_center         = $is_center;
        $this->is_info           = $is_info;
        $this->info_title        = $info_title;
        $this->info_text         = $info_text;
        $this->info_link_title   = $info_link_title;
        $this->info_link_url     = $info_link_url;
        $this->save();

        return $this;
    }
}

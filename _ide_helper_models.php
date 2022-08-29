<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permission
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @property int|null $flow_id ID в Flow(МЕНЕДЖЕР)
 * @property string|null $surname Фамилия
 * @property string|null $patronymic Отчество
 * @property string|null $phone Телефон(МЕНЕДЖЕР)
 * @property string|null $image Фото(МЕНЕДЖЕР)
 * @property string $login
 * @property int $is_active Флаг активности
 * @property int $orders_dispatch Рассылка о поступлении заказа
 * @property int $app_dispatch Рассылка о поступлении заявки
 * @property int $reviews_dispatch Рассылка о поступлении отзыва
 * @property-read int|null $notifications_count
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAppDispatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereOrdersDispatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereReviewsDispatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin withRole($role)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models\Blocks{
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
	class BlcGoogleMap extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcImage
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $name Название изображения
 * @property string|null $ext Разрешение изображения
 * @property string|null $alt Альт текст изображения
 * @property string|null $resize_width Ширина требуемого изображения
 * @property string|null $resize_height Высота требуемого изображения
 * @property string|null $width Ширина оригинального изображения
 * @property string|null $height Высота оригинального изображения
 * @property string|null $x Координаты для ресайза
 * @property string|null $y Координаты для ресайза
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $original_src
 * @property-read mixed $src
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereResizeHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereResizeWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage whereY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImage withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImage query()
 */
	class BlcImage extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcImageText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property int $blc_image_id ID блока изображения
 * @property int $blc_text_id ID текстового блока
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $image
 * @property-read mixed $text
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereBlcImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereBlcTextId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcImageText withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcImageText query()
 */
	class BlcImageText extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcSlider
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderImage[] $blc_slider_images
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSlider withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $blc_slider_images_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSlider query()
 */
	class BlcSlider extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcSliderImage
 *
 * @property int $id
 * @property int $blc_slider_id ID блока слайдера
 * @property string $path Путь изображения
 * @property string $ext Расширение изображения
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Blocks\BlcSlider $blc_slider
 * @property-read mixed $src
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereBlcSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderImage query()
 */
	class BlcSliderImage extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcSliderText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $resize_width Ширина изображений слайдера
 * @property string|null $resize_height Высота изображений слайдера
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $blc_image_texts
 * @property-read mixed $image_text_list
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereResizeHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereResizeWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcSliderText withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $blc_image_texts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcSliderText query()
 */
	class BlcSliderText extends \Eloquent {}
}

namespace App\Models\Blocks{
/**
 * App\Models\Blocks\BlcText
 *
 * @property int $id
 * @property string $type Тип блока
 * @property string $version Вариант реализации
 * @property int $page_type_id ID типа страницы
 * @property int $page_id ID страницы
 * @property string|null $content Контент страницы
 * @property int $sort
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\PageType $page_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks\BlcText withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blocks\BlcText query()
 */
	class BlcText extends \Eloquent {}
}

namespace App\Models\Blocks{
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
	class BlockType extends \Eloquent {}
}

namespace App\Models\Blocks\Components{
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
	class GoogleMapPoint extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CAttribute
 *
 * @property int $id
 * @property int|null $flow_id ID атрибута(Flow)
 * @property int|null $product_type_flow_id ID типа товара(Flow)
 * @property string|null $title Название(Flow)
 * @property string|null $function Функция(Flow)
 * @property int $multi V_MULTI (Flow)
 * @property int|null $ordering V_ORDERING (Flow)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CAttributeValue[] $cvalues
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttribute onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereMulti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereProductTypeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttribute withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $cvalues_count
 */
	class CAttribute extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CAttributeValue
 *
 * @property int $id
 * @property int|null $flow_id ID значения атрибута(Flow)
 * @property int|null $attribute_flow_id ID атрибута(Flow)
 * @property string|null $title Название(Flow)
 * @property string|null $description Описание(Flow)
 * @property string|null $function Функция(Flow)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Catalog\CAttribute|null $cattribute
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttributeValue onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereAttributeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CAttributeValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttributeValue withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CAttributeValue withoutTrashed()
 * @mixin \Eloquent
 */
	class CAttributeValue extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CBrandCCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandCCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandCCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandCCategory query()
 * @mixin \Eloquent
 */
	class CBrandCCategory extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CBrandOption
 *
 * @property int $id
 * @property int|null $brand_flow_id ID бренда(Flow)
 * @property int|null $icon_id Иконка бренда
 * @property string|null $brand_title Название бренда
 * @property string|null $text Описание бренда
 * @property string|null $image Основное изображение
 * @property int|null $sort Сортировка
 * @property int|null $is_active Флаг активности
 * @property int|null $for_main Флаг для главной
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\PageModules\Icon|null $icon
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereBrandFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereBrandTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereForMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CBrandOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CBrandOption withoutTrashed()
 * @mixin \Eloquent
 */
	class CBrandOption extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CCategory
 *
 * @property int $id
 * @property int|null $c_category_id ID родительской категории
 * @property string|null $alias URL категории
 * @property string|null $query Запрос фильтра
 * @property string|null $title Название категории
 * @property string|null $title_en Название категории EN
 * @property int|null $sort Сортировка
 * @property int $main_cat Категории верхнего уровня
 * @property int $in_navigation Выводить в навигации
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CBrand[] $cbrands
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CCategory[] $childcategories
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProductType[] $cproducttypes
 * @property-read \App\Models\Catalog\CCategory $parentcategory
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereCCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereInNavigation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereMainCat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCategory withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $seo_title Seo title
 * @property string|null $seo_description Seo description
 * @property int|null $min_price Минимальная цена товара в категории
 * @property int|null $products_count Кол-во товаров в категории
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereMinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereProductsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSeoTitle($value)
 * @property string|null $seo_title_products Seo title товаров категории
 * @property string|null $seo_description_products Seo description товаров категории
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CColor[] $ccolors
 * @property-read mixed $current_seo_description
 * @property-read mixed $current_seo_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSeoDescriptionProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSeoTitleProducts($value)
 * @property string|null $image Изображение
 * @property int $in_cat_page В плашках на странице каталога
 * @property int|null $sort_cat_page Сортировка на странице каталога
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forBrandCatalogNavigation($brand_flow_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forCatalog()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forCatalogNavigation()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereInCatPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSortCatPage($value)
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProduct[] $cproducts
 * @property int|null $in_home_page В ленте новостей на главной
 * @property int|null $sort_home_page Сортировка в ленте новостей
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereInHomePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory whereSortHomePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forShopCatalogNavigation($shop)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forPromotionCatalogNavigation($promotion, $products_tvc_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forAssortmentPromotionCatalogNavigation($promotion, $products_tvc_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategory forCartPromotionCatalogNavigation($promotion)
 * @property-read int|null $cbrands_count
 * @property-read int|null $ccolors_count
 * @property-read int|null $childcategories_count
 * @property-read int|null $cproducts_count
 * @property-read int|null $cproducttypes_count
 */
	class CCategory extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CCategoryCProduct
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProduct query()
 * @mixin \Eloquent
 */
	class CCategoryCProduct extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CCategoryCProductType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCategoryCProductType query()
 * @mixin \Eloquent
 */
	class CCategoryCProductType extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CCity
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property int|null $region_flow_id ID региона в Flow
 * @property string|null $title Название
 * @property string|null $title_en Название EN
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Catalog\CRegion|null $cregion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereCRegionFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCity withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereRegionFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity citiesWithPublishShops()
 * @property string|null $alias
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCity whereAlias($value)
 * @property-read int|null $cshops_count
 */
	class CCity extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CColor
 *
 * @property int $id
 * @property int $flow_id ID базового цвета в Flow
 * @property string|null $title Название базового цвета
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CColor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CColor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CColor withoutTrashed()
 * @mixin \Eloquent
 * @property mixed $disabled
 * @property mixed $selected
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CCategory[] $ccategories
 * @property-read int|null $ccategories_count
 */
	class CColor extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CColorCCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColorCCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColorCCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CColorCCategory query()
 * @mixin \Eloquent
 */
	class CColorCCategory extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CCountry
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property string|null $title Название
 * @property string|null $title_en Название EN
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CCity[] $ccities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CRegion[] $cregions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCountry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCountry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CCountry withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CCountry forRussiaWithRegWithCit()
 * @property-read int|null $ccities_count
 * @property-read int|null $cregions_count
 * @property-read int|null $cshops_count
 */
	class CCountry extends \Eloquent {}
}

namespace App\Models\Catalog\Certificates{
/**
 * App\Models\Catalog\Certificates\CrCertificate
 *
 * @property int $id
 * @property int|null $flow_id ID Flow
 * @property string|null $title Название
 * @property string|null $description Описание
 * @property float $price Стоисомть
 * @property string|null $image Изображение
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Certificates\CrCertificate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Certificates\CrCertificate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Certificates\CrCertificate withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Certificates\CrCertificate active()
 * @property-read \App\Models\Catalog\CShop $cshop
 */
	class CrCertificate extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CGender
 *
 * @property int $id
 * @property int $flow_id ID пола(М,Ж) в Flow
 * @property string|null $title Название пола(М,Ж)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProduct[] $cproducts
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CGender onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CGender whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CGender withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CGender withoutTrashed()
 * @mixin \Eloquent
 * @property mixed $disabled
 * @property mixed $selected
 * @property-read int|null $cproducts_count
 */
	class CGender extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CImageView
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property string|null $title Название типа фото
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CImageView onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CImageView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CImageView withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CImageView withoutTrashed()
 * @mixin \Eloquent
 */
	class CImageView extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CLine
 *
 * @property int $id
 * @property int $flow_id ID линии в Flow
 * @property string|null $title Название линии
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProduct[] $cproducts
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CLine onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CLine withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CLine withoutTrashed()
 * @mixin \Eloquent
 * @property mixed $disabled
 * @property mixed $selected
 * @property-read int|null $cproducts_count
 */
	class CLine extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CMainColor
 *
 * @property int $id
 * @property int $flow_id ID цвета в Flow
 * @property string|null $title Название цвета
 * @property string|null $title_en Название цвета EN
 * @property int|null $color_1 ID базового цвета в Flow
 * @property int|null $color_2 ID базового цвета в Flow
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProduct[] $cproducts
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CMainColor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereColor1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereColor2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CMainColor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CMainColor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CMainColor withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\Catalog\CColor $ccolor1
 * @property-read \App\Models\Catalog\CColor $ccolor2
 * @property mixed $disabled
 * @property mixed $selected
 * @property-read int|null $cproducts_count
 */
	class CMainColor extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\COption
 *
 * @property int $id
 * @property int|null $flow_id ID опции(Flow)
 * @property int|null $tvc_flow_id ID товара(Flow)
 * @property int|null $size_flow_id ID размера(Flow)
 * @property string|null $size_title Название размера(Flow)
 * @property int|null $girth_flow_id ID обхвата(Flow)
 * @property string|null $girth_title Название обхвата(Flow)
 * @property int|null $price Цена(Flow)
 * @property int|null $old_price Старая цена(Flow)
 * @property int|null $special Special(Flow)
 * @property string|null $modified_at Дата изменения(Flow)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereGirthFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereGirthTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereModifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereSizeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereSizeTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereTvcFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property mixed $order_quantity
 * @property mixed $rest_quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CRestOption[] $crestoptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops_8002
 * @property string|null $size_girth Поле для фильтра
 * @property-read \App\Models\Catalog\CProduct|null $cproduct
 * @property mixed $disabled
 * @property mixed $selected
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\COption whereSizeGirth($value)
 * @property-read int|null $crestoptions_count
 * @property-read int|null $cshops_count
 * @property-read int|null $cshops_8002_count
 */
	class COption extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CProductAttribute
 *
 * @property int|null $tvc_flow_id TVC ID товара(Flow)
 * @property int|null $attribute_flow_id ID атрибута(Flow)
 * @property int|null $attribute_value_flow_id ID значения атрибута(Flow)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute whereAttributeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute whereAttributeValueFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute whereTvcFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CProductAttribute extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CProductImage
 *
 * @property int $id
 * @property int|null $flow_id ID в Flow
 * @property int|null $image_view_flow_id ID типа фото в Flow
 * @property string|null $image_view_title Название типа фото
 * @property int|null $product_tvc_flow_id TVC_ID товара в Flow
 * @property string|null $path Путь к фото
 * @property int $complete ?
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CProductImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereImageViewFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereImageViewTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereProductTvcFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CProductImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CProductImage withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $path_parishop Путь к оригиналу фото на Parishop
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductImage wherePathParishop($value)
 * @property-read mixed $big_image
 * @property-read mixed $middle_image
 * @property-read mixed $small_image
 */
	class CProductImage extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CProductTypeOption
 *
 * @property int $id
 * @property int $product_type_flow_id ID типа изделия(Flow)
 * @property int|null $min_price Минимальная цена товара этого типа
 * @property int|null $max_price Максимальная цена товара этого типа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CProductType[] $cproducttypes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereMaxPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereMinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereProductTypeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CProductTypeOption whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $cproducttypes_count
 */
	class CProductTypeOption extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CRegion
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property int|null $country_flow_id ID страны в Flow
 * @property string|null $title Название
 * @property string|null $title_en Название EN
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CCity[] $ccities
 * @property-read \App\Models\Catalog\CCountry|null $ccountry
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CRegion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereCCountryFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CRegion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CRegion withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRegion whereCountryFlowId($value)
 * @property-read int|null $ccities_count
 * @property-read int|null $cshops_count
 */
	class CRegion extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CRestOption
 *
 * @property int $id
 * @property int $shop_flow_id ID магазина в Flow
 * @property int|null $shop_type_flow_id Тип магазина
 * @property int|null $product_id
 * @property int $option_flow_id ID опции в Flow
 * @property int $tvc_flow_id ID товара в Flow
 * @property int|null $quantity Количество
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Catalog\CProduct $cproduct
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereOptionFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereShopFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereShopTypeFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereTvcFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $product_tvc_flow_id ID товара в Flow
 * @property-read \App\Models\Catalog\COption $coption
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereProductTvcFlowId($value)
 * @property int|null $im_stock_flow_id ID склада остатков для ИМ
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CRestOption whereImStockFlowId($value)
 */
	class CRestOption extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CShopsOption
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property string $shop_title Название магазина
 * @property string|null $alias Алиас
 * @property float|null $site_latitude Широта
 * @property float|null $site_longitude Долгота
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Catalog\CShop $cshop
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopsOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereShopTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereSiteLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereSiteLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopsOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopsOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopsOption withoutTrashed()
 * @mixin \Eloquent
 */
	class CShopsOption extends \Eloquent {}
}

namespace App\Models\Catalog{
/**
 * App\Models\Catalog\CShopType
 *
 * @property int $id
 * @property int $flow_id ID в Flow
 * @property string|null $title Название типа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\CShop[] $cshops
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\CShopType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\CShopType withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $cshops_count
 */
	class CShopType extends \Eloquent {}
}

namespace App\Models\Components{
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
	class Tag extends \Eloquent {}
}

namespace App\Models\PageModules{
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
	class Icon extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\Contact
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @property mixed $config_phone
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact whereMigration($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Contact query()
 */
	class Contact extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\Gallery
 *
 * @property int $id
 * @property string $name Название галереи
 * @property string $alias Псевдоним галереи
 * @property string|null $short_text Короткое описание галереи
 * @property int $is_show Флаг показа
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read mixed $anons
 * @property-read mixed $blocks_list
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Gallery withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Gallery query()
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\Home
 *
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Home newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Home newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Home query()
 */
	class Home extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\News
 *
 * @property int $id
 * @property string|null $alias URL новости
 * @property string|null $title Название новости
 * @property string|null $short_text Короткий текст новости
 * @property int $is_show Флаг показа
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\News withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\News query()
 */
	class News extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\Post
 *
 * @property int                                                                        $id
 * @property string|null                                                                $alias      URL поста
 * @property string|null                                                                $title      Название поста
 * @property string|null                                                                $short_text Короткий текст поста
 * @property int                                                                        $is_show    Флаг показа
 * @property \Carbon\Carbon|null                                                        $created_at
 * @property \Carbon\Carbon|null                                                        $updated_at
 * @property string|null                                                                $deleted_at
 * @property-write mixed                                                                $new_tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Components\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $anons
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Pages\Post withoutTrashed()
 * @property int|null $post_category_id
 * @property int|null $post_author_id
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $title_en Название поста EN
 * @property string|null $image Путь к изображению
 * @property string|null $short_text_en Короткий текст поста EN
 * @property int $views Кол-во просмотров
 * @property int $sort Сортировка
 * @property int $is_requires_editing
 * @property int $is_active Флаг показа
 * @property int $is_home Флаг -закрепить на главной-
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereIsRequiresEditing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post wherePostAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post wherePostCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereShortTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages\Post whereViews($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PageType
 *
 * @property int                                                                                    $id
 * @property string                                                                                 $name  Название страницы
 * @property string                                                                                 $alias Псевдоним страницы
 * @property bool                                                                                   $published
 * @property \Carbon\Carbon                                                                         $created_at
 * @property \Carbon\Carbon                                                                         $updated_at
 * @property string                                                                                 $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int                                                                                    $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType whereIsActive($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlockType[]           $block_types
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImage[]     $block_image_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSlider[]    $block_slider_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcText[]      $block_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sidebar[]                    $sidebars
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $block_image_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderText[] $block_slider_text_blocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImage[] $blc_images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcImageText[] $blc_image_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSliderText[] $blc_slider_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcSlider[] $blc_sliders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcText[] $blc_texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blocks\BlcGoogleMap[] $blc_google_maps
 * @property-read int|null $blc_google_maps_count
 * @property-read int|null $blc_image_texts_count
 * @property-read int|null $blc_images_count
 * @property-read int|null $blc_slider_texts_count
 * @property-read int|null $blc_sliders_count
 * @property-read int|null $blc_texts_count
 * @property-read int|null $block_types_count
 * @property-read int|null $sidebars_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageType query()
 */
	class PageType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $admins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $admins_count
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $perms
 * @property-read int|null $perms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Settings{
/**
 * App\Models\Settings\Setting
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @property mixed $fb_link
 * @property mixed $main_phone
 * @property mixed $vk_link
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting whereMigration($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Setting query()
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sidebar
 *
 * @property int $id
 * @property string|null $name Название типа сайдбара
 * @property string|null $alias Псевдоним типа сайдбара
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PageType[] $page_types
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $page_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sidebar query()
 */
	class Sidebar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $user_group_id ID Группы покупателя(Flow)
 * @property int|null $user_client_flow_id Связь покупателей с покупателями(Flow)
 * @property string|null $surname Фамилия
 * @property string|null $patronymic Отчество
 * @property int|null $gender_flow_id Пол по Flow
 * @property string|null $phone Телефон
 * @property int|null $city_flow_id Город для расчета доставки
 * @property int|null $address_id Адрес покупателя
 * @property string|null $image Логин
 * @property string|null $login Логин
 * @property string|null $salt Для пароля(старые пользователи)
 * @property string|null $vk_id ID vk
 * @property string|null $google_id ID google
 * @property string|null $facebook_id ID facebook
 * @property string|null $twitter_id ID twitter
 * @property string|null $wishlist_old Избранное со старого сайта
 * @property int|null $is_old_user Флаг для определения типа шифрования пароля
 * @property int|null $is_subscribe Флаг подписки
 * @property int|null $is_active Флаг активности
 * @property int|null $publish_param Флаг публикации параметров
 * @property string|null $birthday_at Дата ДР
 * @property string|null $modified_at Дата изменения(Flow)
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBirthdayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCityFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGenderFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsOldUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsSubscribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereModifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePublishParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTwitterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserClientFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWishlistOld($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBBaseProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $brand Бренд
 * @property string|null $category Категория
 * @property string|null $subject Предмет
 * @property int|null $quantity Количество доступное для продажи (все размеры)
 * @property int|null $quantityFull Количество полное (все размеры)
 * @property int|null $quantityNotInOrders Количество не в заказе (все размеры)
 * @property int|null $inWayToClient В пути к клиенту(штук) (все размеры)
 * @property int|null $inWayFromClient В пути от клиента(штук) (все размеры)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBBaseProduct withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $tvc_flow_id ID(Flow)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBProduct[] $wb_products
 * @property-read int|null $wb_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereTvcFlowId($value)
 * @property int|null $orders_count Количество заказов
 * @property int|null $sales_count Количество продаж
 * @property-read \App\Models\Catalog\CProduct $c_product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct forIndex()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereSalesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct forItem()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBProductParsingItem[] $wb_parsing_items
 * @property-read int|null $wb_parsing_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales
 * @property-read int|null $wb_sales_count
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property int|null $comments_count Кол-во комментариев
 * @property int|null $stars_count Рейтинг
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBBaseProduct whereStarsCount($value)
 */
	class WBBaseProduct extends \Eloquent {}
}

namespace App\Models\WBParser{
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
	class WBCategory extends \Eloquent {}
}

namespace App\Models\WBParser{
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
	class WBCity extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBOrder
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $number Номер заказа WB
 * @property string|null $oblast Область
 * @property string|null $warehouseName Склад отгрузки
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $subject Предмет
 * @property string|null $category Категория
 * @property string|null $brand Бренд
 * @property int|null $quantity Количество
 * @property string|null $techSize Размер
 * @property float|null $totalPrice Цена до согласованной скидки\промо\спп
 * @property float|null $discountPercent Согласованный итоговый дисконт
 * @property string|null $barcode Штрих-код
 * @property string|null $incomeID Номер поставки
 * @property string|null $odid Уникальный идентификатор позиции заказа
 * @property string|null $date Дата заказа
 * @property string|null $lastChangeDate Дата время обновления информации в сервисе
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereIncomeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOblast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOdid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBOrder withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 * @property-read mixed $format_date
 * @property int|null $isCancel isCancel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereIsCancel($value)
 * @property string|null $order_at Дата Заказа
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBOrder whereOrderAt($value)
 */
	class WBOrder extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property string|null $brand Бренд
 * @property int|null $quantity Количество доступное для продажи
 * @property int|null $quantityFull Количество полное
 * @property int|null $quantityNotInOrders Количество не в заказе
 * @property string|null $category Категория
 * @property string|null $subject Предмет
 * @property int|null $daysOnSite Количество дней на сайте
 * @property string|null $barcode Штрих-код
 * @property string|null $isSupply Договор поставки
 * @property string|null $isRealization Договор реализации
 * @property string|null $warehouseName Название склада
 * @property int|null $inWayToClient В пути к клиенту(штук)
 * @property int|null $inWayFromClient В пути от клиента(штук)
 * @property string|null $lastChangeDate Дата и время обновления информации в сервисе
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereDaysOnSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereIsSupply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereWarehouseName($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProduct withoutTrashed()
 * @property string|null $quantity_history История количества
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct baseProduct()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereQuantityHistory($value)
 * @property int|null $tvc_flow_id ID(Flow)
 * @property-read \App\Models\WBParser\WBBaseProduct|null $base_product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBOrder[] $wb_orders
 * @property-read int|null $wb_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales
 * @property-read int|null $wb_sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSupply[] $wb_supplies
 * @property-read int|null $wb_supplies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereTvcFlowId($value)
 * @property-read \App\Models\Catalog\CProduct $c_product
 * @property string|null $parser_history История парсинга
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereParserHistory($value)
 * @property int|null $search_pars_new Новая(текущая) позиция в поисковой выдаче
 * @property int|null $search_pars_old Старая позиция в поисковой выдаче
 * @property int|null $category_pars_new Новая(текущая) позиция в выдаче по категории
 * @property int|null $category_pars_old Старая позиция в выдаче по категории
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategoryParsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereCategoryParsOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSearchParsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereSearchParsOld($value)
 * @property-read mixed $parsing
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBOrder[] $wb_orders_last_month
 * @property-read int|null $wb_orders_last_month_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WBParser\WBSale[] $wb_sales_last_month
 * @property-read int|null $wb_sales_last_month_count
 * @property float|null $conversion Конверсия за год
 * @property-read mixed $estimated_balance
 * @property-read mixed $parse_days_on_site
 * @property-read mixed $undersort_data
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProduct whereConversion($value)
 */
	class WBProduct extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBProductParsingItem
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $warehouseName Название склада
 * @property int|null $quantity Количество доступное для продажи(all sizes)
 * @property int|null $quantityFull Количество полное(all sizes)
 * @property int|null $quantityNotInOrders Количество не в заказе(all sizes)
 * @property int|null $inWayToClient В пути к клиенту(all sizes)
 * @property int|null $inWayFromClient В пути от клиента(all sizes)
 * @property int|null $category_place Позиция в выдаче по категории
 * @property int|null $search_place Позиция в поисковой выдаче
 * @property string|null $category_title Название категории
 * @property string|null $search_word Поисковое слово
 * @property string|null $date_rfc3339 Дата парсинга в формате Rfc3339
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCategoryPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCategoryTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereDateRfc3339($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereInWayFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereInWayToClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantityFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereQuantityNotInOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereSearchPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereSearchWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBProductParsingItem withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBBaseProduct|null $base_product
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property int|null $comments_count Кол-во комментариев
 * @property int|null $stars_count Рейтинг
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBProductParsingItem whereStarsCount($value)
 */
	class WBProductParsingItem extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBRivalProduct
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property int|null $category_id ID категории парсинга
 * @property int|null $category_place Место в выдаче по категории
 * @property string|null $brand_name Название бренда
 * @property float|null $lower_price Текущая цена товара
 * @property float|null $old_price Старая цена товара
 * @property float|null $price_sale Скидка на товар
 * @property string|null $comments_count Кол-во комментариев
 * @property string|null $stars_count Рейтинг
 * @property string|null $parsed_at Дата парсинга
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCategoryPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereLowerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereParsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct wherePriceSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereStarsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBRivalProduct withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $sizes Размеры
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBRivalProduct whereSizes($value)
 */
	class WBRivalProduct extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBSale
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $number Номер документа
 * @property string|null $promoCodeDiscount Согласованный промокод
 * @property string|null $warehouseName Склад отгрузки
 * @property string|null $countryName Страна
 * @property string|null $oblastOkrugName Округ
 * @property string|null $regionName Регион
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property string|null $barcode Штрих-код
 * @property int|null $quantity Количество
 * @property float|null $totalPrice Начальная розничная цена товара
 * @property float|null $discountPercent Согласованная скидка на товар
 * @property string|null $isSupply Договор поставки
 * @property string|null $isRealization Договор реализации
 * @property string|null $orderId Номер исходного заказа
 * @property int|null $incomeID Номер поставки
 * @property string|null $saleID Уникальный идентификатор продажи\ возврата(SXXXX-продажа,RXXXX- возврат,DXXXX-доплата)
 * @property string|null $odid Уникальный идентификатор позиции заказа
 * @property string|null $spp Согласованная скидка постоянного покупателя(СПП)
 * @property float|null $forPay К перечислению поставщику
 * @property float|null $finishedPrice Фактическая цена из заказа(с учетом всех скидок, включая и от WB)
 * @property float|null $priceWithDisc Цена от которой считается вознаграждение поставщика forpay(с учетом всех согласованных скидок)
 * @property string|null $subject Предмет
 * @property string|null $category Категория
 * @property string|null $brand Бренд
 * @property string|null $date Дата продажи
 * @property string|null $lastChangeDate Дата время обновления информации в сервисе
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereFinishedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereForPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIncomeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIsRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereIsSupply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOblastOkrugName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOdid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale wherePriceWithDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale wherePromoCodeDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSaleID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSale withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 * @property-read mixed $format_date
 * @property string|null $sale_at Дата Продажи
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSale whereSaleAt($value)
 */
	class WBSale extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBSupply
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $warehouseName Название склада
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property int|null $quantity Количество
 * @property string|null $totalPrice Цена из УПД
 * @property string|null $number Номер УПД
 * @property int|null $incomeId Номер поставки
 * @property string|null $barcode Штрих-код
 * @property string|null $date Дата поступления
 * @property string|null $lastChangeDate Дата и время обновления информации в сервисе
 * @property string|null $dateClose Дата принятия(закрытия) в WB
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDateClose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereLastChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBSupply whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBSupply withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\WBParser\WBProduct|null $wb_products
 */
	class WBSupply extends \Eloquent {}
}

namespace App\Models\WBParser{
/**
 * App\Models\WBParser\WBUndersort
 *
 * @property int $id
 * @property int|null $nmId Код WB
 * @property string|null $barcode Штрих-код
 * @property string|null $warehouseName Название склада
 * @property string|null $supplierArticle Ваш артикул
 * @property string|null $techSize Размер
 * @property float|null $conversion Конверсия за год
 * @property int|null $estimated_balance Расчетный остаток
 * @property int|null $days_on_site Кол.во дней на сайте(б\п)
 * @property int|null $orders Заказы за (б\п)
 * @property int|null $sales Продажи за (б\п)
 * @property int|null $orders_last_year Заказы за год
 * @property int|null $sales_last_year Продажи за год
 * @property int|null $product_need Потребность в товаре
 * @property int|null $undersort_count Товар к подсортировке
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereDaysOnSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereEstimatedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereNmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereOrdersLastYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereProductNeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereSalesLastYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereSupplierArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereTechSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereUndersortAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereUndersortCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WBParser\WBUndersort whereWarehouseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersort withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WBParser\WBUndersort withoutTrashed()
 */
	class WBUndersort extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $user_group_id ID Группы покупателя(Flow)
 * @property int|null $user_client_flow_id Связь покупателей с покупателями(Flow)
 * @property string|null $surname Фамилия
 * @property string|null $patronymic Отчество
 * @property int|null $gender_flow_id Пол по Flow
 * @property string|null $phone Телефон
 * @property int|null $city_flow_id Город для расчета доставки
 * @property int|null $address_id Адрес покупателя
 * @property string|null $image Логин
 * @property string|null $login Логин
 * @property string|null $salt Для пароля(старые пользователи)
 * @property string|null $vk_id ID vk
 * @property string|null $google_id ID google
 * @property string|null $facebook_id ID facebook
 * @property string|null $twitter_id ID twitter
 * @property string|null $wishlist_old Избранное со старого сайта
 * @property int|null $is_old_user Флаг для определения типа шифрования пароля
 * @property int|null $is_subscribe Флаг подписки
 * @property int|null $is_active Флаг активности
 * @property int|null $publish_param Флаг публикации параметров
 * @property string|null $birthday_at Дата ДР
 * @property string|null $modified_at Дата изменения(Flow)
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthdayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCityFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGenderFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsOldUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsSubscribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereModifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePublishParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTwitterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserClientFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereVkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWishlistOld($value)
 */
	class User extends \Eloquent {}
}


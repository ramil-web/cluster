<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

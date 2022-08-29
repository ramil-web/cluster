<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

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

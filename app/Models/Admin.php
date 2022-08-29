<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

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
 * @property int|null $app_dispatch Рассылка о поступлении заявки
 * @property int|null $support_dispatch Рассылка о поступлении вопроса в поддержку
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAppDispatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSupportDispatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin withRole($role)
 * @property string|null $phone Телефон(менеджер)
 * @property string|null $image Фото(менеджер)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePhone($value)
 * @property int|null $flow_id ID в Flow(МЕНЕДЖЕР)
 * @property string|null $surname Фамилия
 * @property string|null $patronymic Отчество
 * @property string $login
 * @property int $is_active Флаг активности
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSurname($value)
 * @property int $reviews_dispatch Рассылка о поступлении отзыва
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereReviewsDispatch($value)
 * @property-read int|null $notifications_count
 * @property-read int|null $roles_count
 * @property int $orders_dispatch Рассылка о поступлении заказа
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereOrdersDispatch($value)
 */
class Admin extends Authenticatable
{
    use EntrustUserTrait;
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

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->password = bcrypt($query->password);
        });
    }

    /**
     * Роли.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return null|string
     */
    public function getImage()
    {
        return $this->image;
    }

}

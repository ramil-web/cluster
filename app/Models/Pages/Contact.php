<?php

namespace App\Models\Pages;

use FSOptions;
use Illuminate\Database\Eloquent\Model;

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
class Contact extends Model
{
    /**
     * Связанная с моделью таблица.
     * Так как таблицы Contacts нет, подставляю любую существующую таблицу для корректной работы админки
     * @var string
     */
    protected $table = 'migrations';
    
    public $phone;

    public function getConfigPhoneAttribute()
    {
        return FSOptions::get('contacts.phone');
    }

    public function setConfigPhoneAttribute($value)
    {
        FSOptions::set('contacts.phone', $value);
    }
}

<?php

namespace App\Models\Settings;

use FSOptions;
use Illuminate\Database\Eloquent\Model;

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
class Setting extends Model
{
    /**
     * Связанная с моделью таблица.
     * Так как таблицы Layout нет, подставляю любую существующую таблицу
     * для корректной работы админки
     * 
     *@var string
     */
    protected $table = 'migrations';
    
    //^^^^^^^^^^^^^^^^^^^^Телефон привязанный к сайту
    public function getMainPhoneAttribute()
    {
        return FSOptions::get('site.main.phone');
    }

    public function setMainPhoneAttribute($value)
    {
        FSOptions::set('site.main.phone', $value);
    }
    //____________________Телефон привязанный к сайту
    //^^^^^^^^^^^^^^^^^^^^Ссылки соц сетей
    public function getVkLinkAttribute()
    {
        return FSOptions::get('site.social.vk');
    }

    public function setVkLinkAttribute($value)
    {
        FSOptions::set('site.social.vk', $value);
    }
    public function getFbLinkAttribute()
    {
        return FSOptions::get('site.social.fb');
    }

    public function setFbLinkAttribute($value)
    {
        FSOptions::set('site.social.fb', $value);
    }    
    //____________________Ссылки соц сетей
    
    
}

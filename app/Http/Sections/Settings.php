<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Settings\Setting;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Settings
 *
 * @property \App\Models\Settings\Setting $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Settings extends Section implements Initializable
{

    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Настройки';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;

    /**
     * @var \App\Models\Pages\Contact
     */
    protected $model = '\App\Models\Settings\Setting';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                    ->addPage($this->makePage(0)->setIcon('fa fa-cogs'));
            }
        );

        $this->updating(function ($config, \App\Models\Settings\Setting $model) {
            return false;
        });

        $this->creating(function($config, \App\Models\Settings\Setting $model) {
            return false;
        });

        $this->created(function ($config, \App\Models\Settings\Setting $model) {
            return false;
        });
    }

    /**
     * @return FormInterface
     */
    public function onDisplay(Setting $setting)
    {
        return $this->onEdit(null, $setting);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id, Setting $setting)
    {
        $settings_form = AdminForm::panel();

        $settings_tabs = AdminDisplay::tabbed([
            'Общие настройки' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::text('main_phone', 'Телефон')->setDefaultValue($setting->main_phone),
                AdminFormElement::text('vk_link', 'Ссылка на группу в ВК')->setDefaultValue($setting->vk_link),
                AdminFormElement::text('fb_link', 'Ссылка на группу в FB')->setDefaultValue($setting->fb_link)
            ]),
            'Шапка' => new \SleepingOwl\Admin\Form\FormElements([]),
            'Футер' => new \SleepingOwl\Admin\Form\FormElements([]),
        ]);

        $settings_form->addElement($settings_tabs)
            ->setAction('/admin/settings/1/edit')
            ->getButtons()->replaceButtons([
                'delete' => null,
                'save'   => (new Save())->setText('Сохранить'),
                'cancel'  => (new Cancel())->setText('Назад'),
            ]);

        return $settings_form;
    }
    
    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}

<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\PageType;
use Auth;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Sidebars
 *
 * @property \App\Models\Sidebar $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Sidebars extends Section implements Initializable
{

    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Типы сайдбаров';

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
    protected $model = '\App\Models\Sidebar';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_structure')
                    ->addPage($this->makePage(1)->setIcon('fa fa-minus'));

            }
        );

        $this->updating(function ($config, \App\Models\Sidebar $model) {});

        $this->creating(function($config, \App\Models\Sidebar $model) {});

        $this->created(function ($config, \App\Models\Sidebar $model) {});
    }

    /**
     * @return mixed
     */
    public function onDisplay()
    {
        $sidebars = AdminDisplay::table()
                                ->setColumns(
                                    AdminColumn::link('id', '#')->setWidth('30px'),
                                    AdminColumn::link('name', 'Название типа'),
                                    AdminColumn::text('alias', 'Псевдоним типа')
                                )->paginate(20);
        return $sidebars;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $super = $readonly = !Auth::user()->hasRole('super');
        $page_types = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')->required('Обязательное поле')->setReadonly($readonly),
            AdminFormElement::text('alias', 'Псевдоним()')->required('Обязательное поле')->unique('Этот псевдоним уже используется')->setReadonly($readonly),
            AdminFormElement::checkbox('is_active', 'Активен')->setDefaultValue(1)->setReadonly($readonly),
            AdminFormElement::multiselect('page_types', 'Типы страниц', PageType::class)->setDisplay('name'),
        ]);

        return $page_types;
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

<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Admin;
use App\Models\Blocks\BlockType;
use Auth;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class PageTypes
 *
 * @property \App\Models\PageType $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class PageTypes extends Section implements Initializable
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
    protected $title = "Типы страниц";

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\Admin
     */
    protected $model = '\App\Models\PageType';

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

        $this->updating(function ($config, $model) {});

        $this->created(function ($config, $model) {});

        $this->creating(function($config, \App\Models\PageType $model) {});
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Название типа'),
                AdminColumn::text('alias', 'Псевдоним типа')
            )->paginate(20);
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
            //AdminFormElement::checkbox('is_active', 'Активен')->setDefaultValue(1),
            AdminFormElement::multiselect('block_types', 'Типы блоков', BlockType::class)->setDisplay('name'),
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

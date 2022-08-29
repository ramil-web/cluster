<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class BlockTypes
 *
 * @property \App\Models\Blocks\BlockType $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class BlockTypes extends Section implements Initializable
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
    protected $title = "Типы блоков";

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\Blocks\BlockType
     */
    protected $model = '\App\Models\Blocks\BlockType';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_structure')
                    ->addPage($this->makePage(3)->setIcon('fa fa-minus'));

            }
        );

        $this->updating(function ($config, $model) {});

        $this->created(function ($config, $model) {});

        $this->creating(function($config, \App\Models\Blocks\BlockType $model) {});
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Название блока'),
                AdminColumn::text('alias', 'Псевдоним блока')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $page_types = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')->required('Обязательное поле'),
            AdminFormElement::text('alias', 'Псевдоним()')->required('Обязательное поле')->unique('Этот псевдоним уже используется'),
            AdminFormElement::checkbox('is_active', 'Активен')->setDefaultValue(1),
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

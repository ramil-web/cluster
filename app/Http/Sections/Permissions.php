<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Section;

/**
 * Class Permissions
 *
 * @property \App\Models\Permission $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Permissions extends Section implements Initializable
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
    protected $title = "Доступы";

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\Admin
     */
    protected $model = '\App\Models\Permissions';

    /**
     * Initialize class.
     */
    public function initialize()
    {

        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('administration')
                    ->addPage($this->makePage(300)->setIcon('fa fa-window-close'));

            }
        );
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $permissions =  AdminDisplay::table()
            ->setColumns(
                AdminColumn::link('name', 'Псевдоним доступа'),
                AdminColumn::text('display_name', 'Название доступа'),
                AdminColumn::text('description', 'Описание доступа')

            )->paginate(20);

        $permissions->getColumns()->getControlColumn()->setDeletable(false);

        return $permissions;        
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $permissions = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Псевдоним доступа')->unique('Этот псевдоним уже используется')->required()->setReadonly(0),
            AdminFormElement::text('display_name', 'Название доступа')->required()->setReadonly(0),
            AdminFormElement::textarea('description', 'Описание доступа')->required()->setReadonly(0)
        ]);

        $permissions->getButtons()->replaceButtons([
            'delete' => null,
            'save'   => (new Save())->setText('Сохранить'),
            'cancel'  => (new Cancel())->setText('Назад'),
        ]);

        return $permissions;
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

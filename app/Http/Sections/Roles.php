<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Permission;
use App\Models\Role;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Section;

/**
 * Class Roles
 *
 * @property \App\Models\Role $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Roles extends Section implements Initializable
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
    protected $title = "Роли";

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\Admin
     */
    protected $model = '\App\Models\Role';

    /**
     * Initialize class.
     */
    public function initialize()
    {

        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('administration')
                    ->addPage($this->makePage(200)->setIcon('fa fa-user-circle-o'));

            }
        );
    }


    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->with('permissions')
            ->setColumns(
                AdminColumn::link('name', 'Псевдоним роли'),
                AdminColumn::text('display_name', 'Название роли'),
                AdminColumn::text('description', 'Описание'),
                AdminColumn::lists('permissions.display_name', 'Доступы')
                
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $super = $readonly = 0;

        if ($id) {
            $super = $readonly = $this->model->find($id)->name == 'super' ? 1 : 0;
        }

        $roles = AdminForm::panel();
        
        if ($super) {
            $roles->addHeader([
                AdminFormElement::custom(function () {
                })
                    ->setDisplay(function () {
                        return '<strong class="text-danger">Роль - "Супер админ", не редактируется!</strong>';
                    }),
            ]);
            $roles->getButtons()->replaceButtons([
                'delete' => null,
                'save'   => null,
                'cancel'  => (new Cancel())->setText('Назад'),
            ]);
        }
        
        $roles->addBody([
            AdminFormElement::text('name', 'Псевдоним роли')->unique('Этот псевдоним уже используется')->required()->setReadonly($readonly),
            AdminFormElement::text('display_name', 'Название роли')->required()->setReadonly($readonly),
            AdminFormElement::textarea('description', 'Описание')->required()->setReadonly($readonly),
        ]);

        if (!$super) {
            $roles->addBody([
                AdminFormElement::multiselect('permissions', 'Доступ', Permission::class)->setDisplay('display_name'),
            ]);            
        }
        
        return $roles; 
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

<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminSection;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Role;
use App\Models\User;
use Auth;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Section;

/**
 * Class Users
 *
 * @property \App\Models\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
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
    protected $title = 'Пользователи';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\User
     */
    protected $model = '\App\Models\User';

    /**
     * Initialize class.
     */
    public function initialize()
    {
//         Добавление пункта меню и счетчика кол-ва записей в разделе
//        $this->addToNavigation($priority = 6, function() {
//            return \App\Models\User::count();
//        });


        $this->addToNavigation(2)->setIcon('fa fa-users')->setAccessLogic(function() {
            return  ( Auth::user()->hasRole('admin') || Auth::user()->hasRole('super'));
        });

        $this->creating(function($config, \App\Models\User $model) {
            $model->password = bcrypt($model->password);
            return true;
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $user = Auth::user()->hasRole('editor');

        $users = AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setApply(
                function ($query) {
//                    $query->where('id', 2);
//                    $query->doesntHave('roles');
                }
            )
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Имя'),
                AdminColumn::text('email', 'E-mail')
            )->paginate(20);

        
        //$users->setParameter('creatable', false);
        //$users->setNewEntryButtonText('dddddd');
        //$users->getColumns()->getControlColumn()->setEditable(false)->setDeletable(false);

        $tabs = AdminDisplay::tabbed();

        $tabs->appendTab($users, 'Пользователи');

        return $tabs;

    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form =  AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Имя')->unique('Этот псевдоним уже используется'),
            AdminFormElement::text('email', 'Email')
        ]);

        //if (0) {
        //    $form->getButtons()->replaceButtons([
        //        'delete' => null,
        //        'save'   => null,
        //        'cancel'  => (new Cancel())->setText('Отмена'),
        //    ]);
        //}

        //$form->getButtons()->replaceButtons([
        //    'delete' => null,
        //    'save'   => (new Save())
        //        ->setGroupElements(
        //            [
        //             'save_and_create' => null,
        //             'save_and_close'  => (new SaveAndClose())->setText('Сохранить и з'),
        //            ])->setText('Сохр'),
        //    'cancel'  => (new Cancel())->setText('Отмена'),
        //]);

        
        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Имя пользователя')->required(),
            AdminFormElement::text('email', 'E-mail')->unique('Этот email уже используется')->required(),
            AdminFormElement::text('password', 'Пароль')->required(),
        ]);
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

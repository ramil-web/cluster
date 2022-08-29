<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminSection;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Admin;
use App\Models\Role;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Admins
 *
 * @property \App\Models\Admin $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Admins extends Section implements Initializable
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
    protected $title = "Админы";

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \App\Models\Admin
     */
    protected $model = '\App\Models\Admin';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('administration')
                    ->addPage($this->makePage(100)->setIcon('fa fa-lock'));

            }
        );

        $this->updating(function ($config, $model) {
        });

        $this->created(function ($config, $model) {
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatablesAsync()
            ->setApply(
                function ($query) {
                }
            )
            ->with('roles')
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Имя'),
                AdminColumn::text('login', 'Логин'),
                AdminColumn::lists('roles.display_name', 'Роли')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $super = $readonly = $this->model->find($id)->hasRole('super');

        $AdminForm = AdminForm::panel();

        if ($super) {
            $AdminForm->addHeader([
                AdminFormElement::custom(function () {
                })
                    ->setDisplay(function () {
                        return '<strong class="text-danger">Статус - "Супер админ"</strong>';
                    }),
            ]);
        }

        $AdminForm->addHeader([
            AdminFormElement::custom(function () {
            })
                ->setDisplay(function (Admin $admin) {
                    $href = '/admin/setAdmin/' . $admin->id;

                    return '<a href="' . $href . '" onclick="">Авторизоваться</a>';
                }),
        ])
            ->addBody([

                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::checkbox('is_active', 'Активный'),
                    ], 12)
                    ->addColumn([
                        AdminFormElement::text('name', 'Имя')->required(),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('surname', 'Фамилия')->required(),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('patronymic', 'Отчество'),
                    ], 4)
                    ->addColumn([], 12)
                    ->addColumn([
                        AdminFormElement::text('login', 'Логин')
                            ->unique('Этот логин уже используется')
                            ->required(),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('email', 'Email')
                            ->required(),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::multiselect('roles', 'Роль', Role::class)->setDisplay('name')
                            ->required('Выберите роль')->setReadonly($readonly),
                        AdminFormElement::checkbox('orders_dispatch', 'Привязать к рассылке -Новый заказ-'),
//                        AdminFormElement::checkbox('app_dispatch', 'Привязать к рассылке -Заявка претендента-'),
                    ], 12),
            ]);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($AdminForm, 'Основное');

        return $tabs;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([

            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::checkbox('is_active', 'Активный')->setDefaultValue(1),
                ], 12)
                ->addColumn([
                    AdminFormElement::text('name', 'Имя')->required(),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('surname', 'Фамилия')->required(),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('patronymic', 'Отчество'),
                ], 4)
                ->addColumn([], 12)
                ->addColumn([
                    AdminFormElement::text('login', 'Логин')
                        ->unique('Этот логин уже используется')
                        ->required(),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('password', 'Пароль')->required(),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('email', 'Email')
                        ->required(),
                ], 4)
                ->addColumn([
                    AdminFormElement::multiselect('roles', 'Роль', Role::class)->setDisplay('name')
                        ->required('Выберите роль'),
                    AdminFormElement::checkbox('app_dispatch', 'Привязать к рассылке -Заявка претендента-'),
//                    AdminFormElement::checkbox('support_dispatch', 'Привязать к рассылке -Обращение в поддержку-'),
                ], 12),
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

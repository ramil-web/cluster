<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Pages\Contact;
use Carbon\Carbon;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Contacts
 *
 * @property \App\Models\Pages\Contact $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Contacts extends Section implements Initializable
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
    protected $title = 'Контакты';

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
    protected $model = '\App\Models\Pages\Contact';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                    ->addPage($this->makePage(3)->setIcon('fa fa-address-card'));
            }
        );

        $this->updating(function ($config, \App\Models\Pages\Contact $model) {
            return false;
        });
        
        $this->creating(function($config, \App\Models\Pages\Contact $model) {
            return false;
        });

        $this->created(function ($config, \App\Models\Pages\Contact $model) {
            return false;
        });
    }
    
    /**
     * @return FormInterface
     */
    public function onDisplay(Contact $contact)
    {
        return $this->onEdit(null, $contact);        
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id, Contact $contact)
    {
        $tabs = AdminDisplay::tabbed();

        $contactsBlocks[] = view('admin::pages_blocks.blocks', ['alias' => 'contacts', 'id' => '']);

        $tabs->appendTab(new FormElements($contactsBlocks), 'Контент страницы контакты');

        $contacts = AdminForm::panel();

        $contacts->setItems(
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::datetime('updated_at', 'Дата')->setDefaultValue(Carbon::now()),
                ], 12),
            AdminFormElement::text('config_phone', 'Телефон')->setDefaultValue($contact->config_phone)
        )->setAction('/admin/contacts/1/edit')
        ->getButtons()->replaceButtons([
            'delete' => null,            
            'save'   => (new Save())->setText('Сохранить'),
            'cancel'  => (new Cancel())->setText('Назад'),
        ]);

        $tabs->appendTab($contacts, 'Настройки');

        return $tabs;
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

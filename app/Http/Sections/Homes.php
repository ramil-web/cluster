<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Carbon\Carbon;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Contacts
 *
 * @property \App\Models\Pages\Home $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Homes extends Section implements Initializable
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
    protected $title = 'Главная';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;



    /**
     * @var \App\Models\User
     */
    protected $model = '\App\Models\Pages\Home';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                    ->addPage($this->makePage(1)->setIcon('fa fa-home'));
            }
        );

        $this->updating(function ($config, \App\Models\Pages\Home $model) {
            return false;
        });
        $this->creating(function($config, \App\Models\Pages\Home $model) {});

        $this->created(function ($config, \App\Models\Pages\Home $model) {});
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $tabs = AdminDisplay::tabbed();

        $homeBlocks[] = view('admin::pages_blocks.blocks', ['alias' => 'home', 'id' => '']);
        
        $tabs->appendTab(new FormElements($homeBlocks), 'Контент главной страницы');

        return $tabs;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        // remove if unused
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

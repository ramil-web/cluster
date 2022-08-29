<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Carbon\Carbon;
use Meta;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Galleries
 *
 * @property \App\Models\Pages\Gallery $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Galleries extends Section implements Initializable
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
    protected $title = 'Галерея';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;



    /**
     * @var \App\Models\Pages\Gallery
     */
    protected $model = '\App\Models\Pages\Gallery';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                                ->addPage($this->makePage(6)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\Pages\Gallery $model) {
            $model->alias = $model->name ? str_slug($model->name, '_') : 'null';
            return true;
        });

        $this->creating(function($config, \App\Models\Pages\Gallery $model) {
            $model->alias = $model->name ? str_slug($model->name, '_') : 'null';
            return true;
        });

        $this->created(function ($config, \App\Models\Pages\Gallery $model) {});
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $items = AdminDisplay::table()
                             ->setHtmlAttribute('class', 'table-primary')
                             ->setColumns(
                                 AdminColumn::link('id', '#')->setWidth('30px'),
                                 AdminColumn::datetime('updated_at', 'Дата')->setWidth('150px'),
                                 AdminColumn::link('name', 'Название'),
                                 AdminColumn::text('anons', 'Анонс')
                             )->paginate(20);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($items, 'Галерея');

        return $tabs;

    }

    /** resources/lang/vendor/sleeping_owl/{locale}/lang.php
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        if ($id) {
            $this->item_name = $this->model->find($id)->name;
        }else {
            $this->item_name = '"Галерея"';
        }

         $items = AdminForm::panel();

        $items->setItems(
            AdminFormElement::columns()
                            ->addColumn([
                                AdminFormElement::text('name', 'Название')->required('Обязательное поле'),
                                
                                AdminFormElement::textarea('short_text', 'Анонс')->required('Обязательное поле'),

                                //AdminFormElement::multiselect('tags', 'Выберать тег из списка', Tag::class)->setDisplay('name'),

                                //AdminFormElement::text('new_tag', 'Добавить новый тег в список'),

                                AdminFormElement::checkbox('is_show', 'Активная')->setDefaultValue(1),
                            ], 12)
                            ->addColumn([
                                AdminFormElement::datetime('updated_at', 'Дата')->setDefaultValue(Carbon::now()),
                            ], 12)
        );

        $tabs = AdminDisplay::tabbed();

        $tabs->appendTab($items, 'Основное');


        if (!is_null($id)) {
            $itemsBlocks[] = view('admin::pages_blocks.blocks', ['alias' => 'gallery', 'id' => $id]);
        }else{
            $itemsBlocks[] = '<h2>Для добавления фото необходимо сохранить галерею</h2>';
        }
        $tabs->appendTab(new FormElements($itemsBlocks), 'Контент галереи');

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

    public function getCreateTitle() {
        return 'Новая запись в разделе '  . $this->item_name;
    }

    public function getEditTitle() {
        if ($this->item_name) {
            return 'Редактирование - "' . $this->item_name . '"';
        }

        return parent::getEditTitle();
    }
}

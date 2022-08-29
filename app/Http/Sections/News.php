<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Admin;
use Carbon\Carbon;
use Meta;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Section;

/**
 * Class News
 *
 * @property \App\Models\Pages\News $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class News extends Section implements Initializable
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
    protected $title = 'Новости';

    /**
     * @var string
     */
    protected $alias;
    
    /**
     * @var string
     */
    protected $item_name = false;
    
    

    /**
     * @var \App\Models\Pages\News
     */
    protected $model = '\App\Models\Pages\News';
    
    /**
     * Initialize class.
     */
    public function initialize()
    {  
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                    ->addPage($this->makePage(2)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\Pages\News $model) {
            $model->alias = $model->alias ? strtolower ($model->alias) : $model->id;
            return true;            
        });
        $this->creating(function($config, \App\Models\Pages\News $model) {});
        
        $this->created(function ($config, \App\Models\Pages\News $model) {
            if (empty($model->alias)) {
                $model->alias = $model->id;
                $model->save();
            }
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $news = AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),
                AdminColumn::datetime('updated_at', 'Дата')->setWidth('150px'),
                AdminColumn::link('title', 'Название'),
                AdminColumn::text('short_text', 'Анонс')
            )->paginate(20);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($news, 'Новости');

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
            $this->item_name = $this->model->find($id)->title;    
        }else {
            $this->item_name = '"Новости"';
        }
        
        Meta::addJs('components_js', ('packages/sleepingowl/default/js/admin/components/common.js'), null, true);
        $news = AdminForm::panel();

        $news->setItems(
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::datetime('updated_at', 'Дата')->setDefaultValue(Carbon::now()),
                ], 12)
                ->addColumn([
                    AdminFormElement::text('alias', 'Псевдоним(только латиница, цифры, -, _)')
                        ->setHtmlAttribute('class', 'js-translit-alias')
                        ->addValidationRule('admin_url', 'Некорректный URL')
                        ->unique('Этот псевдоним уже используется'),
                ], 6)
                ->addColumn([
                    AdminFormElement::custom(function () {
                    })
                        ->setDisplay(function () {
                            $button = view('admin::components.button.translit', ['id' => 23]);
                            return $button;
                        }),],6)
                ->addColumn([
                    AdminFormElement::text('title', 'Название')->required('Обязательное поле')
                        ->setHtmlAttribute('class', 'js-translit-title'),
                    AdminFormElement::text('short_text', 'Анонс')->required('Обязательное поле'),
                    AdminFormElement::checkbox('is_show', 'Активная')->setDefaultValue(1),
                ],12)               
        );
            
        $tabs = AdminDisplay::tabbed();

        $tabs->appendTab($news, 'Основное');


        if (!is_null($id)) {
            $newsBlocks[] = view('admin::pages_blocks.blocks', ['alias' => 'news', 'id' => $id]);
        }else{
            $newsBlocks[] = '<h2>Для добавления контента необходимо сохранить новость</h2>';
        }
        $tabs->appendTab(new FormElements($newsBlocks), 'Контент новости');

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

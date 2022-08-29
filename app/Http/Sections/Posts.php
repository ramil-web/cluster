<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Components\Tag;
use App\Models\Pages\Post;
use Carbon\Carbon;
use Meta;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Posts
 *
 * @property \App\Models\Pages\Post $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Posts extends Section implements Initializable
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
    protected $title = 'Блог';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;



    /**
     * @var \App\Models\Pages\Post
     */
    protected $model = '\App\Models\Pages\Post';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_content')
                                ->addPage($this->makePage(5)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\Pages\Post $model) {});
        
        $this->creating(function($config, \App\Models\Pages\Post $model) {});

        $this->created(function ($config, \App\Models\Pages\Post $model) {});
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $posts = AdminDisplay::table()
                            ->setHtmlAttribute('class', 'table-primary')
                            ->setColumns(
                                AdminColumn::link('id', '#')->setWidth('30px'),
                                AdminColumn::datetime('updated_at', 'Дата')->setWidth('150px'),
                                AdminColumn::link('title', 'Название'),
                                AdminColumn::text('anons', 'Анонс')
                            )->paginate(20);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($posts, 'Посты');

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
            $this->item_name = '"Посты"';
        }

        Meta::addJs('components_js', ('packages/sleepingowl/default/js/admin/components/common.js'), null, true);
        $posts = AdminForm::panel();

        $posts->setItems(
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
                                AdminFormElement::textarea('short_text', 'Анонс')->required('Обязательное поле'),
                                
                                AdminFormElement::multiselect('tags', 'Выберать тег из списка', Tag::class)->setDisplay('name'),
                                
                                AdminFormElement::text('new_tag', 'Добавить новый тег в список'),
                                
                                AdminFormElement::checkbox('is_show', 'Активная')->setDefaultValue(1),
                            ], 12)
        );

        $tabs = AdminDisplay::tabbed();

        $tabs->appendTab($posts, 'Основное');


        if (!is_null($id)) {
            $postsBlocks[] = view('admin::pages_blocks.blocks', ['alias' => 'blog', 'id' => $id]);
        }else{
            $postsBlocks[] = '<h2>Для добавления контента необходимо сохранить пост</h2>';
        }
        $tabs->appendTab(new FormElements($postsBlocks), 'Контент поста');

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

<?php

namespace App\Http\Sections\WB\Parser;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Components\Tag;
use App\Models\Pages\Post;
use App\Models\WBParser\WBCategory;
use App\Models\WBParser\WBCity;
use App\Models\WBParser\WBProduct;
use App\Models\WBParser\WBSale;
use Carbon\Carbon;
use Meta;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class WBCategories
 *
 * @property \App\Models\WBParser\WBCategory $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class WBCategories extends Section implements Initializable
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
    protected $title = 'Категории(Парсер)';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;


    /**
     * @var \App\Models\WBParser\WBCategory
     */
    protected $model = WBCategory::class;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('parser_wb')
                    ->addPage($this->makePage(2)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\WBParser\WBCategory $model) {
        });

        $this->creating(function ($config, \App\Models\WBParser\WBCategory $model) {
        });

        $this->created(function ($config, \App\Models\WBParser\WBCategory $model) {
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $active = AdminDisplay::datatablesAsync()
            ->setDisplaySearch(true)
            ->setName('active_pr')
            ->setApply(
                function ($query) {
                }
            )
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px')
                    ->setSearchCallback(function ($column, $query, $search) {
                        // Из-за ошибки поиска кирилицы в данных полях(int, date)
                        if ((integer)$search) {
                            $query->where($column->getName(), 'like', "%$search%");
                        }
                    }),
                AdminColumn::link('title', 'Название категории'),
                AdminColumn::link('breadcrumbs', 'Хлебные крошки(WB)'),
                AdminColumn::link('search', 'Слово для поиска')
            )->paginate(20);


        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($active, 'Продажи');

        return $tabs;

    }

    /** resources/lang/vendor/sleeping_owl/{locale}/lang.php
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        Meta::addJs('components_js', ('packages/sleepingowl/default/js/admin/components/common.js'), null, true);
        $main = AdminForm::panel();

        $main->setItems(
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('title', 'Название категории'),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('breadcrumbs', 'Хлебные крошки(WB)'),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('url', 'URL категории(WB)'),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('search', 'Слово для поиска'),
                ], 4)

        );


//        $main->getButtons()->replaceButtons([
//            'delete' => null,
//            'save'   => (new Save())->setText('Сохранить'),
//            'cancel' => (new Cancel())->setText('Назад'),
//        ]);

        $tabs = AdminDisplay::tabbed();

        $tabs->appendTab($main, 'Основное');

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
    public function onRestore($id)
    {
        // remove if unused
    }
}

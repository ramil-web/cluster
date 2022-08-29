<?php

namespace App\Http\Sections\WB;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Components\Tag;
use App\Models\Pages\Post;
use App\Models\WBParser\WBBaseProduct;
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
 * Class WBBaseProducts
 *
 * @property \App\Models\WBParser\WBBaseProduct $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class WBBaseProducts extends Section implements Initializable
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
    protected $title = 'Товары(Арт\Цвет)';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;


    /**
     * @var \App\Models\WBParser\WBBaseProduct
     */
    protected $model = WBBaseProduct::class;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_wb')
                    ->addPage($this->makePage(1)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\WBParser\WBBaseProduct $model) {
        });

        $this->creating(function ($config, \App\Models\WBParser\WBBaseProduct $model) {
        });

        $this->created(function ($config, \App\Models\WBParser\WBBaseProduct $model) {
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $active = AdminDisplay::datatablesAsync()
            ->setDisplaySearch(true)
            ->setName('active_base_pr')
            ->setApply(
                function ($query) {
                    $query->orderBy('id', 'desc');
                }
            )
            ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px')
                    ->setSearchCallback(function ($column, $query, $search) {
                        // Из-за ошибки поиска кирилицы в данных полях(int, date)
                        if ((integer)$search) {
                            $query->where($column->getName(), 'like', "%$search%");
                        }
                    }),
//                AdminColumn::custom('supplierArticle', function ($instance) {
//
//                    /**
//                     * @var $instance ManagerOrder
//                     */
//                    $type = '<b class="text-success">Заказ</b>';
//
//                    if ($instance->isPreorder()) {
//                        $type = '<b class="text-danger">Предзаказ</b>';
//                    }
//
//                    return $type;
//
//                })->setLabel('Тип'),

                AdminColumn::link('nmId', 'ID(WB)'),
                AdminColumn::link('supplierArticle', 'Арт(WB)')
//                AdminColumn::link('completed_at', 'Дата создания заказа')->setSearchCallback(function ($column, $query, $search) {
//                    // Из-за ошибки поиска кирилицы в данных полях(int, date)
//                    // оставляем только символы которые могут присутствовать в датах
//                    $search = trim(preg_replace('/[^0-9\s\-:]/', '', $search));
//
//                    if ($search) {
//                        $query->orWhere($column->getName(), 'like', "%$search%");
//                    }
//                })
            )->paginate(20);


        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($active, 'Товары(Арт\Цвет)');

        return $tabs;

    }

    /** resources/lang/vendor/sleeping_owl/{locale}/lang.php
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        $base_product = $this->model->withTrashed()->find($id);

        Meta::addJs('components_js', ('packages/sleepingowl/default/js/admin/components/common.js'), null, true);
        $main = AdminForm::panel();

        $main->setItems(
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('supplierArticle', 'Арт(WB)')
                        ->setReadonly(1),
                ], 3)
                ->addColumn([
                    AdminFormElement::text('nmId', 'ID(WB)')
                        ->setReadonly(1),
                ], 3)
                ->addColumn([], 12)
                ->addColumn([
                    AdminFormElement::custom(function () use ($base_product) {
                    })
                        ->setDisplay(function () use ($base_product) {
                            $link = "ОШИБКА. Товар не найден";
                            if ($base_product) {


                                $url = "https://www.wildberries.ru/catalog/" . $base_product->getNmId() . "/detail.aspx?targetUrl=";

                                $link = "<a href='$url' target='_blank'>
                                            <small>Ссылка на страницу WB-></small>
                                         </a>";
                            }

                            return $link;

                        }),], 6)
        );


        $main->getButtons()->replaceButtons([
            'delete' => null,
            'save'   => (new Save())->setText('Сохранить'),
            'cancel' => (new Cancel())->setText('Назад'),
        ]);

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

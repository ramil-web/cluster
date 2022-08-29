<?php

namespace App\Http\Sections\WB;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Components\Tag;
use App\Models\Pages\Post;
use App\Models\WBParser\WBProduct;
use App\Models\WBParser\WBSupply;
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
 * Class WBSupplies
 *
 * @property \App\Models\WBParser\WBSupply $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class WBSupplies extends Section implements Initializable
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
    protected $title = 'Поставки';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;


    /**
     * @var \App\Models\WBParser\WBSupply
     */
    protected $model = WBSupply::class;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_wb')
                    ->addPage($this->makePage(5)->setIcon('fa fa-newspaper-o'));

            }
        );

        $this->updating(function ($config, \App\Models\WBParser\WBSupply $model) {
        });

        $this->creating(function ($config, \App\Models\WBParser\WBSupply $model) {
        });

        $this->created(function ($config, \App\Models\WBParser\WBSupply $model) {
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $active = AdminDisplay::datatablesAsync()
            ->setDisplaySearch(true)
            ->setName('active_order')
            ->setApply(
                function ($query) {
                    $query->orderBy('id', 'desc');
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

                AdminColumn::text('nmId', 'ID(WB)')->setWidth('50px'),
                AdminColumn::text('barcode', 'Штрих-код'),
                AdminColumn::text('date', 'Дата поступления'),
                AdminColumn::text('warehouseName', 'Название склада'),

                AdminColumn::link('supplierArticle', 'Артикул'),
                AdminColumn::link('techSize', 'Размер(WB)'),
                AdminColumn::link('quantity', 'Количество'),
                AdminColumn::link('totalPrice', 'Цена из УПД')
            )->paginate(40);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($active, 'Заказы');

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
                    AdminFormElement::text('barcode', 'Штрих-код')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('nmId', 'Код WB')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('warehouseName', 'Склад отгрузки')
                        ->setReadonly(1),
                ], 4)

                ->addColumn([], 12)

                ->addColumn([
                    AdminFormElement::text('supplierArticle', 'Артикул')
                        ->setReadonly(1),
                ], 4)

                ->addColumn([], 12)

                ->addColumn([
                    AdminFormElement::text('quantity', 'Количество')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('techSize', 'Размер')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('totalPrice', 'Цена из УПД')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([], 12)

                ->addColumn([
                    AdminFormElement::text('incomeId', 'Номер поставки')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([
                    AdminFormElement::text('date', 'Дата поступления')
                        ->setReadonly(1),
                ], 4)
                ->addColumn([], 12)

        );


        $main->getButtons()->replaceButtons([
            'delete' => null,
            'save'   => null,
//                'save'   => (new Save())->setText('Сохранить'),
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

<?php

namespace App\Http\Sections\PageModules;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\PageModules\Icon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Meta;
use Session;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Icons
 *
 * @property \App\Models\PageModules\Icon $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Icons extends Section implements Initializable {

    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Иконки';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $item_name = false;

    /**
     * @var string
     */
    protected $model = '\App\Models\PageModules\Icon';

    /**
     * Initialize class.
     */
    public function initialize() {
        app()->booted(
            function () {
                \AdminNavigation::getPages()->findById('site_modules')
                                ->addPage($this->makePage(1)->setIcon('fa fa-minus'));
            }
        );

        $this->updating(function ($config, \App\Models\PageModules\Icon $model) {
            $model->alias = $model->alias ? strtolower($model->alias) : $model->id;

            return true;
        });

        $this->creating(function ($config, \App\Models\PageModules\Icon $model) {
        });

        $this->created(function ($config, \App\Models\PageModules\Icon $model) {
            if ( empty($model->alias) ) {
                $model->alias = $model->id;
                $model->save();
            }
        });

        Meta::addCss('admin-custom', asset('packages\sleepingowl\default\css\custom\custom.css'));
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay() {
        Meta::addJs('components_js', ('packages/sleepingowl/default/js/admin/components/common.js'), null, true);
        $tabs = AdminDisplay::tabbed();

        $columns = [
            AdminColumn::image('image', 'Изображение')
                       ->setHtmlAttribute('class', 'hidden-sm hidden-xs foobar index-icons')
                       ->setWidth('100px'),
            AdminColumn::link('name', 'Название'),
        ];

        $active[] = AdminDisplay::datatablesAsync()
                                ->setDisplaySearch(true)
                                ->setName('active')
                                ->setModelClass(Icon::class)
                                ->setColumns($columns)
                                ->setApply(function ($query) {
                                    $query->where('deleted_at', null);
                                })
                                ->paginate(10);

        $deleted[] = AdminDisplay::datatablesAsync()
                                 ->setDisplaySearch(true)
                                 ->setName('deleted')
                                 ->setModelClass(Icon::class)
                                 ->setColumns($columns)
                                 ->setApply(function ($query) {
                                     $query->where('deleted_at', '!=', null);
                                 })
                                 ->paginate(10);

        $all_icons[] = AdminFormElement::custom(function () {
        })
                                       ->setDisplay(function () {
                                           $icons = Icon::get();

                                           $icons = view('admin::components.icons.all_icons', [
                                               'icons' => $icons,
                                           ]);

                                           return $icons;
                                       });
        $tabs->appendTab(new FormElements($active), 'Активные');
        $tabs->appendTab(new FormElements($deleted), 'Удаленные');
        $tabs->appendTab(new FormElements($all_icons), 'Все иконки');

        return $tabs;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id) {

        $dir_path = 'images/icons';

        if ( !is_dir($dir_path) ) {
            mkdir($dir_path);
        }

        $super = Auth::user()->hasRole('super');

        if ( $this->model->withTrashed()->find($id) && !$super ) {
            $readonly = $this->model->withTrashed()->find($id)->readonly;
        } else {
            $readonly = 0;
        }
        $form = AdminForm::panel();

        if ( $readonly ) {
            $form->addHeader(
                AdminFormElement::custom(function () {
                })
                                ->setDisplay(function () {
                                    return '<b class="text-danger">Иконка используется в шаблонах сайта! Редактирование доступно только суперадминам.</b>';
                                })
            );
        }

        $form->addBody(
            AdminFormElement::image('image', 'Изображение( ТОЛЬКО SVG! )')
                            ->setUploadPath(function (\Illuminate\Http\UploadedFile $file) use ($id) {

                                $extension = $file->getClientOriginalExtension();

                                if ( $extension != 'svg' ) {

                                    return Redirect::back();

                                } else {
                                    $filename = 'images/icons/' . $id;

                                    if ( !is_dir($filename) ) {
                                        mkdir($filename);
                                    } else {
                                        $files = glob($filename . '/*');
                                        foreach ( $files as $file ) {
                                            if ( is_file($file) ) {
                                                unlink($file);
                                            }
                                        }
                                    }

                                    return $filename;
                                }
                            })
                            ->setUploadFileName(function (\Illuminate\Http\UploadedFile $file) use ($id) {
                                return 'icon_' . ($id ? $id : str_random(5)) . '.' . $file->getClientOriginalExtension();
                            })
                            ->required()->setReadonly($readonly),

            AdminFormElement::text('name', 'Название')
        )->setHtmlAttribute('class', 'icons_wrap');

        if ( $super ) {
            $form->addBody(
                AdminFormElement::text('icon_alias', 'Псевдоним (icon__)'),
                AdminFormElement::checkbox('readonly', 'Только чтение(для не super)')->setDefaultValue(0)
            );
        }

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate() {
        $lastIconsId = 0;
        $lastIcons   = $this->model->withTrashed()->orderBy('id', 'desc')->first();

        if ( $lastIcons ) {
            $lastIconsId = $lastIcons->id;
        }

        return $this->onEdit($lastIconsId + 1);
    }

    /**
     * @return void
     */
    public function onDelete($id) {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id) {
        // remove if unused
    }

    public function reloadPage() {
        return Redirect::back()->with('message', 'Operation Successful !');
    }

}

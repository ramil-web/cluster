<?php

namespace App\Providers;

use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $widgets = [
        \Admin\Widgets\NavigationUserBlock::class,
        \Admin\Widgets\DashboardMap::class,
    ];

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\User::class          => 'App\Http\Sections\Users',
        \App\Models\Admin::class         => 'App\Http\Sections\Admins',
        \App\Models\Role::class          => 'App\Http\Sections\Roles',
        \App\Models\Permission::class    => 'App\Http\Sections\Permissions',
        \App\Models\Sidebar::class       => 'App\Http\Sections\Sidebars',
        \App\Models\Pages\News::class    => 'App\Http\Sections\News',
        \App\Models\Pages\Contact::class => 'App\Http\Sections\Contacts',
        \App\Models\Pages\Home::class    => 'App\Http\Sections\Homes',
        \App\Models\Pages\Post::class    => 'App\Http\Sections\Posts',
        \App\Models\Pages\Gallery::class => 'App\Http\Sections\Galleries',

        \App\Models\Settings\Setting::class => 'App\Http\Sections\Settings',

        \App\Models\PageType::class         => 'App\Http\Sections\PageTypes',
        \App\Models\Blocks\BlockType::class => 'App\Http\Sections\BlockTypes',

        \App\Models\PageModules\Icon::class => 'App\Http\Sections\PageModules\Icons',

        \App\Models\WBParser\WBBaseProduct::class => 'App\Http\Sections\WB\WBBaseProducts',
        \App\Models\WBParser\WBProduct::class     => 'App\Http\Sections\WB\WBProducts',
        \App\Models\WBParser\WBOrder::class       => 'App\Http\Sections\WB\WBOrders',
        \App\Models\WBParser\WBSale::class        => 'App\Http\Sections\WB\WBSales',
        \App\Models\WBParser\WBSupply::class      => 'App\Http\Sections\WB\WBSupplies',
        \App\Models\WBParser\WBCity::class        => 'App\Http\Sections\WB\Parser\WBCities',
        \App\Models\WBParser\WBCategory::class    => 'App\Http\Sections\WB\Parser\WBCategories',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        //Весь сыр бор ради хостинга, локалка работает и так
        //Короче так, policies должны быть прописаны именно так, с такими слэшами
        $this->registerPolicies('App\\Http\\Policies\\');

        // Регистрация виджетов в реестре
        //А пути регистрируются так, важны и слэши и ПЕРВАЯ буква классов, с App хостинг работать не будет
        $this->loadViewsFrom(base_path('app/AdminViews/views/'), 'admin');

        /** @var WidgetsRegistryInterface $widgetsRegistry */
        $widgetsRegistry = $this->app[\SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface::class];

        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }

        parent::boot($admin);
    }
}

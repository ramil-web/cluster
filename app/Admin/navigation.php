<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//

//
// // or
//
//AdminSection::addMenuPage(\App\User::class);

//AdminNavigation::addPage(['title' => 'test', 'priority' => 1000, 'bage' => function() {
//    return 100;
//}]);

AdminNavigation::addPage(\App\Models\Admin::class)
    ->setTitle('Администрирование')
    ->setId('administration')
    ->setIcon('fa fa-exclamation')
    ->setPriority(0)
    ->setAccessLogic(function (Page $page) {
        return auth()->user()->hasRole('super');
    });

AdminNavigation::addPage(\App\Models\PageType::class)
    ->setTitle('Структура сайта')
    ->setId('site_structure')
    ->setIcon('fa fa-window-restore')
    ->setPriority(1)
    ->setAccessLogic(function (Page $page) {
        return auth()->user()->hasRole('super');
    });

AdminNavigation::addPage(\App\Models\FakeWBModel::class)
    ->setTitle('WB')
    ->setId('site_wb')
    ->setIcon('fa fa-server')
    ->setPriority(2);

AdminNavigation::addPage(\App\Models\FakeWBParserModel::class)
    ->setTitle('WB Парсер')
    ->setId('parser_wb')
    ->setIcon('fa fa-server')
    ->setPriority(3)
    ->setAccessLogic(function (Page $page) {
        return auth()->user()->hasRole('super');
    });



AdminNavigation::addPage(\App\Models\News::class)
    ->setTitle('Контент')
    ->setId('site_content')
    ->setIcon('fa fa-server')
    ->setPriority(4)
    ->setAccessLogic(function (Page $page) {
        return auth()->user()->hasRole('super');
    });

AdminNavigation::addPage(\App\Models\FakeModulesModel::class)
    ->setTitle('Модули')
    ->setId('site_modules')
    ->setIcon('fa fa-server')
    ->setPriority(7);

return [
    [
        'priority' => '0',
        'title'    => 'Стартовый виджет',
        'icon'     => 'fa fa-dashboard',
        'url'      => route('admin.dashboard'),
    ],
    //[
    //    'title' => "Администрирование",
    //    'icon' => 'fa fa-newspaper-o',
    //    'priority' =>'5',
    //    'id'=>'administration',
    //],


    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
    //		      ));
    //
    //		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];
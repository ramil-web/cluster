<?php

// Главная
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Главная', route('home.index'));
});

//^^^^^^^^^^^^^^^^^^^^WB
// Главная > Базовые товары
Breadcrumbs::register('wb_base_index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Базовые товары',route('wb.base_index'));
});

// Главная > Базовые товары > Страница товара
Breadcrumbs::register('wb_base_item', function ($breadcrumbs) {
    $breadcrumbs->parent('wb_base_index');
    $breadcrumbs->push('Товар');
});

// Главная > Базовые товары > Аналитика
Breadcrumbs::register('wb_analytics', function ($breadcrumbs) {
    $breadcrumbs->parent('wb_base_index');
    $breadcrumbs->push('Аналитика',route('wb.analytics'));
});

// Главная > Подсортировки
Breadcrumbs::register('wb_undersort_index', function ($breadcrumbs) {
    $breadcrumbs->push('Готовые подсортировки',route('wb.undersort_index'));
});

// Главная > Подсортировки > Создать подсортировку
Breadcrumbs::register('wb_undersort_run', function ($breadcrumbs) {
    $breadcrumbs->parent('wb_undersort_index');
    $breadcrumbs->push('Создать подсортировку');
});

// Главная > Базовые товары > Подсортировки > Подсортировка
Breadcrumbs::register('wb_undersort_item', function ($breadcrumbs, $undersort) {
    $breadcrumbs->parent('wb_undersort_index');
    $breadcrumbs->push($undersort->getTitle());
});

// Главная > Базовые товары > Сводная
Breadcrumbs::register('wb_pivot', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Сводная таблица',route('wb.pivot_table'));
});

// Главная >Rivals
Breadcrumbs::register('wb_rivals', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Rivals',route('wb.rival_index'));
});

//____________________WB










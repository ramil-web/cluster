<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//__________________Авторизация________________________________________________
Auth::routes();
//__________________Админка________________________________________________
Route::get('/admin_login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
Route::group(['prefix' => 'admin'], function () {
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('setAdmin/{id}', 'Auth\AdminLoginController@setAdmin')->name('admin.setUser')
        ->where('id', '^[a-z0-9-]+$');
    //__________________Блоки________________________________________________
    //  Маршрут для блоков(iframe)
    Route::get('/page_blocks/{alias}/{id?}', 'PageBlocks\PageBlocksAdminController@getPageBlocks')
        ->where('id', '^[a-z0-9-]+$');

    Route::post('/sortBlocks', 'PageBlocks\PageBlocksAdminController@sortBlocks');

    Route::post('/saveTextBlock', 'PageBlocks\PageBlocksAdminController@saveTextBlock');
    Route::post('/dellTextBlock', 'PageBlocks\PageBlocksAdminController@dellTextBlock');

    Route::post('/saveImageBlock', 'PageBlocks\PageBlocksAdminController@saveImageBlock');
    Route::post('/imageBlockUploadImage', 'PageBlocks\PageBlocksAdminController@imageBlockUploadImage');
    Route::post('/dellImageBlock', 'PageBlocks\PageBlocksAdminController@dellImageBlock');

    Route::post('/saveSliderBlock', 'PageBlocks\PageBlocksAdminController@saveSliderBlock');
    Route::post('/dellSliderBlock', 'PageBlocks\PageBlocksAdminController@dellSliderBlock');
    Route::post('/sliderBlockUploadImage', 'PageBlocks\PageBlocksAdminController@sliderBlockUploadImage');
    Route::post('/sliderBlockDeleteImage', 'PageBlocks\PageBlocksAdminController@sliderBlockDeleteImage');

    Route::post('/saveImageTextBlock', 'PageBlocks\PageBlocksAdminController@saveImageTextBlock');
    Route::post('/dellImageTextBlock', 'PageBlocks\PageBlocksAdminController@dellImageTextBlock');

    Route::post('/saveSliderTextBlock', 'PageBlocks\PageBlocksAdminController@saveSliderTextBlock');
    Route::post('/addNewSliderTextItem', 'PageBlocks\PageBlocksAdminController@addNewSliderTextItem');
    Route::post('/dellSliderTextBlock', 'PageBlocks\PageBlocksAdminController@dellSliderTextBlock');

    Route::post('/saveGoogleMapBlock', 'PageBlocks\PageBlocksAdminController@saveGoogleMapBlock');
    Route::post('/dellGoogleMapBlock', 'PageBlocks\PageBlocksAdminController@dellGoogleMapBlock');
    Route::post('/saveGoogleMapPoint', 'PageBlocks\PageBlocksAdminController@saveGoogleMapPoint');
    Route::post('/dellGoogleMapPoint', 'PageBlocks\PageBlocksAdminController@dellGoogleMapPoint');

});


//__________________Сайт________________________________________________
Route::get('/', 'HomeController@index')->name('home.index');

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/{id}', 'NewsController@item')->name('news.item')->where('id', '^[a-z0-9-_]+$');
});

//^^^^^^^^^^^^^^^^^^^^WBAnalytics
Route::group(['prefix' => 'wb'], function () {
    Route::get('/', 'Pages\WBAnalyticsController@base_index')->name('wb.base_index');
    Route::get('/base_item/{wb_id}', 'Pages\WBAnalyticsController@base_item')->name('wb.base_item');
});

Route::get('/analytics', 'Pages\WBAnalyticsController@analytics')->name('wb.analytics');
Route::get('/test_index', 'Pages\WBTestController@index')->name('wb.test_index');
Route::get('/pivot_table', 'Pages\WBPivotController@index')->name('wb.pivot_table');

Route::group(['prefix' => 'undersort'], function () {
    Route::get('/', 'Pages\WBUndersortController@undersort_index')->name('wb.undersort_index');
    Route::get('/item/{undersort_id}', 'Pages\WBUndersortController@undersort_item')->name('wb.undersort_item');
    Route::get('/run', 'Pages\WBUndersortController@undersort_run')->name('wb.undersort_run');
});

//Route::get('/undersort_loading', 'Pages\WBAnalyticsController@undersort_loading')->name('wb.undersort_loading');

Route::group(['prefix' => 'rivals'], function () {
    Route::get('/', 'Pages\WBRivalsController@index')->name('wb.rival_index');
});

//____________________WBAnalytics

//Route::get('/home', 'HomeController@index')->name('home');

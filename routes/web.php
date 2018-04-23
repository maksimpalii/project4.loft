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

Route::get('/', 'BookController@index');

//Route::get('mail/send', 'MailController@send');

Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin');
    Route::get('config', 'BookController@adminConfig')->name('admin_config');
    Route::post('config', 'BookController@adminConfigStore')->name('admin_config');
    Route::get('book', 'BookController@adminBook')->name('admin_book');
    Route::get('book/create', 'BookController@create');
    Route::post('book/create', 'BookController@store');
    Route::get('book/edit/{book_id}', 'BookController@edit');
    Route::post('book/update/{book_id}', 'BookController@update');
    Route::get('book/destroy/{book_id}', 'BookController@destroy');
    Route::get('order', 'OrderController@adminOrder')->name('admin_order');
    Route::get('category', 'BookController@adminCategory')->name('admin_category');
    Route::get('category/create', 'CategoryController@create');
    Route::post('category/create', 'CategoryController@store');
    Route::get('category/edit/{id}', 'CategoryController@edit');
    Route::post('category/update/{id}', 'CategoryController@update');
    Route::get('category/destroy/{id}', 'CategoryController@destroy');

});

Route::get('/populate', 'PopulateController@index');


Route::get('/about', 'AboutController@index')->name('about');
Route::get('/category/{id}', 'CategoryController@index');
Route::get('/product/{id}', 'BookController@product');
Route::get('/search', ['uses' => 'BookController@search', 'as' => 'search']);
Route::post('/order/store', 'OrderController@store');
Route::get('/order', 'OrderController@index')->name('order');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});


Auth::routes();



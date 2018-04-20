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
    Route::get('book/create', 'BookController@adminBookCreate');
    Route::post('book/create', 'BookController@adminBookStore');
    Route::get('book/edit/{book_id}', 'BookController@adminBookEdit');
    Route::post('book/update/{book_id}', 'BookController@adminBookUpdate');
    Route::get('book/destroy/{book_id}', 'BookController@adminBookDestroy');
    Route::get('order', 'OrderController@adminOrder')->name('admin_order');
    Route::get('category', 'BookController@adminCategory')->name('admin_category');
    Route::get('category/create', 'CategoryController@adminCategoryCreate');
    Route::post('category/create', 'CategoryController@adminCategoryStore');
    Route::get('category/edit/{id}', 'CategoryController@adminCategoryEdit');
    Route::post('category/update/{id}', 'CategoryController@adminCategoryUpdate');
    Route::get('category/destroy/{id}', 'CategoryController@adminCategoryDestroy');

});

Route::get('/populate', 'PopulateController@index');


Route::get('/about', 'AboutController@index')->name('about');
Route::get('/category/{id}', 'CategoryController@index');
Route::get('/product/{id}', 'BookController@product');
Route::get('/search', ['uses' => 'BookController@search', 'as' => 'search']);
Route::post('/order/store', 'OrderController@store');
Route::get('/order', 'OrderController@index')->name('order');


Auth::routes();



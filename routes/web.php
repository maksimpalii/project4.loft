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
//Route::get('/test', 'BookController@test');

//Route::put('post/{id}', function ($id) {
//})->middleware('role:editor');

//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/test', 'BookController@test');
//});

Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin'], function () {

    // Route::get('/test', 'HomeController@index')->name('test');
//    Route::get('/test', 'BookController@test');
    Route::get('book', 'BookController@adminbook')->name('admin_book');
    Route::get('book/create', 'BookController@admincreate');
    Route::post('book/create', 'BookController@adminstore');
    Route::get('book/edit/{book_id}', 'BookController@bookedit');
    Route::post('book/update/{book_id}', 'BookController@bookupdate');
    Route::get('book/destroy/{book_id}', 'BookController@bookdestroy');
    Route::get('order', 'OrderController@adminorder')->name('admin_order');
    Route::get('category', 'BookController@admincategory')->name('admin_category');
    Route::get('category/create', 'CategoryController@categorycreate');
    Route::post('category/create', 'CategoryController@categorystore');
    Route::get('category/edit/{id}', 'CategoryController@categoryedit');
    Route::post('category/update/{id}', 'CategoryController@categoryupdate');
    Route::get('category/destroy/{id}', 'CategoryController@categorydestroy');


});


Route::get('/populate', 'PopulateController@index');


Route::get('mail/send', 'MailController@send');

Route::get('/about', 'AboutController@index')->name('about');
Route::get('/category/{id}', 'CategoryController@index');
Route::get('/product/{id}', 'BookController@product');
Route::get('/search', ['uses' => 'BookController@search', 'as' => 'search']);
Route::post('/order/store', 'OrderController@store');
Route::get('/order', 'OrderController@index')->name('order');

Route::group(['middleware' => 'auth', 'prefix' => 'posts'], function () {
    Route::get('populate', 'PostController@populate');
    Route::get('/', 'PostController@index');
    Route::get('create', 'PostController@create')->name('posts_create');
    Route::post('store', 'PostController@store');
    Route::get('edit/{post_id}', 'PostController@edit');
    Route::post('update/{post_id}', 'PostController@update');
    Route::get('destroy/{post_id}', 'PostController@destroy');
});


Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/guide', 'IndexController@guide')->name('guide');
Route::get('/stories', 'IndexController@stories')->name('stories');
Route::get('/topics', 'IndexController@topics')->name('topics');
Route::get('/stories/{id}', 'IndexController@story')->name('story');
Route::get('/topics/{id}', 'IndexController@topic')->name('topic');

Route::middleware(['auth'])->group(function () {
    Route::resource('items', 'ItemController');
    Route::resource('cart', 'CartController');
    Route::resource('addresses', 'AddressController');
    Route::resource('gifts', 'GiftController');
    Route::resource('coupons', 'CouponController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::post('/store_avatar', 'HomeController@store_avatar')->name('store_avatar');
    Route::post('/receive_gift', 'GiftController@receive_gift')->name('receive_gift');
});

Auth::routes();

Route::get('auth/{service}', 'Auth\OAuthController@redirectToProvider')->name('oauth');
Route::get('auth/{service}/callback', 'Auth\OAuthController@handleProviderCallback');

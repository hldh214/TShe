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
    Route::get('/alipay/{out_trade_no}/{total_amount}/{subject}', 'PayController@alipay')->name('alipay');
    Route::get('/wxpay', 'PayController@wxpay')->name('wxpay');
    Route::get('/alipay/return', 'PayController@alipay_return')->name('alipay_return');
});

Auth::routes();

Route::get('auth/{service}', 'Auth\OAuthController@redirectToProvider')->name('oauth');
Route::get('auth/{service}/callback', 'Auth\OAuthController@handleProviderCallback');

Route::post('/alipay/notify', 'PayController@alipay_notify')->name('alipay_notify');
Route::post('/wxpay/notify', 'PayController@wxpay_notify')->name('wxpay_notify');

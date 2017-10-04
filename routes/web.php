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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('items', 'ItemController');
    Route::resource('cart', 'CartController');
    Route::resource('addresses', 'AddressController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
});

Auth::routes();

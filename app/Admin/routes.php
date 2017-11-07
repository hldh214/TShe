<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('materials', MaterialController::class);
    $router->resource('materialTypes', MaterialTypeController::class);
    $router->resource('words', WordController::class);
    $router->resource('items', ItemController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('styles', StyleController::class);
    $router->resource('colors', ColorController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('gifts', GiftController::class);
    $router->resource('coupons', CouponController::class);
    $router->resource('carousels', CarouselController::class);
    $router->resource('stories', StoryController::class);
    $router->resource('topics', TopicController::class);
    $router->resource('users', UserController::class);
    $router->resource('addresses', AddressController::class);
    $router->resource('indexImages', IndexImageController::class);
    $router->post('upload', 'StyleController@upload')->name('upload');
});

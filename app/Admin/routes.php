<?php

use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\SubCategoryController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('sub-categories', SubCategoryController::class);
// routes/web.php or routes/admin.php
    $router->get('api/categories', 'CategoryController@apiCategories');


});

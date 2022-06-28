<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\RequestController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('requests', RequestController::class);
    $router->resource('pays', PayController::class);
    $router->resource('customers', CustomerController::class);
    $router->get('/port', [RequestController::class,'make']);
    $router->resource('fees', FeeController::class);
    // $router->get('/fee', [RequestController::class,'fee']);
    // $router->get('/fee', [RequestController::class,'fee']);
    // $router->resource('requests', FeesController::class);

    // $router->get('/fee/{id}/edit', [RequestController::class,'prof']);

});

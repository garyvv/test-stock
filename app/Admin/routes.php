<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('/sellers', 'SellerController@index');
    $router->any('/sellers/edit', 'SellerController@edit');

    $router->get('/customers', 'CustomerController@index');
    $router->any('/customers/edit', 'CustomerController@edit');

    $router->get('/depots', 'DepotController@index');
    $router->any('/depots/edit', 'DepotController@edit');

    $router->get('/categories', 'CategoryController@index');
    $router->any('/categories/edit', 'CategoryController@edit');

    $router->get('/purchase-records', 'PurchaseRecordController@index');
    $router->any('/purchase-records/edit', 'PurchaseRecordController@edit');

});

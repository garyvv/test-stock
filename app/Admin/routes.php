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

    $router->get('/users', 'UserController@index');
    $router->any('/users/{uid}/edit', 'UserController@edit');

    $router->get('/customers', 'CustomerController@index');
    $router->any('/customers/edit', 'CustomerController@edit');

    $router->get('/depots', 'DepotController@index');
    $router->any('/depots/edit', 'DepotController@edit');

    $router->get('/categories', 'CategoryController@index');
    $router->any('/categories/edit', 'CategoryController@edit');

    $router->get('/purchase-records', 'PurchaseRecordController@index');
    $router->any('/purchase-records/edit', 'PurchaseRecordController@edit');

});

Route::group([
    'prefix'        => config('admin.prefix') . '/redis',
    'namespace'     => Admin::controllerNamespace() . '\\Redis',
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/home/{config}', 'HomeController@index');
    $router->get('/detail/{key}/config/{config}', 'HomeController@detail');
    $router->delete('/detail/{key}/config/{config}', 'HomeController@delete');

});

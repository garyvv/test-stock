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

    $router->resource('users', UserController::class);

    $router->get('/customers', 'CustomerController@index');
    $router->any('/customers/edit', 'CustomerController@edit');

    $router->get('/depots', 'DepotController@index');
    $router->any('/depots/edit', 'DepotController@edit');

    $router->get('/categories', 'CategoryController@index');
    $router->any('/categories/edit', 'CategoryController@edit');

    $router->get('/purchase-records', 'PurchaseRecordController@index');
    $router->any('/purchase-records/edit', 'PurchaseRecordController@edit');

    $router->any('/vicky/story', 'VickyController@index');
    $router->any('/vicky/story/edit', 'VickyController@edit');

//    OSS
    $router->get('oss/bucket/{bucket}', 'OssController@listObject');
    $router->get('oss/auth', 'OssController@auth');

    $router->get('html', 'HtmlController@editHtml');
    $router->post('html', 'HtmlController@updateHtml');

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

Route::group([
    'prefix'        => config('admin.prefix') . '/toy',
    'namespace'     => Admin::controllerNamespace() . '\\Toy',
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->any('products', 'ProductController@index');
    $router->any('products/create', 'ProductController@anyForm');
    $router->any('products/edit', 'ProductController@anyEdit');

});

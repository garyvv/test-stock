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



//Stock  页面路由
Route::group([
    'namespace' => 'Stock'
], function () {
    Route::get('/','CategoryController@index');
    Route::get('/categories','CategoryController@lists');
    Route::get('/categories/{categoryId}','CategoryController@detail');
    Route::get('/categories/{categoryId}/edit','CategoryController@edit');
});



Route::group([
    	'prefix' => 'lease',
	'namespace' => 'LeaseStore'
    ], function () {
    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'index']); 
    Route::get('/products/{product_id}', ['uses' => 'ProductController@detail', 'as' => 'product-detail']);	
});

Route::match(['get','post'],'wechat_oauth_callback','WeChat\WeChatController@oauthCallback');


Route::group([
    'prefix' => 'store',
    'middleware' => 'wechat.auth',
], function () {
    Route::get('/', ['uses' => 'DemoController@index', 'as' => 'store']);
});




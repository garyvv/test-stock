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
    Route::get('/',function(){
        return view('Stock.index');
    });
    Route::get('/categories',function(){
        return view('Stock.categoryList');
    });
    Route::get('/categories/{categoryId}',function($cid){
        return view('Stock.categoryDetail', compact('cid'));
    });
    Route::get('/categories/{categoryId}/edit',function($cid){
        return view('Stock.categoryEdit', compact('cid'));
    });
    Route::get('/sellers',function(){
        return view('Stock.sellerList');
    });
    Route::get('/sellers/{sellerId}',function($sid){
        return view('Stock.sellerDetail', compact('sid'));
    });
    Route::get('/sellers/{sellerId}/edit',function($sid){
        return view('Stock.sellerEdit', compact('sid'));
    });
    Route::get('/depots',function(){
        return view('Stock.depotList');
    });
    Route::get('/purchases',function(){
        return view('Stock.purchaseList');
    });
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




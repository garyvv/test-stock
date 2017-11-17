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
    'namespace' => 'Vicky'
], function () {
    Route::get('/',function(){
        return view('Vicky.index');
    });
    Route::get('/categories/create',function(){
        return view('Stock.categoryCreate');
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
    Route::get('/sellers/create',function(){
        return view('Stock.sellerCreate');
    });
    Route::get('/sellers/{sellerId}',function($sid){
        return view('Stock.sellerDetail', compact('sid'));
    });
    Route::get('/sellers/{sellerId}/edit',function($sid){
        return view('Stock.sellerEdit', compact('sid'));
    });
    Route::get('/depots',['middleware' => 'user.permission',function(){
        return view('Stock.depotList');
    }]);
    Route::get('/depots/create',function(){
        return view('Stock.depotCreate');
    });
    Route::get('/depots/{depotId}',function($did){
        return view('Stock.depotDetail', compact('did'));
    });
    Route::get('/depots/{depotId}/edit',function($did){
        return view('Stock.depotEdit', compact('did'));
    });
    Route::get('/purchase_records',function(){
        return view('Stock.purchaseRecordList');
    });
    Route::get('/purchase_records/create',function(){
        return view('Stock.purchaseRecordCreate');
    });
    Route::get('/purchase_records/{purchaseRecordId}',function($pid){
        return view('Stock.purchaseRecordDetail',compact('pid'));
    });
    Route::get('/purchase_records/{purchaseRecordId}/edit',function($pid){
        return view('Stock.purchaseRecordEdit',compact('pid'));
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




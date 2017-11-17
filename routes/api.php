<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::match(['get','post'],'wechat_oauth_callback','WeChat\WeChatController@oauthCallback');
Route::match(['get','post'],'wechat_message','WeChat\WeChatMessage@test');
Route::match(['get','post'],'authlogin','WeChat\WeChatAuthLogin@authlogin');
Route::match(['get','post'],'login','WeChat\WeChatAuthLogin@login');
Route::match(['get','post'],'callback','WeChat\WeChatCallBack@callback');
Route::any('wechat_msg', ['uses' => 'WechatMsgController@index', 'as' => 'wechat_msg']);
Route::get('v1/wechat_login', ['middleware' => 'wechat.auth', 'uses' => 'WeChat\WeChatController@login']);
Route::get('v1/login','WechatLoginController@login');
Route::get('v1/test_login/{userId}','WechatLoginController@testLogin');

/**
 * 业务接口
 */
Route::group([
	'prefix' => 'v1',
    'namespace' => 'Stock',
], function() {
    Route::get('/users','UserController@getUserInfo');

    Route::get('/categories','CategoryController@lists');
    Route::post('/categories','CategoryController@create');
    Route::get('/categories/form','CategoryController@form');
    Route::get('/categories/{categoryId}','CategoryController@detail');
    Route::get('/categories/{categoryId}/form','CategoryController@form');
    Route::put('/categories/{categoryId}/edit','CategoryController@edit');
    Route::delete('/categories/{categoryId}/delete','CategoryController@delete');

    Route::get('/sellers','SellerController@lists');
    Route::post('/sellers','SellerController@create');
    Route::get('/sellers/form','SellerController@form');
    Route::get('/sellers/{sellerId}','SellerController@detail');
    Route::get('/sellers/{sellerId}/form','SellerController@form');
    Route::put('/sellers/{sellerId}','SellerController@edit');
    Route::delete('/sellers/{sellerId}','SellerController@delete');

    Route::get('/depots','DepotController@lists');
    Route::post('/depots','DepotController@create');
    Route::get('/depots/form','DepotController@form');
    Route::get('/depots/{depotId}','DepotController@detail');
    Route::get('/depots/{depotId}/form','DepotController@form');
    Route::put('/depots/{depotId}','DepotController@edit');
    Route::delete('/depots/{depotId}','DepotController@delete');

    Route::get('/purchase_records','PurchaseRecordController@lists');
    Route::post('/purchase_records','PurchaseRecordController@create');
    Route::get('/purchase_records/form','PurchaseRecordController@form');
    Route::get('/purchase_records/{purchaseRecordId}','PurchaseRecordController@detail');
    Route::get('/purchase_records/{purchaseRecordId}/form','PurchaseRecordController@form');
    Route::put('/purchase_records/{purchaseRecordId}','PurchaseRecordController@edit');
    Route::delete('/purchase_records/{purchaseRecordId}','PurchaseRecordController@delete');
});

Route::any('/v1/scans', function() {
    $data = [
        'name' => '儿童玩具车',
        'price' => 18.5,
        'in_price' => 8,
        'multi_price' => 14,
        'quantity' => 10,
        'company' => '乐高'
    ];

    $result = [
        'code' => 1001,
        'msg' => '请求成功',
        'data' => $data
    ];

    echo json_encode($result);
});
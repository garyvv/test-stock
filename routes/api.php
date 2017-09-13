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
    Route::get('/categories','CategoryController@getLists');
    Route::post('/categories/create','CategoryController@create');
    Route::get('/categories/{categoryId}/detail','CategoryController@getDetail');
    Route::get('/categories/{categoryId}/edit','CategoryController@cateEdit');
    Route::put('/categories/{categoryId}/update','CategoryController@update');
    Route::delete('/categories/{categoryId}/delete','CategoryController@delete');
    Route::post('/categories/getForm','CategoryController@getForm');
    Route::get('/sellers','SellerController@getLists');
    Route::post('/sellers/create','SellerController@create');
    Route::get('/sellers/{sellerId}/detail','SellerController@getDetail');
    Route::post('/sellers/{sellerId}/edit','SellerController@edit');
    Route::post('/sellers/{sellerId}/update','SellerController@update');
    Route::delete('/sellers/{sellerId}/delete','SellerController@delete');
    Route::get('/depots','DepotController@getLists');
    Route::post('/depots/create','DepotController@create');
    Route::get('/depots/{depotId}/detail','DepotController@getDetail');
    Route::get('/depots/{depotId}/getForm','DepotController@getForm');
    Route::put('/depots/{depotId}/update','DepotController@update');
    Route::delete('/depots/{depotId}/delete','DepotController@delete');
    Route::get('/purchase_records','PurchaseRecordController@getLists');
    Route::post('/purchase_records/create','PurchaseRecordController@create');
    Route::get('/purchase_records/getForm','PurchaseRecordController@getForm');
    Route::get('/purchase_records/{purchaseRecordId}/detail','PurchaseRecordController@getDetail');
    Route::put('/purchase_records/{purchaseRecordId}/update','PurchaseRecordController@update');
    Route::delete('/purchase_records/{purchaseRecordId}/delete','PurchaseRecordController@delete');
});

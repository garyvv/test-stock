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


/**
 * 业务接口
 */
Route::group([
	'prefix' => 'v1',
    'namespace' => 'Stock',
], function() {
    Route::post('/','CategoryController@getUserInfo');
    Route::get('/login','CategoryController@login');
    Route::post('/categories','CategoryController@getLists');
    Route::post('/categories/{categoryId}/detail','CategoryController@getDetail');
    Route::post('/categories/{categoryId}/edit','CategoryController@cateEdit');
    Route::post('/categories/{categoryId}/update','CategoryController@update');
});

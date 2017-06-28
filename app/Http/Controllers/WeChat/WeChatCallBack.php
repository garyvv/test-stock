<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 0:16
 */
namespace App\Http\Controllers\WeChat;

use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Input;


class WeChatCallBack
{

    public function callBack()
    {
        \Log::debug(Input::all());
        \Log::debug('===========callback==============');
        $config = config('wechat');
        $app = new Application($config);
        $url = Input::get('url','/');
        \Log::debug('=================stop=====================');
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session(['wechat_user' => $user->toArray()]);
        header('location:'. $url); // 跳转到 user/profile
//        header('location:http://authlogin.local.com/api/authlogin' ); // 跳转到 user/profile
    }
}


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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;


class WeChatCallBack
{

    public function callBack()
    {
        $config = config('wechatstock');
        $app = new Application($config);
        $targetUrl = Input::get('url','/');
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user()->toArray();
        $token = md5($user['id'] . 'wxauth' . time());
        \Log::debug("WechatCallBack:".$token);
        Redis::set($token,json_encode($user));
        Redis::expire($token,60 * 60 * 24);
//        setCookie  可根据需要， 比如前端用Vue，拼接参数到url返回给前端
        $cookie = Cookie::make('token', $token, $minutes = 60 * 24, $path = null, $domain = null, $secure = false, $httpOnly = false);
        return redirect($targetUrl)->withCookie($cookie);
    }
}


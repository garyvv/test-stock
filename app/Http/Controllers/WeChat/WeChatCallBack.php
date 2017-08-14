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
use Illuminate\Support\Facades\Redis;


class WeChatCallBack
{

    public function callBack()
    {
        $config = config('wechatstock');
        $app = new Application($config);
        $url = Input::get('url','/');
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        Redis::set('wechat_user1',json_encode($user));
        Redis::expire('wechat_user1',1000);
        header('location:'. $url); // 跳转到 user/profile
//        header('location:http://authlogin.local.com/api/authlogin' ); // 跳转到 user/profile
    }
}


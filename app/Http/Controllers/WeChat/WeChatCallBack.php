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
use App\Models\StUser;


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



        $setUser = new StUser();
        $openid = $user['id'];
        $info = $user['original'];
        $userInfo = $setUser->getUser($openid);//检查数据库是否存在数据
        if(empty($userInfo->uid)){
            $userInfo->openid = $info['openid'];
            $userInfo->nickname = $info['nickname'];
            $userInfo->headimgurl = $info['headimgurl'];
            $userInfo->sex = $info['sex'];
            $userInfo->language = $info['language'];
            $userInfo->country = $info['country'];
            $userInfo->province = $info['province'];
            $userInfo->city = $info['city'];
            $userInfo->save();
        }else{
            $userInfo = $setUser->find($userInfo->uid);
            //更新
            $userInfo['openid'] = $info['openid'];
            $userInfo['nickname'] = $info['nickname'];
            $userInfo['headimgurl'] = $info['headimgurl'];
            $userInfo['sex'] = $info['sex'];
            $userInfo['language'] = $info['language'];
            $userInfo['country'] = $info['country'];
            $userInfo['province'] = $info['province'];
            $userInfo['city'] = $info['city'];
            $userInfo->save();
        }


        $token = md5($user['id'] . 'wxauth' . time());
        Redis::set($token,json_encode($user));
        Redis::expire($token,60 * 60 * 24);
//        setCookie  可根据需要， 比如前端用Vue，拼接参数到url返回给前端
        $cookie = Cookie::make('token', $token, $minutes = 60 * 24, $path = null, $domain = null, $secure = false, $httpOnly = false);
        return redirect($targetUrl)->withCookie($cookie);
    }
}


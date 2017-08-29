<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 21:53
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Stock\BaseController;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Input;
use App\Models\StUser;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;

class WechatLoginController extends Controller
{
    public function login()
    {
        $this->requestValidate([
            'url' => 'required',
        ], [
            'url.required' => '登录成功跳转链接不能为空',
        ]);
        $config = config('wechatstock');
        $url = '?url=' . urlencode(Input::get('url'));
        $config['oauth']['callback'] = '/api/callback' . $url;
        $app = new Application($config);
        $oauth = $app->oauth;
        return $oauth->redirect();
    }

    public function testLogin($userId)
    {
        $this->requestValidate([
            'url' => 'required',
        ], [
            'url.required' => '登录成功跳转链接不能为空',
        ]);

        $userInfo = StUser::find($userId);//检查数据库是否存在数据
        if(empty($userInfo)){
            return $this->respFail('not found user');
        }

        $token = md5($userInfo->openid . 'wxauth' . time());
        Redis::set($token,json_encode($userInfo));
        Redis::expire($token,60 * 60 * 24);
//        setCookie  可根据需要， 比如前端用Vue，拼接参数到url返回给前端
        $cookie = Cookie::make('token', $token, $minutes = 60 * 24, $path = null, $domain = null, $secure = false, $httpOnly = false);
        return redirect(Input::get('url'))->withCookie($cookie);
    }

}
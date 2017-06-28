<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 0:16
 */
namespace App\Http\Controllers\WeChat;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use Illuminate\Support\Facades\Input;


class WeChatAuthLogin{

    public function authLogin(){
        \Log::debug(Input::all());

        $check = Input::get('check',0);
        $url = Input::get('url','/');
        $config = config('wechat');
        $config['oauth']['callback'] = '/api/callback?url='.$url;

        // 未登录
        if (empty(session('wechat_user')) || $check == '1') {
            \Log::debug('===========success=============');
            $app = new Application($config);
            $oauth = $app->oauth;
//            $_SESSION['target_url'] = 'api/callback';
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
        // 已经登录过
        $user = session('wechat_user');
        echo '<pre>';
        var_dump($user);
        exit;

    }

    public function other(){
        echo 'success';
        exit;
    }
}


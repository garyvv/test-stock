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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function authLogin(){

        $check = Input::get('check',0);
//        $url = Input::get('url','/');
        $url = Input::get('url','/api/authlogin');
        $config = config('wechat');
        $config['oauth']['callback'] = '/api/callback?url='.$url;

        // 未登录
        if (empty(session('wechat_user')) || $check == '1') {
            $app = new Application($config);
            $oauth = $app->oauth;
//            $_SESSION['target_url'] = 'api/callback';
            return $oauth->redirect();
        }
        // 已经登录过
        $user = session('wechat_user');
        $info = $user['original'];//用户具体信息
        return view('wechat.authlogin',compact('user','info'));
    }


}


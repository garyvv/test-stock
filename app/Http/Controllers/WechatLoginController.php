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

class WechatLoginController extends BaseController
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
}
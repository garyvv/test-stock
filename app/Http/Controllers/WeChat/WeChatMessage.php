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


class WeChatMessage{

    public function test(){
        $url = env('HTTP_WEBSITE', 'garylv.com');
        $options = config('wechat');
        $app = new Application($options);
        $server = $app->server;
        $message = new Text(['content' => 'Hello world!']);
        $openId = "oKiJls8EzDhRtcRDMoJDfbfu8AwA";
        $result = $app->staff->message($message)->to($openId)->send();

    }
}


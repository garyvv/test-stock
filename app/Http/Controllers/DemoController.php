<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/3/14
 * Time: 上午12:56
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DemoController extends Controller
{
    public function index()
    {
        $userInfo = session('wechat_user');
        $openid = $userInfo['id'];
        echo "<pre>";
        var_export($userInfo);
    }
}

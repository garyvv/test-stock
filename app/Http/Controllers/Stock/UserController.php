<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 21:28
 */
namespace App\Http\Controllers\Stock;



class UserController extends BaseController
{

    public function getUserInfo()
    {
        \Log::debug("User");
        $info = $this->userInfo;
        return $this->respData($info);
    }
}
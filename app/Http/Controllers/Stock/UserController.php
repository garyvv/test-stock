<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 21:28
 */
namespace App\Http\Controllers\Stock;

use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
    public function getUserInfo()
    {
        $info = $this->userInfo;
        return $this->respData($info);
    }
}
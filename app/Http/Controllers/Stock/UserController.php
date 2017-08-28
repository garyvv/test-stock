<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 21:28
 */
namespace App\Http\Controllers\Stock;

use App\Models\StUser;
use Illuminate\Support\Facades\Input;

//use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{

    public function getUserInfo()
    {
        $getUser = new StUser();
        $userInfo = $this->userInfo;
        $openid = $userInfo['id'];
        if(!empty($openid)){
            $info = $getUser->getUser($openid);
        }else{
            $info = $userInfo['original'];
            $user = $getUser->getUser($openid);
            if(empty($user)){
                //存库
                $setUser = new StUser();
                $setUser->openid = $info['openid'];
                $setUser->nickname = $info['nickname'];
                $setUser->headimgurl = $info['headimgurl'];
                $setUser->sex = $info['sex'];
                $setUser->language = $info['language'];
                $setUser->country = $info['country'];
                $setUser->province = $info['province'];
                $setUser->city = $info['city'];
                $setUser->save();
            }

        }
        return $this->respData($info);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/16
 * Time: 23:04
 */
namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

class BaseController extends Controller
{
    public $userInfo;

    public function checkToken()
    {
        $token = Input::get('token');
        if (empty($token)) {
            return $this->respFail('token missing', self::API_CODE_TOKEN_ERROR);
        }

        $this->userInfo = json_decode(Redis::get($token),true); //获取redis中的值
//        $this->userInfo =Redis::get($token); //获取redis中的值

//        \Log::debug("checkTokenUserInfo:".$this->userInfo);
        if (!empty($this->userInfo)) {
            return $this->respFail('token error', self::API_CODE_TOKEN_ERROR);
        }
    }

}
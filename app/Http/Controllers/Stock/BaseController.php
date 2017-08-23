<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/16
 * Time: 23:04
 */
namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    public $userInfo;

    public function __construct(Request $request)
    {

        $token = $request->header('token', null);
        \Log::debug("token:" . $token);
        if (empty($token)) {
            return $this->respFail('token missing', self::API_CODE_TOKEN_ERROR);
        }

        $this->userInfo = json_decode(Redis::get($token), true); //获取redis中的值
//        $this->userInfo =Redis::get($token); //获取redis中的值

        if (empty($this->userInfo)) {
            return $this->respFail('token error', self::API_CODE_TOKEN_ERROR);
        }
    }

}
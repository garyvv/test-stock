<?php

/**
 * Created by PhpStorm.
 * User: dodd
 * Date: 2017/8/31
 * Time: 00:57
 */
namespace App\Http\Controllers\Vicky;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $result = [
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日',
                'type' => 1
            ],
            [
                'image' => 'http://img1.maka.im/assets/poster/poster-default-cover.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日',
                'type' => 2
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日',
                'type' => 1
            ],
        ];


        $data['data'] = $result;
        return $this->respData($data);
    }
}
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
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'sadfasdf',
                'datetime' => '2017年3月8日'
            ],
            [
                'image' => 'http://uc.kewaimiao.com/image/logo.png',
                'content' => 'hhhhhhhh',
                'datetime' => '2017年7月8日'
            ],
        ];


        $data['data'] = $result;
        return $this->respData($data);
    }
}
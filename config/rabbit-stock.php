<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/8/29
 * Time: 18:20
 */
return [
    'host' => env('RABBIT_HOST', '127.0.0.1'),
    'port' => env('RABBIT_POST', '5672'),
    'user' => env('RABBIT_USER', 'guest'),
    'password' => env('RABBIT_PASSWORD', 'guest'),
    'vHost' => '/',
    'connection' => null,
    'queue' => '',
    'exchange' => 'stock',
];
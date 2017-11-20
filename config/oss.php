<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/11/20
 * Time: 21:40
 */
return [

    'app_id' => env('ALI_OSS_ACCESS_KEY'),
    'app_secret' => env('ALI_OSS_ACCESS_SECRET'),

    'toy_bucket' => env('ALI_OSS_TOY_BUCKET'),
    'toy_end_point' => env('ALI_OSS_SZ_ENDPOINT'),
    'toy_view_domain' => env('ALI_OSS_TOY_VIEW_DOMAIN'),

    'vicky_bucket' => env('ALI_OSS_VICKY_BUCKET'),
    'vicky_end_point' => env('ALI_OSS_HZ_ENDPOINT'),
    'vicky_view_domain' => env('ALI_OSS_VICKY_VIEW_DOMAIN'),
];
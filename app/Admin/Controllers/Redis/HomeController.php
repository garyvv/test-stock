<?php

namespace App\Admin\Controllers\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{

    public function index($config)
    {
        $redis = Redis::connection($config);
        $list = $redis->keys('*');
//        var_dump($list);
        return view('redis.home', compact('list', 'config'));
    }

    public function detail($key, $config)
    {
        $redis = Redis::connection($config);
        $detail['value'] = $redis->get($key);
        $detail['expire'] = $redis->ttl($key);
        $detail['type'] = $redis->type($key);

        return view('redis.detail', compact('detail', 'key', 'config'));
    }

    public function delete($key, $config)
    {
        $redis = Redis::connection($config);
        $redis->del($key);

        return $this->respData();

    }

}

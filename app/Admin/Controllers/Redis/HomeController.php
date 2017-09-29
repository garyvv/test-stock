<?php

namespace App\Admin\Controllers\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{

    public function index($config)
    {

        $keyword = Input::get('keyword', '');

        $page = Input::get('page', 1);
        $perPage = 5;
        $redis = Redis::connection($config);
        $list = $redis->keys($keyword . '*');
        $total = count($list);
        $list = array_slice($list, ($page-1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator($list, $total, $perPage, $page, ['path' => '/admin/redis/home/' . $config . '?keyword=' . $keyword]);

        return view('redis.home', compact('config', 'paginator'));
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

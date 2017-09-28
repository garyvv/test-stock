<?php

namespace App\Http\Middleware;

use App\Models\StUser;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $_COOKIE['token'];
//        \Log::debug("token:".$token);
        $user = json_decode(Redis::get($token), true);
        $user = StUser::find($user['uid']);
//        \Log::debug("user:".json_encode($user_group_id));
        $redirectUrl = env('HTTP_SERVER','inventory.local.com');
        if ($user['user_group_id'] != "1") {
            return redirect($redirectUrl);
        }
        return $next($request);
    }
}

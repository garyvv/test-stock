<?php

namespace App\Http\Middleware;

use Closure;

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
//        echo '<pre>';
//        var_dump($request);
//        exit;
        if ($request->input('user_group_id') != 1) {
            return redirect('http://www.baidu.com');
        }
        return $next($request);
    }
}

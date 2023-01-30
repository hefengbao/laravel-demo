<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlacklistIpDenyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 从数据库或缓存中获取
        $blacklistIps = [];

        if (in_array($request->ip(), $blacklistIps)){
            abort(403, 'Access Denied.');
        }
        return $next($request);
    }
}

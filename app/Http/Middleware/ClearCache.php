<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class ClearCache
{
    public function handle($request, Closure $next)
    {
        $url = $request->url();
        Cache::forget($url); // Xóa cache của URL hiện tại

        return $next($request);
    }
}

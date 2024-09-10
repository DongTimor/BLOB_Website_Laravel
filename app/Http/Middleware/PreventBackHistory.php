<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Kiểm tra xem trang hiện tại có phải là content.show
        // và có tồn tại session success (set sau khi comment thành công) hay không
        if ($request->routeIs('content.show') && session()->has('success')) {

            // Xóa session message để không hiển thị lại khi back
            session()->forget('success');

            // Thiết lập các header để ngăn không cho trình duyệt lưu cache trang
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        return $response;
    }
}

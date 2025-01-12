<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy tham số locale từ route
        $locale = $request->route('locale');
        // dd($locale);die();
        // Kiểm tra xem locale có hợp lệ không (chỉ cho phép 'vi' và 'en')
        if (in_array($locale, ['vi', 'en'])) {
            // Lưu ngôn ngữ vào session
            Session::put('locale', $locale);
        }
        return $next($request);
    }
}

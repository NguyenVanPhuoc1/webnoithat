<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccessMiddleware
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
        // Kiểm tra đường dẫn và quyết định chặn hoặc cho phép truy cập
        if (auth()->check() ) {
            if(auth()->user()){
                // chặn user vào admin
                if(auth()->user()->role !== 1){
                    if(strpos($request->fullUrl(), 'admin') || strpos($request->fullUrl(), 'login') || strpos($request->fullUrl(), 'register')){
                        return redirect('/');
                    }
                }
                // if(auth()->user()->role !== 1 && strpos($request->fullUrl(), 'admin')){
                //     return redirect('/');
                // }
            }
            else if(!auth()->user()){
                return redirect('/login'); // Hoặc chuyển hướng đến trang khác
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class localeSessionRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = Session::get('language', config('app.locale'));
        if(!Session::has('language')){
            $request->session()->put('language', $language);
        }
        config(['app.locale' => $language]);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RedirectToDefaultLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $uri = $request->getRequestUri();
        $lang = $request->segment(1);
        //判断$lang是不是在数组['en','es','ja','ko','zh-CN']里面
        if (!in_array($lang, ['en', 'es', 'ja', 'ko', 'zh-CN'])) {
            Session::put('locale', 'en');
        } else {
            Session::put('locale', $lang);
        }
        app()->setLocale(Session::get('locale'));
        // // 检查是否以 / 开头并且不是语言 URI
        // if (preg_match('/^\/(?!en|es|ja|ko|zh-CN|admin|google|login|logout|callback).*/', $uri)) {
        //     if (empty($uri)||$uri=='/'||$uri=='/admin'||$uri === '/login'||$uri === '/logout'||$uri === '/login/google'||$uri === '/login/google/callback'||$uri=="/callback/login") {
        //         return $next($request);
        //     }else{
        //         return redirect('/en' . $uri); // 加上默认语言前缀
        //     } 
        // }
        // return $next($request);


        if (preg_match('/^\/(?!en|zh|es|ja|ko|zh-CN|admin|login|logout|login\/google|login\/google\/callback).*/', $uri)) {
            if (empty($uri)||$uri=='subscription'||$uri=='/'||$uri=='/admin'||$uri == "/login/google"||$uri == "/login/google/callback") {
               
            }else{
                return redirect('/en' . $uri); // 加上默认语言前缀
            } 
        }
        return $next($request);
    }
}

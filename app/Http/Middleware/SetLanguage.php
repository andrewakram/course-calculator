<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lang =session()->get('lang');
        if(isset($lang)){
            session()->put('lang',$lang);
            app()->setLocale($lang);
        }else{
            session()->put('lang','ar');
            app()->setLocale('ar');
        }
        return $next($request);
    }
}

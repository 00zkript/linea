<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckLanguage
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


        if(session()->has('language')){
            $langID = session()->get('language');

            if (app()->getLocale() != $langID ) {
                app()->setLocale( $langID );
            }

        }else{
            $lang = config('languages')[0];
            $langID = $lang['ISO 639-1'];
            app()->setLocale($langID);
        }



        return $next($request);
    }
}

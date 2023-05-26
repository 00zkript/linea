<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Autenticado
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $tipo
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$tipo)
    {
      if (!auth()->check()){

           if ($tipo == "panel"){
               return redirect()->route('panel.login.index');
           }else{
                return redirect()->route('web.login');
           }

        }

        return $next($request);

    }
}

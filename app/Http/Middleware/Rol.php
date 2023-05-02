<?php

namespace App\Http\Middleware;

use Closure;

class Rol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$rol)
    {
        if (auth()->user()->idrol != $rol){
            abort(403,"LO SENTIMOS, ESTA PAGINA NO ESTA DISPONIBLE");
        }
        return $next($request);
    }
}

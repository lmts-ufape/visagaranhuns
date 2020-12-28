<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsRespTecnico
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
        if ( !auth()->check() )
            return redirect()->route('login');

        if (Auth::user()->tipo == "rt"){
            if (Auth::user()->status_cadastro == "pendente") {
                return redirect()->route('completar.cadastro.rt.criar');
            }
            else {
                return $next($request);
            }
            // return $next($request);
        }
        abort(403);
        // return $next($request);
    }
}

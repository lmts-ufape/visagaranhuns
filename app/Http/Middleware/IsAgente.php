<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAgente
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

        if (Auth::user()->tipo == "agente"){
            if (Auth::user()->status_cadastro == "pendente") {
                return redirect()->route('completar.cadastro.agente');
            }
            else {
                return $next($request);
            }
        }
        abort(403);
    }
}

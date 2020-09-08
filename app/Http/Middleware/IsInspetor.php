<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsInspetor
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

        if (Auth::user()->tipo == "inspetor"){
            if (Auth::user()->status_cadastro == "pendente") {
                return redirect()->route('completar.cadastro.inspetor');
            }
            else {
                return $next($request);
            }
        }
        abort(403);
    }
}

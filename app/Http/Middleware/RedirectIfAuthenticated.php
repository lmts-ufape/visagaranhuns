<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->tipo == "coordenador") {
                return redirect("/home/coordenador");
            }
            elseif (Auth::user()->tipo == "empresa") {
                return redirect("/home/empresa");
            }
            elseif (Auth::user()->tipo == "inspetor") {
                return redirect("/home/inspetor");
            }
            elseif (Auth::user()->tipo == "agente") {
                return redirect("/home/agente");
            }
        }

        return $next($request);
    }
}

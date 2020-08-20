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
            if (Auth::user()->tipo == "coordenador"){
                dd("NeyDay");
                return redirect(RouteServiceProvider::HOME);
            }
            elseif (Auth::user()->tipo == "empresa") {
                return redirect('empresa.menu');
            }
            elseif (Auth::user()->tipo == "agente") {
                // return redirect('agente.menu');
            }
            elseif (Auth::user()->tipo == "resptecnico") {
                // return redirect('resptecnico.menu');
            }
            elseif (Auth::user()->tipo == "fiscal") {
                dd("AdultoNey");
                return redirect('fiscal.menu');
            }
        }

        return $next($request);
    }
}

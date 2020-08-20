<?php
namespace App\Http\Controllers\Auth\Traits;
use Illuminate\Support\Facades\Auth;
 
trait RedirectsUsersTrait
{
    public function redirectTo()
    {
        if (Auth::user()->tipo == "coordenador"){
            return 'coordenador.menu';
        }
        if (Auth::user()->tipo == "fiscal"){
            return 'fiscal.area';
        }
        
    }
}
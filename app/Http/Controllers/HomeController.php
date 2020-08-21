<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Essa funcao redireciona o usuario para a sua tela principal de acordo com o tipo de usuario
     *
     * @return view
     */
    public function index()
    {

        if(auth()->user()->tipo == "coordenador"){
            return view('coordenador/home_coordenador');

        }elseif(auth()->user()->tipo == "empresa"){
            return view('empresa/home_empresa');

        }elseif(auth()->user()->tipo == "administrador"){
            return view('admin/home_admin');

        }elseif(auth()->user()->tipo == "inspetor"){
            return view('inspetor/home_inspetor');
        }
    }
}

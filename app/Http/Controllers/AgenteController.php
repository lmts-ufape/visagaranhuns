<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\User;
use Illuminate\Support\Facades\Auth;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarAgentes()
    {
        // Definir pagina para listagem
        $agentes = Agente::all();
        return view('/', [ 'agentes'  => $agentes ]);
    }

    public function home()
    {
        return view('agente.home_agente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Definir tela para cadastro de agente
        return view('agente.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $validator = $request->validate([
            'nome'     => 'required|string',
            'formacao' => 'required|string',
            'password'       => 'required',
        ]);

        // Atualiza dados de user para agente
        $user->name = $request->nome;
        $user->password = bcrypt($request->password);
        $user->save();

        $agente = Agente::create([
            'formacao'       => $request->formacao,
            'user_id'        => $user->id,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\User;
use Auth;

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
        $agentes = User::where("tipo", "agente")->where("status_cadastro", "aprovado")->get();
        return view('coordenador/agentes_coordenador', [ 'agentes'  => $agentes ]);
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
        $user = User::find(Auth::user()->id);
        // Tela de conclusão de cadastro de agente
        return view('agente.cadastrar_agente')->with(["user"=>$user->email]);
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
            'especializacao' => 'nullable|string',
            'cpf'            => 'required|string',
            'telefone'       => 'required|string',
            'password'       => 'required',
        ]);

        // Atualiza dados de user para agente
        $user->name = $request->nome;
        $user->password = bcrypt($request->password);
        $user->status_cadastro = "aprovado";
        $user->save();

        $agente = Agente::create([
            'formacao'       => $request->formacao,
            'especializacao' => $request->especializacao,
            'cpf'            => $request->cpf,
            'telefone'       => $request->telefone,
            'user_id'        => $user->id,
        ]);

        return redirect()->route('/');
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

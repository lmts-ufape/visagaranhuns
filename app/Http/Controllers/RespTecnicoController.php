<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RespTecnico;
use App\User;
use App\Empresa;
use Auth;

class RespTecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // Tela de conclusão de cadastro de Responsavel Técnico
        return view('responsavel_tec.cadastrar_responsavel_tec')->with(["user" => $user, "empresaId" => $request->empresaId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            'nome'     => 'required|string',
            'email'    => 'required|email',
            'formacao' => 'required|string',
            'especializacao' => 'nullable|string',
            'cpf'            => 'required|string',
            'telefone'       => 'required|string',
            'password'       => 'required',
        ]);

        $user = User::create([
            'name'            => $request->nome,
            'email'           => $request->email,
            'password'        => bcrypt($request->password),
            'tipo'            => "rt",
            'status_cadastro' => "pendente",
        ]);

        $respTec = RespTecnico::create([
            'formacao'       => $request->formacao,
            'especializacao' => $request->especializacao,
            'cpf'            => $request->cpf,
            'telefone'       => $request->telefone,
            'user_id'        => $user->id,
            'empresa_id'     => $request->empresaId,
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

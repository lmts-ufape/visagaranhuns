<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\User;
use App\Telefone;
use App\Endereco;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = \App\Empresa::all();
        return view('home', [ 'empresas'  => $empresas ]);
    }

    public function home()
    {
        return view('empresa.home_empresa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cadastro temporário de empresa
        $validator = $request->validate([
            'name'     => 'required|string',
            'cnpjcpf'  => 'required|string',
            'tipo'     => 'required|string',
            'email'    => 'required|email',
            'password' => 'required',
            'numeroTelefone'   => 'required|string',
            'rua'      => 'required|string',
            'numero'   => 'required|string',
            'bairro'   => 'required|string',
            'cidade'   => 'required|string',
            'uf'       => 'required|string',
            'cep'      => 'required|string',
            'complemento' => 'required|string',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo' => "empresa",
        ]);

        $empresa = Empresa::create([
            'cnpjcpf' => $request->cnpjcpf,
            'status_inspecao' => "pendente",
            'status_cadastro' => "pendente",
            'tipo' => $request->tipo,
            'user_id' => $user->id,
        ]);

        $telefone = Telefone::create([
            'numero' => $request->numeroTelefone,
            'empresa_id' => $empresa->id,
        ]);
        
        $endereco = Endereco::create([
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'empresa_id' => $empresa->id,
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

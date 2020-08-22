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
            'complemento'      => 'required|string',
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

        // Área para cadastro de cnaes

        
        


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
    public function atualizarDocumentosEmpresa(Request $request, $id)
    {
        $empresa = Empresa::find($id)->get();
        $docempresa = Docempresa::where("empresa_id", $empresa->id)->first();

        /*
        Obs:
         - Rg sem data de validade
         - Rg de sócio sem data de validade
         - Cpf sem data de validade
         - Cpf de sócio sem data de validade
        */
        $validator = $request->validate([
            'req_preenchido'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cnpj'            => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'contrato_social' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'registro_firma'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'certificado_mei' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'rg'              => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cpf'             => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'regula_bombeiro' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'licenca_anterior'=> ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cert_deteti'     => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'iptu_quitado'    => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'licenca_adagro'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'licenca_ambiental'=> ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'laudo_microbriolo'=> ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'taxa_vigilancia' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'taxa_servico'    => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'pgrss'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cness'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'projeto_arquitetonico' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'certificado_curso_higiene' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'afe/ae'          => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'rgsocio'         => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cpfsocio'        => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'declaracao_carropipa'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'crlv'            => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'declaracao_fonte'=> ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'registro_antt'   => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'cnh'             => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'declaracao_revest'=> ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
            'data_req_preenchido'     => ['nullable', 'date'],
            'data_cnpj'               => ['nullable', 'date'],
            'data_contrato_social'    => ['nullable', 'date'],
            'data_registro_firma'     => ['nullable', 'date'],
            'data_certificado_mei'    => ['nullable', 'date'],
            'data_regula_bombeiro'    => ['nullable', 'date'],
            'data_licenca_anterior'   => ['nullable', 'date'],
            'data_cert_deteti'        => ['nullable', 'date'],
            'data_iptu_quitado'       => ['nullable', 'date'],
            'data_licenca_adagro'     => ['nullable', 'date'],
            'data_licenca_ambiental'  => ['nullable', 'date'],
            'data_laudo_microbriolo'  => ['nullable', 'date'],
            'data_taxa_vigilancia'    => ['nullable', 'date'],
            'data_taxa_servico'       => ['nullable', 'date'],
            'data_pgrss'              => ['nullable', 'date'],
            'data_cness'              => ['nullable', 'date'],
            'data_projeto_arquitetonico'      => ['nullable', 'date'],
            'data_certificado_curso_higiene'  => ['nullable', 'date'],
            'data_afe/ae'                     => ['nullable', 'date'],
            'data_declaracao_carropipa'       => ['nullable', 'date'],
            'data_crlv'                       => ['nullable', 'date'],
            'data_declaracao_fonte'           => ['nullable', 'date'],
            'data_cnh'                        => ['nullable', 'date'],
            'data_declaracao_revest'          => ['nullable', 'date'],
        ]);

        if(isset($request->req_preenchido)){
            $fileDocemp = $request->req_preenchido;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->req_preenchido->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docempresa->nome = $pathDocemp . $nomeDocemp;
            $docempresa->data_emissao = $request->data_req_preenchido; 
        }

        if(isset($request->cnpj)){
            $fileDocemp = $request->cnpj;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cnpj->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docempresa->nome = $pathDocemp . $nomeDocemp;
            $docempresa->data_emissao = $request->data_cnpj; 
        }

        
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

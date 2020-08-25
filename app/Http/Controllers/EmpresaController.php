<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\User;
use App\Telefone;
use App\Endereco;
use App\Docempresa;
use App\Cnae;
use App\CnaeEmpresa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Escolher a página qem que as empresas serão listadas
        $cnaeEmp = CnaeEmpresa::where("cnae_id", Crypt::decrypt($request->value))->get();
        $empresas = array();
        foreach($cnaeEmp as $indice){
            $empresa = Empresa::find($indice->empresa_id);
            array_push($empresas, $empresa);
        }
        return view('coordenador/empresas_coordenador', ['empresas' => $empresas]);
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
        // Sujeito a mudanças
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

        // Cadastro de telefones
        $telefone = Telefone::create([
            'numero' => $request->numeroTelefone,
            'empresa_id' => $empresa->id,
        ]);

        // Cadastro de endereços
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
        $cnae = $request['cnae'];

        for($i = 0; $i < count($cnae); $i++) {
            $cnaeEmpresa[] = CnaeEmpresa::create([
                'empresa_id' => $empresa->id,
                'cnae_id' => $cnae[$i]->id,
            ]);
        }

        return redirect()->route('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = Crypt::decrypt($request->value);
        $empresa = Empresa::find($id);
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        return view('coordenador/show_empresa_coordenador', ['empresa' => $empresa, 'endereco' => $endereco, 'telefone' =>$telefone]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarEmpresa($id)
    {
        $empresa = Empresa::where('user_id', $id)->first();
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();


    }

    public function edit()
    {
        // Definir a página para a edição de empresa
        return view('empresa.edit_empresa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anexarArquivos(Request $request)
    {
        $empresa = Empresa::where("user_id", $request->user_id)->first();

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
            'afeae'          => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2000000'],
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
            'data_afeae'                     => ['nullable', 'date'],
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

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_req_preenchido,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "1",
            ]);
        }

        if(isset($request->cnpj)){
            $fileDocemp = $request->cnpj;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cnpj->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_cnpj,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "2",
            ]);
        }

        if(isset($request->contrato_social)){
            $fileDocemp = $request->contrato_social;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->contrato_social->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_contrato_social,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "3",
            ]);
        }

        if(isset($request->registro_firma)){
            $fileDocemp = $request->registro_firma;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->registro_firma->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_registro_firma,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "4",
            ]);
        }

        if(isset($request->certificado_mei)){
            $fileDocemp = $request->certificado_mei;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->certificado_mei->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_certificado_mei,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "5",
            ]);
        }

        if(isset($request->rg)){
            // Rg sem data de emissão
            $fileDocemp = $request->rg;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->rg->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "6",
            ]);
        }

        if(isset($request->cpf)){
            // Rg sem data de emissão
            $fileDocemp = $request->cpf;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cpf->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "7",
            ]);
        }

        if(isset($request->regula_bombeiro)){
            $fileDocemp = $request->regula_bombeiro;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->regula_bombeiro->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_regula_bombeiro,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "8",
            ]);
        }

        if(isset($request->licenca_anterior)){
            $fileDocemp = $request->licenca_anterior;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->licenca_anterior->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_licenca_anterior,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "9",
            ]);
        }

        if(isset($request->cert_deteti)){
            $fileDocemp = $request->cert_deteti;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cert_deteti->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_cert_deteti,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "10",
            ]);
        }

        if(isset($request->iptu_quitado)){
            $fileDocemp = $request->iptu_quitado;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->iptu_quitado->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_iptu_quitado,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "11",
            ]);
        }

        if(isset($request->licenca_adagro)){
            $fileDocemp = $request->licenca_adagro;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->licenca_adagro->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_licenca_adagro,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "12",
            ]);
        }

        if(isset($request->licenca_ambiental)){
            $fileDocemp = $request->licenca_ambiental;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->licenca_ambiental->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_licenca_ambiental,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "13",
            ]);
        }

        if(isset($request->laudo_microbriolo)){
            $fileDocemp = $request->laudo_microbriolo;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->laudo_microbriolo->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_laudo_microbriolo,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "14",
            ]);
        }

        if(isset($request->taxa_vigilancia)){
            $fileDocemp = $request->taxa_vigilancia;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->taxa_vigilancia->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_taxa_vigilancia,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "15",
            ]);
        }

        if(isset($request->taxa_servico)){
            $fileDocemp = $request->taxa_servico;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->taxa_servico->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_taxa_servico,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "16",
            ]);
        }

        if(isset($request->pgrss)){
            $fileDocemp = $request->pgrss;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->pgrss->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_pgrss,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "17",
            ]);
        }

        if(isset($request->cness)){
            $fileDocemp = $request->cness;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cness->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_cness,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "18",
            ]);
        }

        if(isset($request->projeto_arquitetonico)){
            $fileDocemp = $request->projeto_arquitetonico;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->projeto_arquitetonico->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_projeto_arquitetonico,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "19",
            ]);
        }

        if(isset($request->certificado_curso_higiene)){
            $fileDocemp = $request->certificado_curso_higiene;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->certificado_curso_higiene->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_certificado_curso_higiene,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "20",
            ]);
        }

        if(isset($request->afeae)){
            $fileDocemp = $request->afeae;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->afeae->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_afeae,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "21",
            ]);
        }

        if(isset($request->rgsocio)){
            $fileDocemp = $request->rgsocio;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->rgsocio->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "22",
            ]);
        }

        if(isset($request->cpfsocio)){
            $fileDocemp = $request->cpfsocio;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cpfsocio->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "23",
            ]);
        }

        if(isset($request->declaracao_carropipa)){
            $fileDocemp = $request->declaracao_carropipa;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->declaracao_carropipa->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_declaracao_carropipa,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "24",
            ]);
        }

        if(isset($request->crlv)){
            $fileDocemp = $request->crlv;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->crlv->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_crlv,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "25",
            ]);
        }

        if(isset($request->declaracao_fonte)){
            $fileDocemp = $request->declaracao_fonte;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->declaracao_fonte->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_declaracao_fonte,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "26",
            ]);
        }

        if(isset($request->registro_antt)){
            $fileDocemp = $request->registro_antt;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->registro_antt->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_registro_antt,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "27",
            ]);
        }

        if(isset($request->cnh)){
            $fileDocemp = $request->cnh;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->cnh->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_cnh,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "28",
            ]);
        }

        if(isset($request->declaracao_revest)){
            $fileDocemp = $request->declaracao_revest;
            $pathDocemp = 'empresa/' . $empresa->id . '/';
            $nomeDocemp = $request->declaracao_revest->getClientOriginalName();

            Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

            $docEmpresa = Docempresa::create([
                'nome'  => $pathDocemp . $nomeDocemp,
                'data_emissao' => $request->data_declaracao_revest,
                'empresa_id'  => $empresa->id,
                'tipodocemp_id' => "29",
            ]);
        }

        return view('empresa.home_empresa');

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

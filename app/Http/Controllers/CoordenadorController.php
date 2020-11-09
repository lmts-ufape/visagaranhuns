<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordenador;
use App\User;
use App\Agente;
use App\Inspetor;
use App\Empresa;
use App\Docempresa;
use App\Checklistemp;
use App\Endereco;
use App\Telefone;
use App\CnaeEmpresa;
use App\Requerimento;
use App\Inspecao;
use App\InspecAgente;
use App\InspecRequerimento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Illuminate\Support\Facades\Validator;
use App\Denuncia;

class CoordenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function home()
    {
        return view('coordenador.home_coordenador');
    }

    public function nameMethod()
    {
        $date = date('Y-m-d');

        $inspecoes = Inspecao::where('status', 'pendente')->where('data', $date)->get();
        // dd($inspecoes);
        // $inspecoes = Inspecao::where('status', 'pendente')->get();
        $inspecao = [];
        $empNome = [];
        $emps = [];

        foreach ($inspecoes as $key) {
            $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
            $requerimento  = Requerimento::where('id', $key->requerimentos_id)->first();

            $obj = (object) array(
                'data'          => $key->data,
                'status'        => $key->status,
                'inspetor'      => $key->inspetor->user->name,
                'agente1'       => $inspec_agente[0]->agente->user->name,
                'agente2'       => $inspec_agente[1]->agente->user->name,
                'empresa'       => $requerimento->empresa->nome,
                'cnae'          => $requerimento->cnae->descricao,                
            );
            array_push($inspecao, $obj);
        }

        foreach ($inspecao as $indice) {
            array_push($empNome, $indice->empresa);
        }

        $empresas = array_unique($empNome);

        foreach ($empresas as $indice) {
            $emp = Empresa::where('nome', $indice)->first();
            $endereco = Endereco::where('empresa_id', $emp->id)->first();
            $telefone = Telefone::where('empresa_id', $emp->id)->first();

            $obj = (object) array(
                'nome'       => $emp->nome,
                'email'      => $emp->nome,
                'cnpjcpf'    => $emp->nome,
                'tipo'       => $emp->nome,
                'cep'        => $endereco->cep,
                'rua'        => $endereco->rua,
                'numero'     => $endereco->numero,
                'bairro'     => $endereco->bairro,
                'complemento'=> $endereco->complemento,
                'telefone1'  => $telefone->telefone1,
                'telefone2'  => $telefone->telefone2,                
            );

            array_push($emps, $obj);
        }
        
        $pdf = PDF::loadView('coordenador/inspecoes', compact('inspecao', 'emps'));
        return $pdf->setPaper('a4')->stream('inspecoes.pdf');
    }

    public function criarInspecao()
    {
        $inspetores = Inspetor::all();
        $agentes = Agente::all();
        $requerimentos = Requerimento::where('status', 'aprovado')->get();

        return view('coordenador/criar_inspecao',[
            "inspetores"    => $inspetores,
            "agentes"       => $agentes,
            "requerimentos" => $requerimentos,
        ]);
    }

    public function encontrarRequerimento(Request $request)
    {
        $requerimento = Requerimento::find($request->requerimentoId);

        $data = array(
            'tipo' => $requerimento->tipo,
            'cnae' => $requerimento->cnae->descricao,
        );
        echo json_encode($data);

    }

    public function paginaDenuncias()
    {
        

        return view('coordenador/denuncias');
    }

    public function cadastrarInspecao(Request $request)
    {
        // dd($request);
        foreach ($request->requerimentos as $indice) {
            $inspecao = Inspecao::create([
                'data'            => $request->data,
                'status'          => 'pendente',
                'inspetor_id'     => $request->inspetor,
                'requerimento_id' => $indice,
            ]);

            $temp1 = InspecAgente::create([
                'inspecoes_id'  => $inspecao->id,
                'agente_id'     => $request->agente1,
            ]);
    
            $temp2 = InspecAgente::create([
                'inspecoes_id'  => $inspecao->id,
                'agente_id'     => $request->agente2,
            ]);
        }


        session()->flash('success', 'A inspeção foi cadastrada com sucesso e agora consta para a visualização dos agentes e inspetores.');
        return back();

    }

    public function historico()
    {
        $inspecoes = Inspecao::all();
        $temp = [];

        foreach ($inspecoes as $key) {
            $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
            $requerimento  = Requerimento::where('id', $key->requerimento_id)->first();

            $obj = (object) array(
                'data'          => $key->data,
                'status'        => $key->status,
                'inspetor'      => $key->inspetor->user->name,
                'agente'        => $inspec_agente[0]->agente->user->name,
                'agente'        => $inspec_agente[1]->agente->user->name,
                'empresa'       => $requerimento->empresa->nome,
                'cnae'          => $requerimento->cnae->descricao,                
            );
            array_push($temp, $obj);
            
        }

        return view('coordenador.historico_inspecao')->with([
            "inspecoes" => $temp,
        ]);

    }

    public function requerimentosAprovados()
    {
        $resultado = Requerimento::where('status', 'aprovado')->get();
        // $resultado = Requerimento::find(1)->get();
        // return view('coordenador/cnaes_coordenador');
        $output = '';
            if($resultado->count() > 0){
                foreach($resultado as $item){
                    $output .= '
                    <div class="d-flex justify-content-center cardMeuCnae" onmouseenter="mostrarBotaoAdicionar('.$item->id.')">
                        <div class="mr-auto p-2>OPA</div>
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo" id="'.$item->id.'">'.$item->empresa->nome.'</div>
                                        <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                        <div>Cnae: <span class="textoCampo">'.$item->cnae->descricao.'</span></div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:140px; height:25px; text-align:right;">
                                <div id="cardSelecionado'.$item->id.'" class="btn-group" style="display:none;">
                                    <div class="btn btn-success btn-sm"  onclick="addRequerimento('.$item->id.')" >Adicionar</div>
                                </div>
                            </div>

                    </div>

                    ';
                }
            }elseif($idArea == ""){
                $output .= '
                        <label></label>
                    ';
            }else{
                $output .= '
                        <label>vazio</label>
                    ';
            }
            $data = array(
                'success'   => true,
                'table_data' => $output,
            );
            echo json_encode($data);
    }

    /* Função para listar em tela todas empresas que se cadastraram
    e que o acesso não foi liberado.
    */
    public function listarPendente()
    {
        $empresas = Empresa::where("status_cadastro","pendente")->get();
        return view('coordenador.cadastro_pendente', ["empresa" => $empresas]);
    }

    public function downloadArquivo(Request $request)
    {
        return response()->download(storage_path('app/' . $request->file));
    }

    /* Função para selecionar e exibir na página a empresa que será
    Avaliada
    */
    public function paginaDetalhes(Request $request)
    {
        $empresa = Empresa::find($request->empresa);
        $user = User::where('id', $empresa->user_id)->first();

        // $empresa = Empresa::find("1");
        // $user = User::where('id', "2")->first();
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        $cnaeEmpresa = CnaeEmpresa::where('empresa_id', $empresa->id)->get();

        return view("coordenador/avaliar_cadastro")->with([
            "empresa" => $empresa,
            "user"    => $user,
            "endereco" => $endereco,
            "telefone" => $telefone,
            "cnae" => $cnaeEmpresa,
        ]);
    }

    public function paginaDetalhesDenuncia(Request $request)
    {
        $empresa = Empresa::find($request->empresa);
        $denuncias = Denuncia::where('empresa_id', $request->empresa)->get();

        return view("coordenador/avaliar_denuncias")->with([
            "empresa" => $empresa,
            "denuncias" => $denuncias,
        ]);
    }

    public function avaliarDenuncia(Request $request)
    {
        // dd($request->decisao);
        if ($request->decisao == "true") {

            $denuncia = Denuncia::find($request->denunciaId);
            $denuncia->status = "Acatado";
            $denuncia->save();

            session()->flash('success', 'Denúncia acatada com sucesso!');
            return redirect()->route('pagina.denuncia.coordenador');

        } elseif ($request->decisao == "false") {

            $denuncia = Denuncia::find($request->denunciaId);
            $denuncia->status = "Arquivado";
            $denuncia->save();

            session()->flash('success', 'Denúncia arquivada com sucesso!');
            return redirect()->route('pagina.denuncia.coordenador');
        }
        
    }

    public function licenca(Request $request)
    {
        $empresa = Empresa::find($request->empresa);

        $docsempresa = Docempresa::where('empresa_id', $empresa->id)->get();
        $checklist = Checklistemp::where('empresa_id', $empresa->id)
        ->where('areas_id', $request->area)
        ->orderBy('nomeDoc','ASC')
        ->get();


        return view("coordenador/avaliar_requerimento")->with([
            "docsempresa"  => $docsempresa,
            "checklist"    => $checklist,
            "empresa"      => $empresa,
            "requerimento" => $request->requerimento,
        ]);
    }

    public function julgarRequerimento(Request $request)
    {
 
        if ($request->decisao == "true") {
            
            $requerimento = Requerimento::find($request->requerimento);
            $requerimento->status = "aprovado";
            $requerimento->save();

            $inspetores = Inspetor::get();
            $agentes = Agente::get();
            return view('coordenador/requerimento_coordenador',["inspetores" => $inspetores,"agentes" => $agentes])->with('aprovado', 'O requerimento foi aprovado!');

        } else {

            // Verifica se o campos avisos foi passado ou não!
            if($request->avisos == null){
                session()->flash('error', 'Você deve informar o motivo da reprovação no campo Avisos!');
                return redirect()->route('pagina.requerimento');
            }

            $requerimento = Requerimento::find($request->requerimento);
            $requerimento->status = "reprovado";
            $requerimento->aviso = $request->avisos;
            $requerimento->save();

            $inspetores = Inspetor::get();
            $agentes = Agente::get();
            return view('coordenador/requerimento_coordenador',["inspetores" => $inspetores,"agentes" => $agentes])->with('reprovado', 'O requerimento foi reprovado!');

        }
        
    }

    public function julgar(Request $request)
    {
        // Encontrar email do perfil da empresa
        //*******************************************************
        $useremail = User::find($request->user_id);
        // ******************************************************
        $empresa = Empresa::find($request->empresa_id);

        if($useremail->status_cadastro == "pendente" && $empresa->status_cadastro == "pendente"){

            if($request->decisao == 'true'){

                // Enviar e-mai de comprovação de cadastro de usuário e empresa
                //************************************** */
                $user = new \stdClass();
                $user->name = $useremail->name;
                $user->email = $useremail->email;
                $emp = new \stdClass();
                $emp->nome = $empresa->nome;
                $decisao = new \stdClass();
                $decisao = $request->decisao;

                \Illuminate\Support\Facades\Mail::send(new \App\Mail\ConfirmaCadastroUser($user,$emp,$decisao));
                // *************************************

                $empresa->status_cadastro = "aprovado";
                $useremail->status_cadastro = "aprovado";
                $empresa->save();
                $useremail->save();

                session()->flash('success', 'Cadastros aprovados com sucesso');
                return redirect()->route('/');
            }
            else{

                // Enviar e-mai de reprovação de cadastro de usuário e empresa
                //************************************** */
                $user = new \stdClass();
                $user->name = $useremail->name;
                $user->email = $useremail->email;
                $emp = new \stdClass();
                $emp->nome = $empresa->nome;
                $decisao = new \stdClass();
                $decisao = $request->decisao;

                \Illuminate\Support\Facades\Mail::send(new \App\Mail\ConfirmaCadastroUser($user,$emp,$decisao));
                // *************************************

                $empresa->status_cadastro = "reprovado";
                $useremail->status_cadastro = "reprovado";
                $empresa->save();
                $useremail->save();

              session()->flash('success', 'Cadastros reprovados com sucesso');
              return redirect()->route('/');
            }

        }
        elseif($useremail->status_cadastro == "aprovado" && $empresa->status_cadastro == "pendente"){

            if($request->decisao == 'true'){

                // Enviar e-mai de comprovação de cadastro
                //************************************** */

                $user = new \stdClass();
                $user->name = $useremail->name;
                $user->email = $useremail->email;
                $emp = new \stdClass();
                $emp->nome = $empresa->nome;
                $decisao = new \stdClass();
                $decisao = $request->decisao;

                \Illuminate\Support\Facades\Mail::send(new \App\Mail\ConfirmaCadastroEmpresa($user,$empresa,$decisao));
                // *************************************

                $empresa->status_cadastro = "aprovado";
                $empresa->save();

                session()->flash('success', 'Cadastro aprovado com sucesso');
                return redirect()->route('/');
            }
            else{

                // Enviar e-mai de comprovação de cadastro
                //************************************** */

                $user = new \stdClass();
                $user->name = $useremail->name;
                $user->email = $useremail->email;
                $emp = new \stdClass();
                $emp->nome = $empresa->nome;
                $decisao = new \stdClass();
                $decisao = $request->decisao;

                \Illuminate\Support\Facades\Mail::send(new \App\Mail\ConfirmaCadastroEmpresa($user,$empresa,$decisao));
                // *************************************
                $empresa->status_cadastro = "reprovado";
                $empresa->save();

                session()->flash('success', 'Cadastro reprovado com sucesso');
                return redirect()->route('/');
            }

        }

        // Trecho para o caso de coordenador precisar reavaliar cadastro de empresa
        // elseif ($estabelecimento->status == "Aprovado" || $estabelecimento->status == "Reprovado") {

        //     if($request->decisao == 'true'){

        //         // Enviar e-mai de comprovação de cadastro
        //         //************************************** */

        //         $user = new \stdClass();
        //         $user->name = $userfound[0]->name;
        //         $user->email = $userfound[0]->email;

        //         \Illuminate\Support\Facades\Mail::send(new \App\Mail\SendMailUser($user));
        //         // *************************************

        //         $estabelecimento->status = "Aprovado";
        //         $estabelecimento->save();

        //         session()->flash('success', 'Estabelecimento aprovado com sucesso');
        //         return redirect()->route('estabelecimentoAdmin.revisar');
        //     }
        //     else{
        //       $estabelecimento->status = "Reprovado";
        //       $estabelecimento->save();

        //       session()->flash('success', 'Estabelecimento reprovado com sucesso');
        //       return redirect()->route('estabelecimentoAdmin.revisar');
        //     }
        // }
    }

    public function convidarEmail(Request $request)
    {
        $validationData = $this->validate($request,[
            'email'=>'required|email',
        ]);

        if ($request->tipo == "inspetor") {

            $user = User::where('email',$request->input('email'))->first();
            $empresa = Empresa::where('id', $request->empresa)->first();

            if($user == null){

              $passwordTemporario = Str::random(8);
              Mail::to($request->email)->send(new \App\Mail\CadastroUsuarioPorEmail($passwordTemporario, $request->tipo));
              $user = User::create([
                'name'            => "Inspetor",
                'email'           => $request->email,
                'password'        => bcrypt($passwordTemporario),
                'tipo'            => "inspetor",
                'status_cadastro' => "pendente",
              ]);
              session()->flash('success', 'Um e-mail com o convite foi enviado para o endereço especificado.');
              return back();
            }
            else {
                session()->flash('error', 'O e-mail já está cadastrado no sistema!');
                return back();
            }
        }

        elseif ($request->tipo == "agente") {

            $user = User::where('email',$request->input('email'))->first();
            $empresa = Empresa::where('id', $request->empresa)->first();

            if($user == null){

              $passwordTemporario = Str::random(8);
              Mail::to($request->email)->send(new \App\Mail\CadastroUsuarioPorEmail($passwordTemporario, $request->tipo));
              $user = User::create([
                'name'            => "Agente",
                'email'           => $request->email,
                'password'        => bcrypt($passwordTemporario),
                'tipo'            => "agente",
                'status_cadastro' => "pendente",
              ]);
              session()->flash('success', 'Um e-mail com o convite foi enviado para o endereço especificado.');
              return back();
            }
            else {
                session()->flash('error', 'O e-mail já está cadastrado no sistema!');
                return back();
            }
        }
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo' => "supervisor",
        ]);

        $supervisor = Supervisor::create([
            'userId' => $user->id,
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

    /**
     * Funcao: abre a tela de requerimento
     * Tela: requerimento_coordenador.blade.php
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function listarRequerimentoInspetorEAgente()
    {
        $inspetores = Inspetor::get();
        $agentes = Agente::get();
        return view('coordenador/requerimento_coordenador',["inspetores" => $inspetores,"agentes" => $agentes]);
    }
    /**
     * Funcao: listar todos os requerimentos
     * Tela: requerimento_coordenador.blade.php
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function ajaxListarRequerimento(Request $request)
    {
        $this->listarRequerimentos($request->filtro);
    }
    public function listarRequerimentos($filtro){
        $requerimentos = Requerimento::orderBy('created_at', 'ASC')->get();
        // $requerimentos = Requerimento::where('id', 1)->get();
        // $requerimentos = Requerimento::find(1);
        $empresas = Empresa::orderBy('created_at', 'ASC')->get();
        $output = '';
        // avaliar cadastro da empresa
        foreach($empresas as $item){
            if($item->status_cadastro == "pendente" && ($filtro == "pendente" || $filtro == "all")){
                $output .='
                    <div class="container cardListagem" id="primeiralicenca">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                            <div class="btn-group" style="margin-bottom:-15px;">
                                <div class="form-group" style="font-size:15px;">
                                    <div class="textoCampo">'.$item->nome.'</div>
                                    <span>Cadastro pendente</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="form-group" style="font-size:15px;">
                                <div>'.$item->created_at->format('d/m/Y').'</div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="dropdown">
                                <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                        <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="form-group" style="font-size:15px;">
                                    <div>CNPJ: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                    <div>Proprietário: <span class="textoCampo">'.$item->user->name.'</span></div>
                                    <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="empresaId('.$item->id.')" class="btn btn-success">Avaliar</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';

            }
        }
        // 1º licenca, renovação
        foreach($requerimentos as $item){
                if($item->tipo == "Primeira Licenca" && ($item->resptecnicos_id != null) && ($filtro == "primeira_licenca" || $filtro == "all") && ($item->status == "pendente")){
                    $output .='
                        <div class="container cardListagem" id="primeiralicenca">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <div class="btn-group" style="margin-bottom:-15px;">
                                        <div class="form-group" style="font-size:15px;">
                                            <div class="textoCampo">'.$item->empresa->nome.'</div>
                                            <span>Primeira Licença</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="form-group" style="font-size:15px;">
                                        <div>'.$item->created_at->format('d/m/Y').'</div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="dropdown">
                                    <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                                <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <div class="btn-group" style="margin-bottom:-15px;">
                                            <div class="form-group" style="font-size:15px;">
                                                <div>CNAE: <span class="textoCampo">'.$item->cnae->descricao.'</span></div>
                                                <div>Responsável Técnico:<span class="textoCampo"> '.$item->resptecnico->user->name.'</span></div>
                                                <div>Status:<span class="textoCampo"> '.$item->status.'</span></div>
                                                <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="licencaAvaliacao('.$item->empresa->id.','.$item->cnae->areas_id.','.$item->id.')" class="btn btn-success">Avaliar</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';

                }elseif($item->tipo == "Primeira Licenca" && ($item->resptecnicos_id == null) && ($filtro == "primeira_licenca" || $filtro == "all") && ($item->status == "pendente")){
                    $output .='
                        <div class="container cardListagem" id="primeiralicenca">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <div class="btn-group" style="margin-bottom:-15px;">
                                        <div class="form-group" style="font-size:15px;">
                                            <div class="textoCampo">'.$item->empresa->nome.'</div>
                                            <span>Primeira Licença</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="form-group" style="font-size:15px;">
                                        <div>'.$item->created_at->format('d/m/Y').'</div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="dropdown">
                                    <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                                <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <div class="btn-group" style="margin-bottom:-15px;">
                                            <div class="form-group" style="font-size:15px;">
                                                <div>CNAE: <span class="textoCampo">'.$item->cnae->descricao.'</span></div>
                                                <div>Representante Legal:<span class="textoCampo"> '.$item->empresa->user->name.'</span></div>
                                                <div>Status:<span class="textoCampo"> '.$item->status.'</span></div>
                                                <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="licencaAvaliacao('.$item->empresa->id.','.$item->cnae->areas_id.','.$item->id.')" class="btn btn-success">Avaliar</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';

                }elseif($item->tipo == "Renovacao"  && ($item->resptecnicos_id != null) && ($filtro == "renovacao_de_licenca" || $filtro == "all") && ($item->status == "pendente")){
                    $output .='
                    <div class="container cardListagem">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo">'.$item->empresa->nome.'</div>
                                        <span>Renovacao de Licenca</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="form-group" style="font-size:15px;">
                                    <div>'.$item->created_at->format('d/m/Y').'</div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="dropdown">
                                    <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                            <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <div class="btn-group" style="margin-bottom:-15px;">
                                        <div class="form-group" style="font-size:15px;">
                                            <div>CNAE: <span class="textoCampo">'.$item->cnae->descricao.'</span></div>
                                            <div>Responsável Técnico:<span class="textoCampo"> '.$item->resptecnico->user->name.'</span></div>
                                            <div>Status:<span class="textoCampo"> '.$item->status.'</span></div>
                                            <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="licencaAvaliacao('.$item->empresa->id.','.$item->cnae->areas_id.','.$item->id.')" class="btn btn-success">Avaliar</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                }elseif($item->tipo == "Renovacao"  && ($item->resptecnicos_id == null) && ($filtro == "renovacao_de_licenca" || $filtro == "all") && ($item->status == "pendente")){
                    $output .='
                    <div class="container cardListagem">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo">'.$item->empresa->nome.'</div>
                                        <span>Renovacao de Licenca</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="form-group" style="font-size:15px;">
                                    <div>'.$item->created_at->format('d/m/Y').'</div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="dropdown">
                                    <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                            <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <div class="btn-group" style="margin-bottom:-15px;">
                                        <div class="form-group" style="font-size:15px;">
                                            <div>CNAE: <span class="textoCampo">'.$item->cnae->descricao.'</span></div>
                                            <div>Representante Legal:<span class="textoCampo"> '.$item->empresa->user->name.'</span></div>
                                            <div>Status:<span class="textoCampo"> '.$item->status.'</span></div>
                                            <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="licencaAvaliacao('.$item->empresa->id.','.$item->cnae->areas_id.','.$item->id.')" class="btn btn-success">Avaliar</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                }
        }




        $data = array(
            'success'   => true,
            'table_data' => $output,
        );
        echo json_encode($data);
    }

    public function ajaxListarDenuncia(Request $request)
    {
        $this->listarDenuncias($request->filtro);
    }
    public function listarDenuncias($filtro){
        
        $denuncias = Denuncia::all();
        $temp = [];
        $empresas = [];

        foreach ($denuncias as $indice) {

            if (count($temp) == 0) {
                $obj = (object) array(
                    'nome'  => $indice->empresa->nome,
                    'id'    => $indice->empresa->id,
                );
                array_push($temp, $obj);   
            }
            else {
                $found = false;
                foreach ($temp as $indice2) {
                    if ($indice->empresa->nome == $indice2->nome) {
                        $found = true;
                        break;
                    }
                }
                if ($found == false) {
                    $obj = (object) array(
                        'nome'  => $indice->empresa->nome,
                        'id'    => $indice->empresa->id,
                    );
                    array_push($temp, $obj);
                }
            }
        }

        foreach ($temp as $key) {
            $empresa = Empresa::find($key->id);
            array_push($empresas,$empresa);
        }
        $output = '';

        // avaliar cadastro da empresa
        foreach($empresas as $item){
            $output .='
                    <div class="container cardListagem" id="primeiralicenca">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                            <div class="btn-group" style="margin-bottom:-15px;">
                                <div class="form-group" style="font-size:15px;">
                                    <div class="textoCampo">'.$item->nome.'</div>
                                    <span>Denúncias</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="form-group" style="font-size:15px;">
                                <div>'.$item->created_at->format('d/m/Y').'</div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="dropdown">
                                <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton'.$item->id.'" onclick="abrir_fechar_card_requerimento(\''."$item->created_at".'\'+\''."$filtro".'\'+'.$item->id.')">
                                +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="'.$item->created_at.''.$filtro.''.$item->id.'" style="display:none;">
                        <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="form-group" style="font-size:15px;">
                                    <div>CNPJ: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                    <div>Proprietário: <span class="textoCampo">'.$item->user->name.'</span></div>
                                    <div style="margin-top:10px; margin-bottom:-10px;"><button type="button" onclick="empresaIdDenuncia('.$item->id.')" class="btn btn-success">Verificar Denúncias</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        
        $data = array(
            'success'   => true,
            'table_data' => $output,
        );
        echo json_encode($data);
    }

    public function localizar(Request $request){

        $resultado = Empresa::where('nome','ilike','%'.$request->localizar.'%')->get();

        $output = '';
            if($resultado->count() > 0){
                    $output .= '<div class="container" style="font-weight:bold;">Estabelecimento</div>';
                foreach($resultado as $item){
                    $output .= '<div id="idEstabelecimentoLocalizar'.$item->id.'"  class="container" onmouseenter="mostrarSelecaoLocalizar('.$item->id.')"><a href='.route('mostrar.empresas','value='.Crypt::encrypt($item->id)).' style="font-weight:bold; color:black;text-decoration:none; font-family: Quicksand;"><div>'.$item->nome.'</div></a></div>';
                }
            }else{
                $output .= '<div class="container">Nenhum resultado encontrado para <span style="font-weight:bold">'.$request->localizar.'</span></div>';
            }
        $data = array(
            'success'   => true,
            'table_data' => $output,
        );


        echo json_encode($data);
    }
}


// href="{{ route('mostrar.empresas',["value" => Crypt::encrypt($item->id)]) }}"

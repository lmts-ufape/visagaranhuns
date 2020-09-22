<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\User;
use App\Telefone;
use App\Endereco;
use App\Docempresa;
use App\Area;
use App\Cnae;
use App\CnaeEmpresa;
use App\RespTecnico;
use App\RtEmpresa;
use App\Tipodocempresa;
use Illuminate\Support\Facades\Storage;
use Auth;
use DateTime;
use App\AreaTipodocemp;
use App\Checklistemp;
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

    public function listarResponsavelTec(){

        $empresas = Empresa::where("user_id", Auth::user()->id);
        return view('empresa/responsavel_tec_empresa');
    }

    public function home()
    {
        // dd(Auth::user()->empresa);
        $empresa = Auth::user()->empresa;
        // $id = Crypt::decrypt($request->value);
        // $empresa = Empresa::where("id","=", $idEmpresa)->get();
        // $endereco = Endereco::where('empresa_id', $empresa->id)->first();
        // $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        // $cnae = CnaeEmpresa::where('empresa_id', $id)->get();
        // $rtempresa = RtEmpresa::where('empresa_id', $empresa->id)->get();
        return view('empresa.home_empresa',["empresas" => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::orderBy('nome', 'ASC')->get();
        return view('naoLogado/cadastrar_empresa', ['areas' => $areas]);
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
            'name'     => 'required|string',
            'email'    => 'required|email',
            'password' => 'required',
            'nome'     => 'required|string',
            'cnpjcpf'  => 'required|string',
            'tipo'     => 'required|string',
            'emailEmpresa' => 'nullable|email',
            'telefone1' => 'required|string',
            'telefone2' => 'nullable|string',
            'rua'      => 'required|string',
            'numero' => 'required|string',
            'bairro'   => 'required|string',
            'cidade'   => 'required|string',
            'complemento' => 'nullable|string',
            'uf'       => 'required|string',
            'cep'      => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo' => "empresa",
            'status_cadastro' => "pendente",
        ]);

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->emailEmpresa,
            'cnpjcpf' => $request->cnpjcpf,
            'status_inspecao' => "pendente",
            'status_cadastro' => "pendente",
            'tipo' => $request->tipo,
            'user_id' => $user->id,
        ]);

        // Cadastro de telefones
        $telefone = Telefone::create([
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
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
            $cnaes = Cnae::find($cnae[$i]);
            $cnaeEmpresa = CnaeEmpresa::create([
                'empresa_id' => $empresa->id,
                'cnae_id' => $cnaes->id,
            ]);
        }

        // Cnaes por empresa
        $cnaempresa = CnaeEmpresa::where("empresa_id", $empresa->id)->pluck('cnae_id');
        $cnaes = [];
        $areas = [];

        foreach ($cnaempresa as $indice) {
            array_push($cnaes, Cnae::find($indice));
        }
        foreach ($cnaes as $indice) {
            array_push($areas, $indice->areas_id);
        }

        $resultAreas = array_unique($areas);
        $areasOrdenado = [];

        foreach ($resultAreas as $indice) {
            array_push($areasOrdenado, $indice);
        }

        for ($i=0; $i < count($areasOrdenado); $i++) {
            $areatipodocemp = AreaTipodocemp::where('area_id', $areasOrdenado[$i])->get();

            foreach ($areatipodocemp as $indice) {

                // ABAIXO SAI, CASO SEJA DUPLICADO
                $checklist = Checklistemp::where('nomeDoc', $indice->tipodocemp->nome)
                ->where('empresa_id', $empresa->id)
                ->first();

                if ($checklist == null) {
                    $cnaeEmpresa = Checklistemp::create([
                        'anexado' => 'false',
                        // 'areas_id' => $areasOrdenado[$i], VOLTA CASO FIQUE DUPLICADO
                        'nomeDoc' => $indice->tipodocemp->nome,
                        'tipodocemp_id' => $indice->tipodocemp->id,
                        'empresa_id' => $empresa->id,
                    ]);
                }
            }
        }


        return redirect()->route('confirma.cadastro');
    }

    public function adicionarEmpresa(Request $request)
    {
        $user_id = $request->user;

        // Sujeito a mudanças
        $validator = $request->validate([
            'nome'     => 'required|string',
            'cnpjcpf'  => 'required|string',
            'tipo'     => 'required|string',
            'email'    => 'nullable|email',
            'telefone1' => 'required|string',
            'telefone2' => 'nullable|string',
            'rua'      => 'required|string',
            'numero' => 'required|string',
            'bairro'   => 'required|string',
            'cidade'   => 'required|string',
            'uf'       => 'required|string',
            'cep'      => 'required|string',
            'complemento' => 'nullable|string',
        ]);

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->emailEmpresa,
            'cnpjcpf' => $request->cnpjcpf,
            'status_inspecao' => "pendente",
            'status_cadastro' => "pendente",
            'tipo' => $request->tipo,
            'user_id' => $user_id,
        ]);

        // Cadastro de telefones
        $telefone = Telefone::create([
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
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

        // Área para cadastro de cnaesQ
        $cnae = $request['cnae'];


        for($i = 0; $i < count($cnae); $i++) {
            $cnaes = Cnae::find($cnae[$i]);
            $cnaeEmpresa = CnaeEmpresa::create([
                'empresa_id' => $empresa->id,
                'cnae_id' => $cnaes->id,
            ]);
        }

        // Cnaes por empresa
        $cnaempresa = CnaeEmpresa::where("empresa_id", $empresa->id)->pluck('cnae_id');
        $cnaes = [];
        $areas = [];

        foreach ($cnaempresa as $indice) {
            array_push($cnaes, Cnae::find($indice));
        }
        foreach ($cnaes as $indice) {
            array_push($areas, $indice->areas_id);
        }

        $resultAreas = array_unique($areas);
        $areasOrdenado = [];

        foreach ($resultAreas as $indice) {
            array_push($areasOrdenado, $indice);
        }

        for ($i=0; $i < count($areasOrdenado); $i++) {
            $areatipodocemp = AreaTipodocemp::where('area_id', $areasOrdenado[$i])->get();

            foreach ($areatipodocemp as $indice) {

                // ABAIXO SAI, CASO SEJA DUPLICADO
                $checklist = Checklistemp::where('nomeDoc', $indice->tipodocemp->nome)
                ->where('empresa_id', $empresa->id)
                ->first();

                if ($checklist == null) {
                    $cnaeEmpresa = Checklistemp::create([
                        'anexado' => 'false',
                        // 'areas_id' => $areasOrdenado[$i], VOLTA CASO FIQUE DUPLICADO
                        'nomeDoc' => $indice->tipodocemp->nome,
                        'tipodocemp_id' => $indice->tipodocemp->id,
                        'empresa_id' => $empresa->id,
                    ]);
                }
            }
        }

        return redirect()->route('confirma.cadastro');
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
        $cnae = CnaeEmpresa::where('empresa_id', $id)->get();
        $rtempresa = RtEmpresa::where('empresa_id', $empresa->id)->get();

        // $cnae = array();
        // foreach($cnaeEmpresa as $indice){
        //     $cnaes = Cnae::find($indice->cnae_id);
        //     array_push($cnae, $cnaes);
        // }

        return view('coordenador/show_empresa_coordenador', ['empresa' => $empresa, 'endereco' => $endereco, 'telefone' =>$telefone, 'cnae' => $cnae, 'rt' => $rtempresa]);
    }

    /**
     * Listar empresas
     * View: empresa/listar_empresas.blade.php
    */
    public function listarEmpresas(Request $request){
        //Preciso da função para carregar a página
        // $empresa = Empresa::where('user_id', Crypt::decrypt($request->user))->paginate(20);
        // return view('empresa/listar_empresas',['empresas' => $empresa]);
        if($request->tipo == 'estabelecimentos'){
            $empresa = Empresa::where('user_id', Crypt::decrypt($request->user))->paginate(20);
            return view('empresa/listar_empresas',['empresas' => $empresa, 'tipo' => 'estabelecimentos']);
        }elseif($request->tipo == 'documentacao'){
            $empresa = Empresa::where('user_id', Crypt::decrypt($request->user))->paginate(20);
            return view('empresa/listar_empresas',['empresas' => $empresa, 'tipo' => 'documentacao']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarEmpresa(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        $user = User::find(Auth::user()->id);
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();

        $validator = $request->validate([
            'name'     => 'nullable|string',
            'cnpjcpf'  => 'nullable|string',
            'tipo'     => 'nullable|string',
            'numeroTelefone'  => 'nullable|string',
            'rua'      => 'nullable|string',
            'numero'   => 'nullable|string',
            'bairro'   => 'nullable|string',
            'cidade'   => 'nullable|string',
            'uf'       => 'nullable|string',
            'cep'      => 'nullable|string',
            'complemento'  => 'nullable|string',
        ]);

        $user->name = $request->name;
        $user->save();

        $empresa->cnpjcpf = $request->cnpjcpf;
        $empresa->tipo    = $request->tipo;
        $empresa->save();

        $telefone->numero = $request->numeroTelefone;
        $telefone->save();

        $endereco->rua         = $request->rua;
        $endereco->numero      = $request->numero;
        $endereco->bairro      = $request->bairro;
        $endereco->cidade      = $request->cidade;
        $endereco->uf          = $request->uf;
        $endereco->cep         = $request->cep;
        $endereco->complemento = $request->complemento;

        $endereco->save();

        return redirect()->route('/');

    }

    public function edit($id)
    {
        // Empresa que será editada
        $empresa = Empresa::where("user_id", $id)->first();
        // Cnaes que podem ser escolhidos para troca
        $ensino       = Cnae::where("areas_id", "1")->get();
        $saude        = Cnae::where("areas_id", "2")->get();
        $distrSaude   = Cnae::where("areas_id", "3")->get();
        $camPipa      = Cnae::where("areas_id", "4")->get();
        $tratAgua     = Cnae::where("areas_id", "5")->get();
        $mei          = Cnae::where("areas_id", "6")->get();
        $diversos     = Cnae::where("areas_id", "7")->get();
        $meiAlimentos = Cnae::where("areas_id", "8")->get();

        // Definir a página para a edição de empresa
        return view('empresa.editar', [
            'empresa'    => $empresa,
            'ensino'     => $ensino,
            'saude'      => $saude,
            'distrSaude' => $distrSaude,
            'camPipa'    => $camPipa,
            'tratAgua'   => $tratAgua,
            'mei'        => $mei,
            'diversos'   => $diversos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listarArquivos($id)
    {
        $docempresa = Docempresa::where("empresa_id", $id)->get();
        // Definir a página para a listagem de arquivos de uma empresa
        return view('/', ["arquivos" => $docempresa]);
    }

    public function baixarArquivos(Request $request)
    {
        return response()->download(storage_path('app/'.$request->arquivo));
    }

    public function anexarArquivos(Request $request)
    {

        if($request->tipodocempresa == "Tipos de documentos"){
            session()->flash('error', 'Selecione um documento!');
            return back();
        }elseif($request->arquivo == null){
            session()->flash('error', 'Selecione um aquivo e tente novamente!');
            return back();
        }

        $checklist = Checklistemp::where('tipodocemp_id', $request->tipodocempresa)->first();
        // dd($checklist);
        $empresa = Empresa::find($request->empresaId);

        $validatedData = $request->validate([

            'arquivo' => ['nullable', 'file', 'mimes:pdf', 'max:5000000'],
            'data'    => ['nullable', 'date'],

        ]);


        $fileDocemp = $request->arquivo;

        $pathDocemp = 'empresas/' . $empresa->id . '/';
        // $pathDocemp = 'empresas/' . $empresa->id . '/' . $checklist->areas_id . '/';
        $nomeDocemp = $request->arquivo->getClientOriginalName();

        Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

        $docEmpresa = Docempresa::create([
            'nome'  => $pathDocemp . $nomeDocemp,
            'data_validade' => $request->data,
            'empresa_id'  => $empresa->id,
            'tipodocemp_id' => $request->tipodocempresa,
        ]);

        $checklist->anexado = "true";
        $checklist->save();

        // return view('empresa.home_empresa');
        session()->flash('success', 'O arquivo foi anexado com sucesso!');
        return back();

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
    public function paginaCadastrarEmpresa(){
        // dd("opa");
        $areas = Area::orderBy('nome', 'ASC')->get();
        return view('empresa/cadastrar_empresa', ['areas' => $areas]);
    }
    /**
     * Funcao: Redireciona o dono do estabelecimento para a tela de perfil do estabelecimento
     * View de destino: empresa/show_empresa.blade.php
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEmpresa(Request $request){
        $id = Crypt::decrypt($request->value);
        $empresa = Empresa::find($id);
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        $cnaeEmpresa = CnaeEmpresa::where('empresa_id', $id)->get();
        $respTecnicos = RespTecnico::where("empresa_id", $empresa->id)->get();
        // $rtempresa = RtEmpresa::where('empresa_id', $empresa->id)->get();

        // $resptecnicos = [];
        // for ($i=0; $i < count($rtempresa); $i++) {
        //     array_push($resptecnicos, RespTecnico::find($rtempresa[$i]));
        // }

        // $cnae = array();
        // foreach($cnaeEmpresa as $indice){
        //     $cnaes = Cnae::find($indice->cnae_id);
        //     array_push($cnae, $cnaes);
        // }
        return view('empresa/show_empresa',['empresa' => $empresa,
         'endereco' => $endereco,
         'telefone' =>$telefone,
         'cnae' => $cnaeEmpresa,
         'respTecnico' => $respTecnicos,
         'empresaId'     => $empresa->id,
         ]);
    }
    public function showDocumentacao(Request $request){

        $idEmpresa = Crypt::decrypt($request->value);
        $empresa = Empresa::where('id', $idEmpresa)->first();
        $docsempresa = Docempresa::where('empresa_id', $empresa->id)->get();
        $cnaempresa = CnaeEmpresa::where("empresa_id", $idEmpresa)->pluck('cnae_id');
        $tipos = Tipodocempresa::all();
        $cnaes = [];
        $areas = [];
        $area = [];

        foreach ($cnaempresa as $indice) {
            array_push($cnaes, Cnae::find($indice));
        }
        foreach ($cnaes as $indice) {
            array_push($areas, $indice->areas_id);
        }

        $resultAreas = array_unique($areas);

        foreach ($resultAreas as $indice) {
            array_push($area, Area::find($indice));
        }

        $checklist = Checklistemp::where('empresa_id', $empresa->id)->orderBy('id','ASC')->get();

        // $hoje = date('d/m/Y');
        // $formatoHoje = 'd/m/Y';
        // $Hoje = DateTime::createFromFormat($formatoHoje, $hoje);

        // foreach ($checklist as $check) {

        // }

        // foreach ($docsempresa as $indice) {
        //     $formato = 'd/m/Y';
        //     $validade = DateTime::createFromFormat($formato, $indice->data_validade);
        //     $intervalo = $validade->diff($Hoje);
        //     if ($hoje > $indice->data_validade) {
        //         // Volta a ser pendente
        //     }
        //     elseif (condition) {
        //         # code...
        //     }
        // }

        return view('empresa/documentacao_empresa',['nome'=>$empresa->nome,
        'areas' => $area,
        'empresaId' => $empresa->id,
        'checklist' => $checklist,
        'docsempresa' => $docsempresa,
        'tipos' => $tipos
        ]);
    }
    public function ajaxCnaes(Request $request){
        $this->listar($request->id_area);
    }
    public function listar($idArea){
        $resultado = Cnae::where('areas_id','=',$idArea)->orderBy('descricao', 'ASC')->get();
        // return view('coordenador/cnaes_coordenador', ['cnaes' => $cnaes]);
        $output = '';
            if($resultado->count() > 0){
                foreach($resultado as $item){
                    $output .= '
                    <div class="d-flex justify-content-center cardMeuCnae" onmouseenter="mostrarBotaoAdicionar('.$item->id.')">
                        <div class="mr-auto p-2>OPA</div>
                            <div class="mr-auto p-2" id="'.$item->id.'">'.$item->descricao.'</div>
                            <div style="width:140px; height:25px; text-align:right;">
                                <div id="cardSelecionado'.$item->id.'" class="btn-group" style="display:none;">
                                    <div class="btn btn-success btn-sm"  onclick="add('.$item->id.')" >Adicionar</div>
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

    public function foundChecklist(Request $request){
        $empresa = Empresa::find($request->empresaId);
        $checklist = Checklistemp::find($request->checklistId);

        $data = array(
            'success'   => true,
            'checklist' => $checklist->id,
            'empresa'   => $empresa->id,
        );
        return $data;
    }

    public function downloadArquivo(Request $request){
        return response()->download(storage_path('app/' . $request->file));
    }
}

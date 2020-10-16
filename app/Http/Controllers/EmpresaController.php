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

        $userFind = User::where('email', $request->email)->first();

        if($userFind != null){
            session()->flash('error', 'Já existe um usuário no sistema com este email!');
            return back();
        }

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
                // $checklist = Checklistemp::where('nomeDoc', $indice->tipodocemp->nome)
                // ->where('empresa_id', $empresa->id)
                // ->first();

                $cnaeEmpresa = Checklistemp::create([
                    'anexado' => 'false',
                    'areas_id' => $areasOrdenado[$i],
                    'nomeDoc' => $indice->tipodocemp->nome,
                    'tipodocemp_id' => $indice->tipodocemp->id,
                    'empresa_id' => $empresa->id,
                ]);
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
        $cnaeEmpresa = CnaeEmpresa::where('empresa_id', $id)->get();
        // $respTecnicos = RespTecnico::where("empresa_id", $empresa->id)->get();
        $rtempresa = RtEmpresa::where('empresa_id', $empresa->id)->get();

        $resptecnicos = [];
        for ($i=0; $i < count($rtempresa); $i++) {
            if (count($resptecnicos) == 0) {
                array_push($resptecnicos, RespTecnico::find($rtempresa[$i]->resptec_id));
            }
            else {
                for ($j=0; $j < count($resptecnicos); $j++) {
                    if($rtempresa[$i]->resptec_id != $resptecnicos[$j]->id) {
                        array_push($resptecnicos, RespTecnico::find($rtempresa[$i]->resptec_id));
                    }
                }
            }
        }

        return view('coordenador/show_empresa_coordenador', ['empresa' => $empresa, 'endereco' => $endereco, 'telefone' =>$telefone, 'cnae' => $cnaeEmpresa, 'rt' => $resptecnicos]);
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
    public function editarEmpresa(Request $request)
    {

        $empresa = Empresa::find($request->empresaId);
        $user = User::find(Auth::user()->id);
        $telefone = Telefone::where('empresa_id', $empresa->id)->first();
        $endereco = Endereco::where('empresa_id', $empresa->id)->first();

        $validator = $request->validate([
            'nome'     => 'nullable|string',
            'cnpjcpf'  => 'nullable|string',
            'tipo'     => 'nullable|string',
            'telefone1'  => 'nullable|string',
            'telefone2'  => 'nullable|string',
            'rua'      => 'nullable|string',
            'numero'   => 'nullable|string',
            'bairro'   => 'nullable|string',
            'cidade'   => 'nullable|string',
            'uf'       => 'nullable|string',
            'cep'      => 'nullable|string',
            'complemento'  => 'nullable|string',
        ]);

        $user->name = $request->nome;
        $user->save();

        $empresa->cnpjcpf = $request->cnpjcpf;
        $empresa->tipo    = $request->tipo;
        $empresa->save();

        $telefone->telefone1 = $request->telefone1;
        $telefone->telefone2 = $request->telefone2;
        $telefone->save();

        $endereco->rua         = $request->rua;
        $endereco->numero      = $request->numero;
        $endereco->bairro      = $request->bairro;
        $endereco->cidade      = $request->cidade;
        $endereco->uf          = $request->uf;
        $endereco->cep         = $request->cep;
        $endereco->complemento = $request->complemento;

        $endereco->save();

        $cnae = $request['cnae'];

        $cnaeempresa = CnaeEmpresa::where('empresa_id', $empresa->id)->pluck('cnae_id');
        $temp = [];
        foreach ($cnaeempresa as $indice) {
            array_push($temp, $indice);
        }

        for ($i=0; $i < count($cnae); $i++) { 
            if(!in_array($cnae[$i], $temp)){
                $cnaeEmpresa = CnaeEmpresa::create([
                    'empresa_id' => $empresa->id,
                    'cnae_id' => $cnae[$i],
                ]);
            }
        }

        return redirect()->route('/');

    }

    public function edit(Request $request)
    {
        $empresa = Empresa::find(decrypt($request->empresaId));
        // $cnaeEmpresa = CnaeEmpresa::where('empresa_id','=',decrypt($request->empresaId))->get();
        $areas = Area::orderBy('nome', 'ASC')->get();

        // $resultados = CnaeEmpresa::where('empresa_id',$empresa->id)->get();
        // $resultado = [];

        // foreach ($resultados as $indice) {
        //     array_push($resultado, Cnae::find($indice->cnae_id));
        //     // dd($indice->cnae_id);
        // }

        // dd($resultado[1]);
        // // return view('coordenador/cnaes_coordenador', ['cnaes' => $cnaes]);
        // $arrayTemp = [];
        // $output = '';
        //     if($resultado->count() > 0){
        //         foreach($resultado as $item){
        //             $output .= '
        //             <div class="d-flex justify-content-center form-gerado cardMeuCnae" onmouseenter="mostrarBotaoAdicionar('.$item->id.')">
        //                 <div class="mr-auto p-2>OPA</div>
        //                     <div class="mr-auto p-2" id="'.$item->id.'">'.$item->cnae->descricao.'</div>
        //                     <input type="hidden" name="cnae[]" value="'.$item->id.'">
        //                     <div style="width:140px; height:25px; text-align:right;">
        //                         <div id="cardSelecionado'.$item->id.'" class="btn-group" style="display:none;">
        //                             <div class="btn btn-danger btn-sm" onclick="deletar_EditarCnaeEmpresa('.$item->id.')" >X</div>
        //                         </div>
        //                     </div>
        //             </div>
        //             ';
        //             array_push($arrayTemp, $item->id);
        //         }
        //     }elseif($idEmpresa == ""){
        //         $output .= '
        //                 <label></label>
        //             ';
        //     }else{
        //         $output .= '
        //                 <label>vazio</label>
        //             ';
        //     }
        //     $data = array(
        //         'success'   => true,
        //         'table_data' => $output,
        //         'arrayTemp' => $arrayTemp, //atualizar o array temp
        //     );
        //     echo json_encode($data);


        return view('empresa/editar_empresa', ["empresa" => $empresa, "areas" => $areas]);
        // // Empresa que será editada
        // $empresa = Empresa::where("user_id", $id)->first();
        // // Cnaes que podem ser escolhidos para troca
        // $ensino       = Cnae::where("areas_id", "1")->get();
        // $saude        = Cnae::where("areas_id", "2")->get();
        // $distrSaude   = Cnae::where("areas_id", "3")->get();
        // $camPipa      = Cnae::where("areas_id", "4")->get();
        // $tratAgua     = Cnae::where("areas_id", "5")->get();
        // $mei          = Cnae::where("areas_id", "6")->get();
        // $diversos     = Cnae::where("areas_id", "7")->get();
        // $meiAlimentos = Cnae::where("areas_id", "8")->get();

        // // Definir a página para a edição de empresa
        // return view('empresa.editar', [
        //     'empresa'    => $empresa,
        //     'ensino'     => $ensino,
        //     'saude'      => $saude,
        //     'distrSaude' => $distrSaude,
        //     'camPipa'    => $camPipa,
        //     'tratAgua'   => $tratAgua,
        //     'mei'        => $mei,
        //     'diversos'   => $diversos,
        // ]);
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

    public function findDoc(Request $request)
    {

        $docempresa = Docempresa::find($request->id);

        $data = array(
            'nome'   => $docempresa->nome,
        );

        echo json_encode($data);
    }

    public function baixarArquivos(Request $request)
    {
        return response()->download(storage_path('app/'.$request->arquivo));
    }

    public function editarArquivos(Request $request)
    {

        $validatedData = $request->validate([

            'arquivo' => ['nullable', 'file', 'mimes:pdf', 'max:5000000'],

        ]);
        // dd($request->file);

        $docempresa = Docempresa::where("nome", $request->file)->first();

        Storage::delete($docempresa->nome);

        $fileDocemp = $request->arquivo;

        $pathDocemp = 'empresas/' . $docempresa->empresa_id . '/' . $docempresa->tipodocemp_id . '/'; 

        $nomeDocemp = $request->arquivo->getClientOriginalName();

        $docempresa->nome = $pathDocemp . $nomeDocemp;
        $docempresa->save();

        Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

        session()->flash('success', 'Arquivo salvo com sucesso!');
        return back();
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

        $checklist = Checklistemp::where('tipodocemp_id', $request->tipodocempresa)
        ->where('empresa_id', $request->empresaId)->get();

        if ($checklist == null) {
            session()->flash('error', 'O tipo de documento específico não consta em sua checklist!');
            return back();
        }

        foreach ($checklist as $indice) {
            if ($indice->tipodocemp_id == $request->tipodocempresa && $indice->anexado == "true") {
                session()->flash('error', 'Este tipo de arquivo já foi anexado!');
                return back();
            }

            $indice->anexado = "true";
            $indice->save();
        }

        $empresa = Empresa::find($request->empresaId);

        $validatedData = $request->validate([

            'arquivo'         => ['required', 'file', 'mimes:pdf', 'max:5000000'],
            'tipodocempresa'  => ['required'],
            'data_emissao'    => ['required', 'date'],
            'data_validade'   => ['nullable', 'date'],

        ]);

        $fileDocemp = $request->arquivo;

        $pathDocemp = 'empresas/' . $empresa->id . '/' . $request->tipodocempresa . '/';

        $nomeDocemp = $request->arquivo->getClientOriginalName();

        Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

        $docEmpresa = Docempresa::create([
            'nome'  => $pathDocemp . $nomeDocemp,
            'data_emissao'  => $request->data_emissao,
            'data_validade' => $request->data_validade,
            'empresa_id'  => $empresa->id,
            'tipodocemp_id' => $request->tipodocempresa,
        ]);


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
        // $respTecnicos = RespTecnico::where("empresa_id", $empresa->id)->get();
        $rtempresa = RtEmpresa::where('empresa_id', $empresa->id)->get();

        $resptecnicos = [];

        foreach ($rtempresa as $indice) {
            array_push($resptecnicos, RespTecnico::find($indice->resptec_id));
        }

        $temp = array_unique($resptecnicos);

        return view('empresa/show_empresa',['empresa' => $empresa,
         'endereco' => $endereco,
         'telefone' =>$telefone,
         'cnae' => $cnaeEmpresa,
         'respTecnico' => $temp,
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

        $checklisttemp = Checklistemp::where('empresa_id', $empresa->id)->orderBy('id','ASC')->get();
        $checklist = [];

        for ($i=0; $i < count($checklisttemp); $i++) {
            if (count($checklist) == 0) {
                array_push($checklist, $checklisttemp[$i]);
            }
            else {
                $temp = false;
                for ($j=0; $j < count($checklist); $j++) {
                    if($checklisttemp[$i]->tipodocemp_id == $checklist[$j]->tipodocemp_id) {
                        if ($checklist[$j]->anexado == "true") {
                            $temp = true;
                        }
                        else {
                            $checklist[$j] = $checklisttemp[$i];
                            $temp = true;
                        }
                    }
                }
                if ($temp == false) {
                    array_push($checklist, $checklisttemp[$i]);
                }
            }
        }


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
    /*
    * Função para add cnae
    * Tela: editar_empresa.blade
    */
    public function ajaxAddCnae_editarEmpresa(Request $request){
        $this->listarCnae_editarEmpresa($request->id_area);
    }
    public function listarCnae_editarEmpresa($idArea){
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
                                    <div class="btn btn-success btn-sm"  onclick="add_EditarCnaeEmpresa('.$item->id.')" >Adicionar</div>
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
                // 'arrayTemp' => $arrayTemp, //atualizar o array temp
            );
            echo json_encode($data);
    }
     /*
    * Função para mostrar na tela os cnaes da empresa
    * Tela: editar_empresa.blade
    */
    public function ajaxCnaesEmpresa(Request $request){

        $this->listarCnaes($request->id_empresa);

    }
    public function listarCnaes($idEmpresa){
        $resultado = CnaeEmpresa::where('empresa_id', $idEmpresa)->get();

        // TENTANDO MUDAR AQUI EMBAIXO
        // $resultados = CnaeEmpresa::where('empresa_id', $idEmpresa)->get();
        
        // $resultado = [];

        // foreach ($resultados as $indice) {
        //     array_push($resultado, Cnae::find($indice->cnae_id));
        // }

        $arrayTemp = [];
        $output = '';
            if($resultado->count() > 0){
                foreach($resultado as $item){
                    $output .= '
                    <div class="d-flex justify-content-center form-gerado cardMeuCnae" onmouseenter="mostrarBotaoAdicionar('.$item->id.')">
                        <div class="mr-auto p-2>OPA</div>
                            <div class="mr-auto p-2" id="'.$item->id.'">'.$item->cnae->descricao.'</div>
                            <input type="hidden" name="cnae[]" value="'.$item->cnae->id.'">
                            <div style="width:140px; height:25px; text-align:right;">
                                <div id="cardSelecionado'.$item->id.'" class="btn-group" style="display:none;">
                                    <div class="btn btn-danger btn-sm" onclick="deletar_EditarCnaeEmpresa('.$item->id.')" >X</div>
                                </div>
                            </div>
                    </div>
                    ';
                    array_push($arrayTemp, $item->id);
                }
            }elseif($idEmpresa == ""){
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
                'arrayTemp' => $arrayTemp, //atualizar o array temp
            );
            echo json_encode($data);
    }

    public function apagarCnaeEmpresa(Request $request)
    {
        $delete = CnaeEmpresa::destroy($request->idCnaeEmp);

        return $delete;
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

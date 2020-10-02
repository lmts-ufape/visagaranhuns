<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RespTecnico;
use App\User;
use App\Area;
use App\AreaTipodocresp;
use App\Tipodocresp;
use App\Empresa;
use App\Docresptec;
use Auth;
use Illuminate\Support\Str;
use App\RtEmpresa;
use App\CnaeEmpresa;
use App\Cnae;
use App\Checklistresp;
use Illuminate\Support\Facades\Storage;

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
        $cnaeEmpresa = CnaeEmpresa::where('empresa_id', $request->empresaId)->get();
        $rtempresa = RtEmpresa::where('empresa_id', $request->empresaId)->get();

        $resptecnicos = [];

        foreach ($rtempresa as $indice) {
            array_push($resptecnicos, RespTecnico::find($indice->resptec_id));
        }

        $temp = array_unique($resptecnicos);
        
        $cnae = array();
        $areas = array();

        foreach($cnaeEmpresa as $indice){
            $cnaes = Cnae::find($indice->cnae_id);
            array_push($cnae, $cnaes);
        }

        foreach($cnae as $indice){
            $area = Area::find($indice->areas_id);
            array_push($areas, $area);
        }
        
        $resultAreasTemp = array_unique($areas);

        $areasOrdenado = [];

        foreach ($resultAreasTemp as $indice) {
            array_push($areasOrdenado, $indice);
        }

        return view('responsavel_tec.cadastrar_responsavel_tec')->with(["user" => $user, 
        "empresaId" => $request->empresaId, 
        'areas' => $areasOrdenado, 
        'respTecnicos' => $temp, 
        'rtempresa' => $rtempresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $empresa = Empresa::find($request->empresaId);
        $user    = User::where("email", $request->email)->first();
        
        if ($user != null) {

            for ($i=0; $i < count($request->area); $i++) { 
                $rtempresa = RtEmpresa::where('area_id', $request->area[$i])
                ->where('empresa_id', $request->empresaId)->first();
                if ($rtempresa != null) {
                    session()->flash('error', 'Já existe um responsável técnico cadastrado nessa área!');
                    return back();
                }
            }
            
            $resptecnico = RespTecnico::where('user_id', $user->id)->first();

            $validator = $request->validate([
                'carga_horaria'  => 'required|integer',
            ]);

            $passwordTemporario = Str::random(8);
            \Illuminate\Support\Facades\Mail::send(new \App\Mail\CadastroRTcadastrado($request->email, $empresa->nome));

            $hoje = date('d/m/Y');

            for ($i=0; $i < count($request->area); $i++) { 
                $rtempresa = RtEmpresa::create([
                    'horas' => $request->carga_horaria,
                    'data_inicio' => $hoje,
                    'status' => "ativo",
                    'resptec_id' => $resptecnico->id,
                    'empresa_id' => $request->empresaId,
                    'area_id' => $request->area[$i],
                ]);
            }

            session()->flash('success', 'Responsável técnico convidado com sucesso!');
            return back();

        }

        else {

            for ($i=0; $i < count($request->area); $i++) { 
                $rtempresa = RtEmpresa::where('area_id', $request->area[$i])
                ->where('empresa_id', $request->empresaId)->first();
                if ($rtempresa != null) {
                    session()->flash('error', 'Já existe um responsável técnico cadastrado nessa área!');
                    return back();
                }
            }

            $hoje = date('d/m/Y');

            $validator = $request->validate([
                'nome'     => 'required|string',
                'email'    => 'required|email',
                'formacao' => 'required|string',
                'especializacao' => 'nullable|string',
                'cpf'            => 'required|string',
                'telefone'       => 'required|string',
                'carga_horaria'  => 'required|integer',
            ]);
    
            $passwordTemporario = Str::random(8);
    
            $user = User::create([
                'name'            => $request->nome,
                'email'           => $request->email,
                'password'        => bcrypt($passwordTemporario),
                'tipo'            => "rt",
                'status_cadastro' => "aprovado",
            ]);
    
            \Illuminate\Support\Facades\Mail::send(new \App\Mail\CadastroRTEmail($request->email, $passwordTemporario, $empresa->nome));
    
            $respTec = RespTecnico::create([
                'formacao'       => $request->formacao,
                'especializacao' => $request->especializacao,
                'cpf'            => $request->cpf,
                'telefone'       => $request->telefone,
                'user_id'        => $user->id,
                // 'area_id'        => $request->area,
                // 'empresa_id'     => $request->empresaId,
            ]);

            for ($i=0; $i < count($request->area); $i++) { 
                $rtempresa = RtEmpresa::create([
                    'horas' => $request->carga_horaria,
                    'data_inicio' => $hoje,
                    'status' => "ativo",
                    'resptec_id' => $respTec->id,
                    'empresa_id' => $request->empresaId,
                    'area_id' => $request->area[$i],
                ]);
            }

            $rtempresatemp = RtEmpresa::where('resptec_id', $respTec->id)->get();
            $areastemp = [];

            foreach ($rtempresatemp as $indice) {
                array_push($areastemp, $indice->area_id);    
            }

            for ($i=0; $i < count($areastemp); $i++) {
                $areatipodocresp = AreaTipodocresp::where('area_id', $areastemp[$i])->get();
    
                foreach ($areatipodocresp as $indice) {
                    // dd("Antes");
                    $checklistresp = Checklistresp::create([
                        'anexado' => 'false',
                        'areas_id' => $areastemp[$i],
                        'nomeDoc' => $indice->tipodocresp->nome,
                        'tipodocres_id' => $indice->tipodocresp->id,
                        'resptecnicos_id' => $respTec->id,
                    ]);
                }
            }
    
            return redirect()->route('/');
        }
    }

    public function baixarArquivos(Request $request)
    {
        return response()->download(storage_path('app/'.$request->file));
    }

    public function findDocRt(Request $request)
    {

        $docrt = Docresptec::find($request->id);

        $data = array(
            'nome'   => $docrt->nome,
        );

        echo json_encode($data);
    }

    public function editarArquivos(Request $request)
    {

        $validatedData = $request->validate([

            'arquivo' => ['nullable', 'file', 'mimes:pdf', 'max:5000000'],

        ]);

        $docrt = Docresptec::where("nome", $request->file)->first();
        
        Storage::delete($docrt->nome);

        $fileDocemp = $request->arquivo;

        $pathDocemp = 'empresas/' . $docrt->empresa_id . '/' . $docrt->tipodocemp_id . '/'; 

        $nomeDocemp = $request->arquivo->getClientOriginalName();

        $docrt->nome = $pathDocemp . $nomeDocemp;
        $docrt->save();

        Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

        session()->flash('success', 'Arquivo salvo com sucesso!');
        return back();
    }

    public function showDocumentacao(Request $request)
    {
        $user = Auth::user()->id;
        $rt = RespTecnico::where('user_id', $user)->first();
        $docsrt = Docresptec::where('resptecnicos_id', $rt->id)->get();
        $temp = [];
        $checkrespt = [];

        $checklistresp = Checklistresp::where('resptecnicos_id', $rt->id)->orderBy('id','ASC')->pluck('tipodocres_id');
        for ($i=0; $i < count($checklistresp); $i++) { 
            array_push($temp, $checklistresp[$i]);
        }
        
        $array = array_unique($temp);

        foreach ($array as $indice) {
            array_push($checkrespt, Checklistresp::where('tipodocres_id', $indice)
            ->where('resptecnicos_id', $rt->id)->first());
        }
        // dd($checkrespt);

        $tipodocresp = Tipodocresp::all();

        return view('responsavel_tec/documentos',[
            'checklist' => $checkrespt,
            'tipodocs'  => $tipodocresp,
            'docsrt'    => $docsrt,
        ]);
        
    }

    public function anexarArquivos(Request $request)
    {
        if($request->tipodocres == "Tipos de documentos"){
            session()->flash('error', 'Selecione um documento!');
            return back();
        }
        
        $user = Auth::user()->id;
        $rt = RespTecnico::where('user_id', $user)->first();
        $checklist = Checklistresp::where('tipodocres_id', $request->tipodocres)
        ->where('resptecnicos_id', $rt->id)->get();

        foreach ($checklist as $indice) {
            if ($indice->tipodocres_id == $request->tipodocres && $indice->anexado == "true") {
                session()->flash('error', 'Este tipo de arquivo já foi anexado!');
                return back();
            }

            $indice->anexado = "true";
            $indice->save();
        }

        $validatedData = $request->validate([

            'arquivo'         => ['required', 'file', 'mimes:pdf', 'max:5000000'],
            'tipodocres'      => ['required'],
            'data_emissao'    => ['required', 'date'],
            'data_validade'   => ['nullable', 'date'],

        ]);

        $fileDocemp = $request->arquivo;

        $pathDocemp = 'rts/' . $rt->id . '/' . $request->tipodocres . '/';

        $nomeDocemp = $request->arquivo->getClientOriginalName();

        Storage::putFileAs($pathDocemp, $fileDocemp, $nomeDocemp);

        $docEmpresa = Docresptec::create([
            'nome'  => $pathDocemp . $nomeDocemp,
            'data_emissao'  => $request->data_emissao,
            'data_validade' => $request->data_validade,
            'resptecnicos_id'  => $rt->id,
            'tipodocresp_id' => $request->tipodocres,
        ]);


        // return view('empresa.home_empresa');
        session()->flash('success', 'O arquivo foi anexado com sucesso!');
        return back();

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
    public function edit(Request $request)
    {
        $user = User::find($request->user);
        $respTecnico = RespTecnico::where('user_id', $user->id)->first();

        return view('responsavel_tec/editar_dados_responsavel_tec', 
        ['user' => $user,
         'respTecnico' => $respTecnico]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $respTecnico = RespTecnico::find($request->respTecnico);
        $user = User::where('id', $respTecnico->user_id)->first();

        $validator = $request->validate([
            'nome'     => 'required|string',
            'formacao' => 'required|string',
            'especializacao' => 'nullable|string',
            'cpf'            => 'required|string',
            'telefone'       => 'required|string',
        ]);

        $user->name = $request->nome;
        $user->password = bcrypt($request->password);
        $user->save();

        $respTecnico->formacao = $request->formacao;
        if(isset($request->especializacao)){
            $respTecnico->especializacao = $request->especializacao;
        }
        $respTecnico->cpf = $request->cpf;
        $respTecnico->telefone = $request->telefone;
        $respTecnico->save();

        return redirect()->route('/');
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

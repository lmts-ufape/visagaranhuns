<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RespTecnico;
use App\User;
use App\Area;
use App\Empresa;
use Auth;
use Illuminate\Support\Str;
use App\RtEmpresa;
use App\CnaeEmpresa;
use App\Cnae;

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


        // Tela de conclusão de cadastro de Responsavel Técnico
        return view('responsavel_tec.cadastrar_responsavel_tec')->with(["user" => $user, "empresaId" => $request->empresaId, 'areas' => $areasOrdenado, 'respTecnicos' => $resptecnicos, 'rtempresa' => $rtempresa]);
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

            $rtempresa = RtEmpresa::where('area_id', $request->area)->first();
            // $resptecnico = RespTecnico::where('user_id', $user->id)->first();

            if ($rtempresa != null) {
                session()->flash('error', 'Já existe um responsável técnico cadastrado nessa área!');
                return back();
            }
            else {

                $validator = $request->validate([
                    'carga_horaria'  => 'required|integer',
                ]);

                $passwordTemporario = Str::random(8);
                \Illuminate\Support\Facades\Mail::send(new \App\Mail\CadastroRTEmail($request->email, $empresa->nome));

                $hoje = date('d/m/Y');

                $rtempresa = RtEmpresa::create([
                    'horas' => $request->carga_horaria,
                    'data_inicio' => $hoje,
                    'status' => "ativo",
                    'resptec_id' => $resptecnico->id,
                    'empresa_id' => $request->empresaId,
                    'area_id' => $request->area,
                ]);

                session()->flash('success', 'Responsável técnico convidado com sucesso!');
                return back();
            }
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
    
            return redirect()->route('/');
        }


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

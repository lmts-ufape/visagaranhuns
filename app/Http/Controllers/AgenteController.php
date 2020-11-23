<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\User;
use App\InspecAgente;
use App\Inspecao;
use App\InspecaoFoto;
use App\InspecaoRelatorio;
use App\Relatorio;
use App\Empresa;
use App\Denuncia;
use Illuminate\Support\Facades\Crypt;
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
        $token = User::where('id','=',Auth::user()->id)->first();
        $agente = Agente::where('user_id','=',Auth::user()->id)->first();
        $inspAgentes = InspecAgente::where('agente_id',$agente->id)->get();
        $inspecoesPendentes = [];
        $inspecoesConcluidas = [];

        foreach ($inspAgentes as $indice) {
            $inspecao = Inspecao::find($indice->inspecoes_id);

            if ($inspecao->status == "pendente") {
                array_push($inspecoesPendentes, $inspecao);
            } else {
                array_push($inspecoesConcluidas, $inspecao);
            }
        }

        $aviso = $token->remember_token;
        
        if($aviso == null){
            // dd($inspecoesConcluidas);
            return view('agente.home_agente',['pendente' => count($inspecoesPendentes), 'concluido' => count($inspecoesConcluidas), 'aviso' => 0]);
        }else{
            return view('agente.home_agente',['pendente' => count($inspecoesPendentes), 'concluido' => count($inspecoesConcluidas), 'aviso' => 1]);
        }
    }

    public function showRelatorio(Request $request){
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->inspecao))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->inspecao))->first();
        // dd($relatorio);
        if($relatorio == null){
            return view('agente/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }else{
            return view('agente/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }
    }

    public function showRelatorioVerificar(Request $request){
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->inspecao))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->inspecao))->first();
        // dd($relatorio);
        if($relatorio == null){
            return view('agente/verificar_relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }else{
            return view('agente/verificar_relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }
    }

    public function julgar(Request $request)
    {
        $agente = Agente::where('user_id','=',Auth::user()->id)->first();
        $inspecao = Inspecao::find($request->inspecao_id);
        $relatorio = InspecaoRelatorio::find($request->relatorio_id);

        if ($relatorio->status == 'reprovado') {
            return redirect()->route('show.programacao.agente')->with('message', 'Este relatório foi reprovado por outro agente!');
        }

        if ($request->decisao == 'true') {

            if ($agente->id == $relatorio->inspecao->agente1){
                $relatorio->agente1 = "aprovado";
                $relatorio->save();

                if($relatorio->agente1 == "aprovado" && $relatorio->agente2 == "aprovado" && $relatorio->coordenador == "aprovado"){
                    $relatorio->status = "aprovado";
                    $relatorio->save();

                    $inspecao->status = "aprovado";
                    $inspecao->save();

                    $empresa = Empresa::find($relatorio->inspecao->empresas_id);
                    $denuncias = Denuncia::where('empresa_id', $empresa->id)->update(['status' => 'Concluido']);

                    return redirect()->route('show.programacao.agente')->with('message', 'Relatório aprovado com sucesso!');
                }

                return redirect()->route('show.programacao.agente')->with('message', 'Relatório aprovado com sucesso!');
            }
            else {

                $relatorio->agente2 = "aprovado";
                $relatorio->save();

                if($relatorio->agente1 == "aprovado" && $relatorio->agente2 == "aprovado" && $relatorio->coordenador == "aprovado"){
                    $relatorio->status = "aprovado";
                    $relatorio->save();

                    $inspecao->status = "aprovado";
                    $inspecao->save();

                    $empresa = Empresa::find($relatorio->inspecao->empresas_id);
                    $denuncias = Denuncia::where('empresa_id', $empresa->id)
                    ->where('status', 'Acatado')
                    ->update(['status' => 'Concluido']);

                    return redirect()->route('show.programacao.agente')->with('message', 'Relatório aprovado com sucesso!');
                }

                return redirect()->route('show.programacao.agente')->with('message', 'Relatório aprovado com sucesso!');
            }

        } else {

            $relatorio->status = "reprovado";
            $relatorio->agente1 = "reprovado";
            $relatorio->agente2 = "reprovado";
            $relatorio->coordenador = "reprovado";
            $relatorio->save();

            return redirect()->route('show.programacao.agente')->with('message', 'Relatório Reprovado!');
        }
        
    }

    public function showProgramacao()
    {
        $agente = Agente::where('user_id','=',Auth::user()->id)->first();
        $inspAgentes = InspecAgente::where('agente_id',$agente->id)->get();
        $inspecoes = []; //Lista de objetos com inspeções e relatorios

        foreach ($inspAgentes as $indice) {
            $inspecao = Inspecao::find($indice->inspecoes_id);
            $relatorio = InspecaoRelatorio::where('inspecao_id', $inspecao->id)
            ->first();

            if ($inspecao->requerimento_id == null) {
                if ($relatorio != null) {
                    if ($agente->id == $relatorio->inspecao->agente1) {
                        $obj = (object) array(
                            'data'             => $inspecao->data,
                            'statusInspecao'   => $inspecao->status,
                            'motivoInspecao'   => $inspecao->motivo,
                            'inspetor_id'      => $inspecao->inspetor_id,
                            'requerimento_id'  => null,
                            'nomeEmpresa'      => $inspecao->empresa->nome,
            
                            'relatorio_id'     => $relatorio->id,
                            'inspecao_id'      => $inspecao->id,
                            'relatorio_status' => $relatorio->status,
                            'agente1'          => $relatorio->agente1,
                        );
                        array_push($inspecoes, $obj);
                    } else {
                        $obj = (object) array(
                            'data'             => $inspecao->data,
                            'statusInspecao'   => $inspecao->status,
                            'motivoInspecao'   => $inspecao->motivo,
                            'inspetor_id'      => $inspecao->inspetor_id,
                            'requerimento_id'  => null,
                            'nomeEmpresa'      => $inspecao->empresa->nome,
            
                            'relatorio_id'     => $relatorio->id,
                            'inspecao_id'      => $inspecao->id,
                            'relatorio_status' => $relatorio->status,
                            'agente2'          => $relatorio->agente2,
                        );
                        array_push($inspecoes, $obj);
                    }
                } else {
                    $obj = (object) array(
                        'data'             => $inspecao->data,
                        'statusInspecao'   => $inspecao->status,
                        'motivoInspecao'   => $inspecao->motivo,
                        'inspetor_id'      => $inspecao->inspetor_id,
                        'requerimento_id'  => null,
                        'nomeEmpresa'      => $inspecao->empresa->nome,
        
                        'relatorio_id'     => null,
                        'inspecao_id'      => $inspecao->id,
                    );
                    array_push($inspecoes, $obj);
                }
            }else {
                if ($relatorio != null) {
                    if ($agente->id == $relatorio->inspecao->agente1) {
                        $obj = (object) array(
                            'data'             => $inspecao->data,
                            'statusInspecao'   => $inspecao->status,
                            'motivoInspecao'   => $inspecao->motivo,
                            'inspetor_id'      => $inspecao->inspetor_id,
                            'cnae'             => $inspecao->requerimento->cnae->descricao,
                            'nomeEmpresa'      => $inspecao->empresa->nome,
            
                            'relatorio_id'     => $relatorio->id,
                            'inspecao_id'      => $inspecao->id,
                            'relatorio_status' => $relatorio->status,
                            'agente1'          => $relatorio->agente1,
                        );
                        array_push($inspecoes, $obj);
                    } else {
                        $obj = (object) array(
                            'data'             => $inspecao->data,
                            'statusInspecao'   => $inspecao->status,
                            'motivoInspecao'   => $inspecao->motivo,
                            'inspetor_id'      => $inspecao->inspetor_id,
                            'cnae'             => $inspecao->requerimento->cnae->descricao,
                            'nomeEmpresa'      => $inspecao->empresa->nome,
            
                            'relatorio_id'     => $relatorio->id,
                            'inspecao_id'      => $inspecao->id,
                            'relatorio_status' => $relatorio->status,
                            'agente2'          => $relatorio->agente2,
                        );
                        array_push($inspecoes, $obj);
                    }
                } else {
                    $obj = (object) array(
                        'data'             => $inspecao->data,
                        'statusInspecao'   => $inspecao->status,
                        'motivoInspecao'   => $inspecao->motivo,
                        'inspetor_id'      => $inspecao->inspetor_id,
                        'cnae'             => $inspecao->requerimento->cnae->descricao,
                        'nomeEmpresa'      => $inspecao->empresa->nome,
        
                        'relatorio_id'     => null,
                        'inspecao_id'      => $inspecao->id,
                    );
                    array_push($inspecoes, $obj);
                }
            }
        }

        return view('agente/programacao_agente', ['inspecoes' => $inspecoes]);
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

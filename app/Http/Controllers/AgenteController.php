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
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->first();

        if($relatorio == null){
            return view('agente/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }else{
            return view('agente/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }
    }

    public function julgar(Request $request)
    {
        $inspecao = Inspecao::find($request->inspecao_id);
        $relatorio = InspecaoRelatorio::find($request->relatorio_id);

        if ($relatorio->status == 'reprovado') {
            return redirect()->route('show.programacao.agente')->with('message', 'Este relatório foi reprovado por outro agente!');
        }

        if ($request->decisao == true) {

            // Incrementando o numero de avaliadores que aprovaram o relatorio
            $relatorio->num_aprovacao = $relatorio->num_aprovacao + 1;
            $relatorio->save();

            // Todos aprovaram o relatorio, logo o relatorio e a inspeção são concluidos
            if ($relatorio->num_aprovacao == $relatorio->num_avaliadores) {
                $relatorio->status = 'concluido';
                $relatorio->save();

                $inspecao->status = 'concluido';
                $inspecao->save();

                return redirect()->route('show.programacao.agente')->with('message', 'Este relatório foi aprovado por todos os avaliadores!');
            }

            return redirect()->route('show.programacao.agente')->with('message', 'Relatório Aprovado!');

        } else {

            // Reprovando o relatorio
            $relatorio->status = 'reprovado';
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
            ->where('status', 'avaliacao')
            ->first();

            if ($inspecao->requerimento_id == null) {
                if ($relatorio != null) {
                    $obj = (object) array(
                        'data'             => $inspecao->data,
                        'statusInspecao'   => $inspecao->status,
                        'motivoInspecao'   => $inspecao->motivo,
                        'inspetor_id'      => $inspecao->inspetor_id,
                        'requerimento_id'  => null,
                        'nomeEmpresa'      => $inspecao->empresa->nome,
        
                        'relatorio_id'     => $relatorio->id,
                        'inspecao_id'      => $inspecao->id,
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
        
                        'relatorio_id'     => null,
                        'inspecao_id'      => $inspecao->id,
                    );
                    array_push($inspecoes, $obj);
                }
            }else {
                if ($relatorio != null) {
                    $obj = (object) array(
                        'data'             => $inspecao->data,
                        'statusInspecao'   => $inspecao->status,
                        'motivoInspecao'   => $inspecao->motivo,
                        'inspetor_id'      => $inspecao->inspetor_id,
                        'cnae'             => $inspecao->requerimento->cnae->descricao,
                        'nomeEmpresa'      => $inspecao->empresa->nome,
        
                        'relatorio_id'     => $relatorio->id,
                        'inspecao_id'      => $inspecao->id,
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

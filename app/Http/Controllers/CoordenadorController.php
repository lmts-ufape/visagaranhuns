<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordenador;
use App\User;
use App\Agente;
use App\Inspetor;
use App\Empresa;
use App\Docempresa;
use App\Docresptec;
use App\Checklistemp;
use App\Checklistresp;
use App\Tipodocresp;
use App\Endereco;
use App\Telefone;
use App\CnaeEmpresa;
use App\Requerimento;
use App\RespTecnico;
use App\RtEmpresa;
use App\Inspecao;
use App\InspecAgente;
use App\InspecRequerimento;
use App\InspecaoRelatorio;
use App\InspecaoFoto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Illuminate\Support\Facades\Validator;
use App\Denuncia;
use App\Notificacao;

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
        // $denunciasAcatado     = Denuncia::where('status', 'Acatado')->get();
        $denunciasTotal       = Denuncia::all()->count();
        $denunciasArquivado   = Denuncia::where('status', 'Arquivado')->get();
        // $denunAcatado         = count($denunciasAcatado);
        $denunArquivado       = count($denunciasArquivado);

        $requerimentosAprovado  = Requerimento::where('status', 'aprovado')->get();
        $requerimentosReprovado = Requerimento::where('status', 'reprovado')->get();
        $requerimentosPendente  = Requerimento::where('status', 'pendente')->get();
        $reqAprovado  = count($requerimentosAprovado);
        $reqReprovado = count($requerimentosReprovado);
        $reqPendente  = count($requerimentosPendente);

        $inspecoesPendente      = Inspecao::where('status', 'pendente')->get();
        $inspecoesCompleta      = Inspecao::where('status', 'aprovado')->get();
        $inspecPendente         = count($inspecoesPendente);
        $inspecCompleta         = count($inspecoesCompleta);

        $empresasPendente      = Empresa::where('status_cadastro', 'pendente')->get();
        $empresasAprovada      = Empresa::where('status_cadastro', 'aprovado')->get();
        $empPendente           = count($empresasPendente);
        $empAprovada           = count($empresasAprovada);

        $notificacoesPendentes = Notificacao::where('status', 'pendente')->count();
        $notificacoesAprovadas = Notificacao::where('status', 'aprovado')->count();
              
        return view('coordenador.home_coordenador',
        ['denunciasTotal'        => $denunciasTotal,
        'denunciasArquivado'     => $denunArquivado,
        'requerimentosAprovado'  => $reqAprovado,
        'requerimentosReprovado' => $reqReprovado,
        'requerimentosPendente'  => $reqPendente,
        'inspecoesPendente'      => $inspecPendente,
        'inspecoesCompleta'      => $inspecCompleta,
        'empresasPendente'       => $empPendente,
        'empresasAprovada'       => $empAprovada,
        'notificacoesPendentes'  => $notificacoesPendentes,
        'notificacoesAprovadas'  => $notificacoesAprovadas,
        ]);
    }

    public function nameMethod()
    {
        $date = date('Y-m-d');

        $inspecoes = Inspecao::where('status', 'pendente')->where('data', $date)->get();
        // $inspecoes = Inspecao::where('status', 'pendente')->get();
        $inspecao = [];
        $empNome = [];
        $emps = [];

        foreach ($inspecoes as $key) {

            if ($key->motivo == "Primeira Licenca" || $key->motivo == "Renovacao") {

                $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
                $requerimento  = Requerimento::where('id', $key->requerimento_id)->first();
    
                $obj = (object) array(
                    'data'          => $key->data,
                    'status'        => $key->status,
                    'inspetor'      => $key->inspetor->user->name,
                    'agente1'        => $inspec_agente[0]->agente->user->name,
                    'agente2'        => $inspec_agente[1]->agente->user->name,
                    'empresa'       => $requerimento->empresa->nome,
                    'cnae'          => $requerimento->cnae->descricao,              
                );
                array_push($inspecao, $obj);

            } elseif ($key->motivo == "Denuncia") {

                $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
                $empresa = Empresa::find($key->empresas_id);
                
                $obj = (object) array(
                    'data'          => $key->data,
                    'status'        => $key->status,
                    'inspetor'      => $key->inspetor->user->name,
                    'agente1'        => $inspec_agente[0]->agente->user->name,
                    'agente2'        => $inspec_agente[1]->agente->user->name,
                    'empresa'       => $empresa->nome,
                    'cnae'          => "Denúncia",              
                );
                array_push($inspecao, $obj);
            }

        }
        // dd($inspecao);
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
                'email'      => $emp->email,
                'cnpjcpf'    => $emp->cnpjcpf,
                'tipo'       => $emp->tipo,
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
        $denunciasPendentes = Denuncia::where('status', 'pendente')->orderBy('empresa', 'ASC')->get();
        $denunciasAceito    = Denuncia::where('status', 'aceito')->orderBy('empresa', 'ASC')->get();
        $denunciasArquivado = Denuncia::where('status', 'arquivado')->orderBy('empresa', 'ASC')->get();

        return view('coordenador/denuncias', [
            'pendente' => $denunciasPendentes,
            'aceito'   => $denunciasAceito,
            'arquivado'=> $denunciasArquivado
        ]);
    }

    public function cadastrarInspecao(Request $request)
    {
        if (isset($request->requerimentos)) {
            foreach ($request->requerimentos as $indice) {
                $requerimento = Requerimento::find($indice);
                $inspecao = Inspecao::create([
                    'data'            => $request->data,
                    'status'          => 'pendente',
                    'inspetor_id'     => $request->inspetor,
                    'requerimento_id' => $indice,
                    'empresas_id'     => $requerimento->empresa->id,
                    'denuncias_id'    => null,
                    'motivo'          => $requerimento->tipo,
                    'agente1'         => $request->agente1,
                    'agente2'         => $request->agente2,
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
        }

        if (isset($request->denuncias)) {
            foreach ($request->denuncias as $indice) {
                $inspecao = Inspecao::create([
                    'data'            => $request->data,
                    'status'          => 'pendente',
                    'inspetor_id'     => $request->inspetor,
                    'empresas_id'     => null,
                    'denuncias_id'    => $indice,
                    'motivo'          => "Denuncia",
                    'agente1'         => $request->agente1,
                    'agente2'         => $request->agente2,
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
        }

        session()->flash('success', 'A inspeção foi cadastrada com sucesso e agora consta para a visualização dos agentes e inspetores.');
        return back();

    }

    public function documentosRt(Request $request)
    {
        // $rtId = Crypt::decrypt($request->rt_id);
        $rtId = Crypt::decrypt($request->rt_id);

        $rt = RespTecnico::find($rtId);
        $docsrt = Docresptec::where('resptecnicos_id', $rt->id)->get();
        $temp = [];
        $checkrespt = [];
        // $docsRt = [];

        $checklistresp = Checklistresp::where('resptecnicos_id', $rt->id)->orderBy('nomeDoc','ASC')->pluck('tipodocres_id');
        for ($i=0; $i < count($checklistresp); $i++) {
            array_push($temp, $checklistresp[$i]);
        }

        $array = array_unique($temp);

        foreach ($array as $indice) {
            array_push($checkrespt, Checklistresp::where('tipodocres_id', $indice)
            ->where('resptecnicos_id', $rt->id)->first());
        }

        $tipodocresp = Tipodocresp::all();

        // foreach ($checkrespt as $key) {
        //     foreach ($docsrt as $indice) {
        //         if ($key->tipodocres_id == $indice->tipodocresp_id && $key->resptecnicos_id == $indice->resptecnicos_id) {
        //             $obj = (object) array(
        //                 'nomeDoc'    => $key->nomeDoc,
        //                 'anexado'    => $key->anexado,
        //                 'caminho'    => $key->nome,
        //             );
        //             array_push($docsRt, $obj);
        //         }else {
        //             $obj = (object) array(
        //                 'nomeDoc'    => $key->nomeDoc,
        //                 'anexado'    => $key->anexado,
        //                 'caminho'    => null,
        //             );
        //             array_push($docsRt, $obj);
        //         }
        //     }
        // }

        return view('coordenador/documentos_rt',[
            'checklist' => $checkrespt,
            'tipodocs'  => $tipodocresp,
            'docsrt'    => $docsrt,
        ]);
    }

    public function baixarArquivosRt(Request $request)
    {
        return response()->download(storage_path('app/'.$request->file));
    }

    public function historico()
    {
        $inspecoes = Inspecao::all();
        $temp = [];
        
        foreach ($inspecoes as $key) {
            $relatorio = InspecaoRelatorio::where('inspecao_id', $key->id)->first();
            $notificacao = Notificacao::where('inspecoes_id', $key->id)->first();

            if ($key->motivo == "Primeira Licenca" || $key->motivo == "Renovacao") {

                $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
                $requerimento  = Requerimento::where('id', $key->requerimento_id)->first();

                if ($relatorio == null) {
                    $obj = (object) array(
                        'id'                => $key->id,
                        'data'              => $key->data,
                        'status'            => $key->status,
                        'inspetor'          => $key->inspetor->user->name,
                        'agente1'           => $inspec_agente[0]->agente->user->name,
                        'agente2'           => $inspec_agente[1]->agente->user->name,
                        'empresa'           => $requerimento->empresa->nome,
                        'cnae'              => $requerimento->cnae->descricao,
                        'motivo'            => $key->motivo,
    
                        'relatorio_id'      => null,
                        'relatorio_status'  => null,
                        'notificacao_id'    => null,
                        'notificacao_status'=> null,
                    );
                    array_push($temp, $obj);
                } else {
                    if ($notificacao != null) {
                        $obj = (object) array(
                            'id'                  => $key->id,
                            'data'                => $key->data,
                            'status'              => $key->status,
                            'inspetor'            => $key->inspetor->user->name,
                            'agente1'             => $inspec_agente[0]->agente->user->name,
                            'agente2'             => $inspec_agente[1]->agente->user->name,
                            'empresa'             => $requerimento->empresa->nome,
                            'cnae'                => $requerimento->cnae->descricao,
                            'motivo'              => $key->motivo,
        
                            'relatorio_id'        => $relatorio->id,
                            'relatorio_status'    => $relatorio->status,
                            'coordenador'         => $relatorio->coordenador,
                            'notificacao_id'      => $notificacao->id,
                            'notificacao_status'  => $notificacao->status,
                        );
                        array_push($temp, $obj);
                    } else {
                        $obj = (object) array(
                            'id'              => $key->id,
                            'data'            => $key->data,
                            'status'          => $key->status,
                            'inspetor'        => $key->inspetor->user->name,
                            'agente1'         => $inspec_agente[0]->agente->user->name,
                            'agente2'         => $inspec_agente[1]->agente->user->name,
                            'empresa'         => $requerimento->empresa->nome,
                            'cnae'            => $requerimento->cnae->descricao,
                            'motivo'          => $key->motivo,
        
                            'relatorio_id'    => $relatorio->id,
                            'relatorio_status'=> $relatorio->status,
                            'coordenador'     => $relatorio->coordenador,
                            'notificacao_id'      => null,
                            'notificacao_status'  => null,
                        );
                        array_push($temp, $obj);
                    }
                }

            } elseif ($key->motivo == "Denuncia") {

                $inspec_agente = InspecAgente::where('inspecoes_id', $key->id)->get();
                // Sem identificação de empresa no sistema
                // $empresa = Empresa::find($key->empresas_id);

                if ($relatorio == null) {
                    $obj = (object) array(
                        'id'                => $key->id,
                        'data'              => $key->data,
                        'status'            => $key->status,
                        'inspetor'          => $key->inspetor->user->name,
                        'agente1'           => $inspec_agente[0]->agente->user->name,
                        'agente2'           => $inspec_agente[1]->agente->user->name,
                        'empresa'           => $key->denuncia->empresa,
                        'cnae'              => "",
                        'motivo'            => $key->motivo,
                        
                        'relatorio_id'      => null,
                        'relatorio_status'  => null,
                        'notificacao_id'    => null,
                        'notificacao_status'=> null,
                    );
                    array_push($temp, $obj);
                } else {
                    if ($notificacao != null) {
                        $obj = (object) array(
                            'id'                 => $key->id,
                            'data'               => $key->data,
                            'status'             => $key->status,
                            'inspetor'           => $key->inspetor->user->name,
                            'agente1'            => $inspec_agente[0]->agente->user->name,
                            'agente2'            => $inspec_agente[1]->agente->user->name,
                            'empresa'            => $key->denuncia->empresa,
                            'cnae'               => "",
                            'motivo'             => $key->motivo,
                            
                            'relatorio_id'       => $relatorio->id,
                            'relatorio_status'   => $relatorio->status,
                            'coordenador'        => $relatorio->coordenador,
                            'notificacao_id'     => $notificacao->id,
                            'notificacao_status' => $notificacao->status,
                        );
                        array_push($temp, $obj);
                    } else {
                        $obj = (object) array(
                            'id'                 => $key->id,
                            'data'               => $key->data,
                            'status'             => $key->status,
                            'inspetor'           => $key->inspetor->user->name,
                            'agente1'            => $inspec_agente[0]->agente->user->name,
                            'agente2'            => $inspec_agente[1]->agente->user->name,
                            'empresa'            => $key->denuncia->empresa,
                            'cnae'               => "",
                            'motivo'             => $key->motivo,
                            
                            'relatorio_id'       => $relatorio->id,
                            'relatorio_status'   => $relatorio->status,
                            'coordenador'        => $relatorio->coordenador,
                            'notificacao_id'     => null,
                            'notificacao_status' => null,
                        );
                        array_push($temp, $obj);
                    }
                }
            }
        }
        
        return view('coordenador.historico_inspecao')->with([
            "inspecoes" => $temp,
        ]);

    }

    public function showRelatorio(Request $request)
    {
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->first();

        if($relatorio == null){
            return view('coordenador/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao_id), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }else{
            return view('coordenador/relatorio',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao_id), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }
    }

    public function showRelatorioVerificar(Request $request)
    {
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->inspecao_id))->first();

        if($relatorio == null){
            return view('coordenador/relatorio_verificar',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao_id), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }else{
            return view('coordenador/relatorio_verificar',['album' => $resultado, 'inspecao_id' => Crypt::decrypt($request->inspecao_id), 'relatorio' => $relatorio->relatorio, 'relatorio_id' => $relatorio->id]);
        }
    }

    public function showNotificacao(Request $request)
    {
        $notificacao = Notificacao::where('inspecoes_id','=', Crypt::decrypt($request->inspecaoId))->orderBy('created_at','ASC')->first();

        if($notificacao == null){
            return view('coordenador/notificacao',['inspecao_id' => Crypt::decrypt($request->inspecaoId), 'notificacao' => $notificacao->notificacao]);
        }else{
            return view('coordenador/notificacao',['inspecao_id' => Crypt::decrypt($request->inspecaoId), 'notificacao' => $notificacao->notificacao]);
        }
    }

    public function showNotificacaoVerificar(Request $request)
    {

        $notificacao = Notificacao::where('inspecoes_id','=', Crypt::decrypt($request->inspecaoId))->first();

        if($notificacao == null){
            return view('coordenador/notificacao_verificar',['inspecao_id' => Crypt::decrypt($request->inspecaoId), 'notificacao' => $notificacao->notificacao]);
        }else{
            return view('coordenador/notificacao_verificar',['inspecao_id' => Crypt::decrypt($request->inspecaoId), 'notificacao' => $notificacao->notificacao]);
        }
    }

    public function julgarNotificacao(Request $request)
    {

        $notificacao = Notificacao::where('inspecoes_id', $request->inspecao_id)->first();

        if ($request->decisao == 'true') {

            $notificacao->status = 'aprovado';
            $notificacao->save();

            return redirect()->route('historico.inspecoes')->with('message', 'Notificação aprovada com sucesso!');

        } else {

            $notificacao->status = 'reprovado';
            $notificacao->save();

            return redirect()->route('historico.inspecoes')->with('message', 'Notificação reprovada!');
        }
    }

    public function julgarRelatorio(Request $request)
    {

        $inspecao = Inspecao::find($request->inspecao_id);
        $relatorio = InspecaoRelatorio::find($request->relatorio_id);

        if ($relatorio->status == 'reprovado') {
            return redirect()->route('historico.inspecoes')->with('message', 'Este relatório foi reprovado por outro agente ou coordenador!');
        }

        if ($request->decisao == true) {

            $relatorio->coordenador = "aprovado";
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

                return redirect()->route('historico.inspecoes')->with('message', 'Relatório aprovado com sucesso!');
            }

            return redirect()->route('historico.inspecoes')->with('message', 'Relatório aprovado com sucesso!');

        } else {

            // Reprovando o relatorio
            $relatorio->status = 'reprovado';
            $relatorio->save();

            $relatorio->status = "reprovado";
            $relatorio->agente1 = "reprovado";
            $relatorio->agente2 = "reprovado";
            $relatorio->coordenador = "reprovado";
            $relatorio->save();

            return redirect()->route('historico.inspecoes')->with('message', 'Relatório Reprovado!');
        }
        
    }



    public function deletarInspecao(Request $request)
    {
        $id = Crypt::decrypt($request->inspecaoId);
        $inspecao = Inspecao::find($id);

        $inspAgente = InspecAgente::where('inspecoes_id', $inspecao->id)->delete();

        if ($inspecao == null || $inspAgente == null) {
            session()->flash('error', 'Inspeção não encontrada ou Agente por inspeção não encontrado!');
            return back();
        }

        $inspecao->delete();

        session()->flash('success', 'A inspeção foi apagada com sucesso.');
        return back();
    }

    public function requerimentosAprovados()
    {
        $resultados = Requerimento::where('status', 'aprovado')->get();
        $denuncia = Denuncia::where('status', 'aceito')->get();
        $temp = [];
        $empresas = [];
        $denuncias = [];
        $resultado = [];

        foreach ($resultados as $indice) {
            $inspecao = Inspecao::where('requerimento_id', $indice->id)->first();
            if ($inspecao == null) {
                array_push($resultado, $indice);
            }
        }

        foreach ($denuncia as $indice) {
            $inspecao = Inspecao::where('denuncias_id', $indice->id)->first();
            if ($inspecao == null) {
                array_push($denuncias, $indice);
            }
        }

        // foreach ($denuncia as $indice) {
        //     $inspecao = Inspecao::where('requerimento_id', null)
        //     ->where('empresas_id', $indice->empresa_id)
        //     ->where('status', 'pendente')
        //     ->first();
        //     if ($inspecao == null) {
        //         array_push($denuncias, $indice);
        //     }
        // }

        // foreach ($denuncias as $indice) {

        //     if (count($temp) == 0) {
        //         $obj = (object) array(
        //             'nome'  => $indice->empresa->nome,
        //             'id'    => $indice->empresa->id,
        //         );
        //         array_push($temp, $obj);   
        //     }
        //     else {
        //         $found = false;
        //         foreach ($temp as $indice2) {
        //             if ($indice->empresa->nome == $indice2->nome) {
        //                 $found = true;
        //                 break;
        //             }
        //         }
        //         if ($found == false) {
        //             $obj = (object) array(
        //                 'nome'  => $indice->empresa->nome,
        //                 'id'    => $indice->empresa->id,
        //             );
        //             array_push($temp, $obj);
        //         }
        //     }
        // }

        // foreach ($temp as $key) {
        //     $empresa = Empresa::find($key->id);
        //     array_push($empresas,$empresa);
        // }

        $output = '';
            if(count($resultado) > 0){
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
            }
            if(isset($denuncias)){
                foreach($denuncias as $indice){
                    $output .= '
                    <div class="d-flex justify-content-center cardMeuCnae" onmouseenter="mostrarBotaoAdicionarDenuncia('.$indice->id.')">
                        <div class="mr-auto p-2>OPA</div>
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo" id="empresa'.$indice->id.'">'.$indice->empresa.'</div>
                                        <div>Tipo: <span class="textoCampo">Denúncia</span></div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:140px; height:25px; text-align:right;">
                                <div id="cardSelecionadoDenuncia'.$indice->id.'" class="btn-group" style="display:none;">
                                    <div class="btn btn-success btn-sm"  onclick="addDenuncia('.$indice->id.')" >Adicionar</div>
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
        $inspecoes = Inspecao::all();

        return view("coordenador/avaliar_denuncias")->with([
            "empresa"   => $empresa,
            "denuncias" => $denuncias,
            "inspecoes" => $inspecoes,
        ]);
    }

    public function avaliarDenuncia(Request $request)
    {

        if ($request->decisao == "true") {

            $denuncia = Denuncia::find($request->denunciaId);
            $denuncia->status = "aceito";
            $denuncia->save();

            session()->flash('success', 'Denúncia acatada com sucesso!');
            return back();
            // return redirect()->route('pagina.detalhes.denuncia', ['empresa' => $request->empresa]);

        } elseif ($request->decisao == "false") {

            $denuncia = Denuncia::find($request->denunciaId);
            $denuncia->status = "arquivado";
            $denuncia->save();

            session()->flash('success', 'Denúncia arquivada com sucesso!');
            return back();
            // return redirect()->route('pagina.detalhes.denuncia', ['empresa' => $request->empresa]);
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

                // session()->flash('success', 'Cadastros aprovados com sucesso');
                return view('coordenador/requerimento_coordenador')->with('aprovado', 'Este cadastro foi aprovado com sucesso!');
                // return redirect()->route('/');
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

                // $empresa->status_cadastro = "reprovado";
                // $useremail->status_cadastro = "reprovado";
                // $empresa->save();
                // $useremail->save();

                $cnaeEmpresas = CnaeEmpresa::where('empresa_id', $empresa->id)->delete();
                $checklistemp = Checklistemp::where('empresa_id', $empresa->id)->delete();
                $telefones = Telefone::where('empresa_id', $empresa->id)->delete();
                $enderecos = Endereco::where('empresa_id', $empresa->id)->delete();
                $empresa->delete();
                $useremail->delete();

                // session()->flash('success', 'Cadastros reprovados com sucesso');
                return view('coordenador/requerimento_coordenador')->with('reprovado', 'Este cadastro foi reprovado com sucesso!');
                // return redirect()->route('/');
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

                return view('coordenador/requerimento_coordenador')->with('aprovado', 'Este cadastro foi aprovado com sucesso!');
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

                $cnaeEmpresas = CnaeEmpresa::where('empresa_id', $empresa->id)->delete();
                $checklistemp = Checklistemp::where('empresa_id', $empresa->id)->delete();
                $telefones = Telefone::where('empresa_id', $empresa->id)->delete();
                $enderecos = Endereco::where('empresa_id', $empresa->id)->delete();
                $empresa->delete();

                return view('coordenador/requerimento_coordenador')->with('reprovado', 'Este cadastro foi reprovado com sucesso!');
            }

        }
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

    public function listarRts()
    {
        $rtempresa = RtEmpresa::orderBy('empresa_id', 'ASC')->get();
        $respTecnico = RespTecnico::orderBy('id', 'ASC')->paginate(50);
        $respTecnicos = [];

        foreach ($rtempresa as $key) {
            foreach ($respTecnico as $indice) {
                if ($indice->id == $key->resptec_id) {
                    $obj = (object) array(
                        'nome'           => $indice->user->name,
                        'formacao'       => $indice->formacao,
                        'especializacao' => $indice->especializacao,
                        'cpf'            => $indice->cpf,
                        'telefone'       => $indice->telefone,
                        'nomeEmpresa'    => $key->empresa->nome,
                    );
                    array_push($respTecnicos, $obj);
                }
            }
        }

        // dd($respTecnicos);
        
        return view('coordenador/rts_coordenador', ['rts' => $respTecnicos]);
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
                    <div class="container cardListagem" id="primeiralicenca" style="margin-bottom:30px;">
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
                        <div class="container cardListagem" id="primeiralicenca" style="margin-bottom:20px;">
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
                        <div class="container cardListagem" id="primeiralicenca" style="margin-bottom:31px;">
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
                                            <div class="form-group" style="font-size:15px; margin-top: 10px;">
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
                    <div class="container cardListagem" style="margin-bottom:30px;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo">'.$item->empresa->nome.'</div>
                                        <span>Renovação de Licença</span>
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
                    <div class="container cardListagem" style="margin-bottom:30px;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group" style="margin-bottom:-15px;">
                                    <div class="form-group" style="font-size:15px;">
                                        <div class="textoCampo">'.$item->empresa->nome.'</div>
                                        <span>Renovação de Licença</span>
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

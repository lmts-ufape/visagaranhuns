<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servico;
use App\Secao;
use Illuminate\Support\Facades\Crypt;

class ServicoController extends Controller
{
    public function index(){
        $resultado = Servico::orderBy('posicao', 'ASC')->get();
        return view('coordenador/gerenciar_conteudo/config_pagina_inicial',["servicos"=>$resultado]);
    }
    public function ajaxCriarServico(Request $request){
        $resultado = Servico::create(['titulo'=>"$request->titulo",'posicao'=>Servico::count()+1]);
        $this->listarServicos($resultado->save());
    }
    public function ajaxDeletarServico(Request $request){
        // !! preciso usar softdelete
        $resultadoSecao = Secao::where('servico_id','=',$request->id)->get();
        foreach($resultadoSecao as $item){
            $item->delete();
        }

        $resultado = Servico::where('id','=',$request->id)->first();
        $resultado->delete();

        //recontagem das posicoes
        $recontagem = Servico::get();
        $cont=1;
        foreach($recontagem as $item){
            $item->posicao = $cont;
            $item->save();
            $cont=$cont+1;
        }
        $this->listarServicos(true);
    }
    public function ajaxEditarServico(Request $request){
        $resultado = Servico::where('id','=',$request->id)->first();
        $resultado->titulo = $request->titulo;
        $this->listarServicos($resultado->save());
    }
    public function ajaxEditarSubirServico(Request $request){
        $idAtual = $request->id;
        $posicaoAtual = $request->posicao;

        if($posicaoAtual>1 && Servico::count()>1){
            //posicao anterior
            $resultadoAnterior = Servico::where('posicao','=',$posicaoAtual-1)->first();
            $resultadoAnterior->posicao =$posicaoAtual;
            $resultadoAnterior->save();
            //minha posicao
            $resultadoAtual = Servico::where('id','=',$idAtual)->first();
            $resultadoAtual->posicao =$posicaoAtual-1;
            $resultadoAtual->save();
            //atualizar lista
            $this->listarServicos(true);
        }
    }
    public function ajaxEditarDescerServico(Request $request){
        $idAtual = $request->id;
        $posicaoAtual = $request->posicao;

        if($posicaoAtual != Servico::count()){
            //posicao posterior
            $resultadoPosterior = Servico::where('posicao','=',$posicaoAtual+1)->first();
            $resultadoPosterior->posicao =$posicaoAtual;
            $resultadoPosterior->save();
            //minha posicao
            $resultadoAtual = Servico::where('id','=',$idAtual)->first();
            $resultadoAtual->posicao =$posicaoAtual+1;
            $resultadoAtual->save();
            //atualizar lista
            $this->listarServicos(true);
        }
    }
    private function listarServicos($save){
        $resultado = Servico::orderBy('posicao', 'ASC')->get();
        $output = '';
        $cont=1;
            foreach($resultado as $item){
                // $titulo = $item->titulo;
                $output .= '
                    <tr>
                        <th>
                            <div class="btn-group">
                                <label style="margin-right:5px; margin-top:1.5px;">'.$cont.'</label>
                                <div class="form-group">
                                    <a style="cursor:pointer;" onclick="subirPosicaoServico('.$item->id.','.$item->posicao.')"><img src="'.asset('/imagens/logo_subir.png').'" alt="Logo" width="14px"/></a>
                                    <a style="cursor:pointer;" onclick="descerPosicaoServico('.$item->id.','.$item->posicao.')"><img src="'.asset('/imagens/logo_descer.png').'" alt="Logo" width="14px"/></a>
                                </div>

                            </div>
                        </th>
                        <td><a href='.route('secao.index','id='.Crypt::encrypt($item->id)).'>'.$item->titulo.'</a></td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm" style="margin-right:10px;" onclick="editarServicoModal('.$item->id.',\''."$item->titulo".'\');" data-toggle="modal" data-target="#editarServicoModal">
                                    <img src="'.asset('/imagens/logo_editar.png').'" alt="Logo" width="17px"/>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deletarServicoModal('.$item->id.',\''."$item->titulo".'\')" data-toggle="modal" data-target="#deletarServicoModal">
                                    <img src="'.asset('/imagens/logo_lixo.png') .'" alt="Logo" width="15px"/>
                                </button>
                            </td>
                    </tr>';
                $cont=$cont+1;
            }
        $data = array(
            'success'      => $save,
            'table_data'   => $output,
        );
        echo json_encode($data);
    }

    /*
    *   Funções da tela de seção
    *
    */
    public function indexSecao(Request $request){
        $resultadoServico = Servico::where('id','=',Crypt::decrypt($request->id))->first();
        $resultado = Secao::where('servico_id','=',Crypt::decrypt($request->id))->orderBy('posicao', 'ASC')->get();
        return view('coordenador/config_secao',["secaos"=>$resultado, "titulo" =>$resultadoServico->titulo, "id"=>Crypt::decrypt($request->id)]);
        // dd(Crypt::decrypt($request->id));
    }
    public function ajaxCriarSecao(Request $request){
        $resultado = Secao::create(['servico_id'=>$request->servico_id,'titulo'=>"$request->titulo",'descricao'=>$request->descricao,'posicao'=>Secao::count()+1]);
        $this->listarSecao($resultado->save(), $request->servico_id);
    }
    public function ajaxEditarSecao(Request $request){
        $resultado = Secao::where('id','=',$request->id_secao)->first();
        $resultado->titulo = $request->titulo;
        $resultado->descricao = $request->descricao;
        $this->listarSecao($resultado->save(), $resultado->servico_id);
    }
    public function ajaxDeletarSecao(Request $request){
        $resultado = Secao::where('id','=',$request->id_secao)->first();
        //recontagem das posicoes
        // $recontagem = Secao::get();
        // $cont=1;
        // foreach($recontagem as $item){
        //     $item->posicao = $cont;
        //     $item->save();
        //     $cont=$cont+1;
        // }
        $this->listarSecao($resultado->delete(), $resultado->servico_id);
    }
    private function listarSecao($save, $servico_id){
        $resultado = Secao::where('servico_id','=',$servico_id)->orderBy('posicao', 'ASC')->get();
        $output = '';
        $cont=1;
            foreach($resultado as $item){
                $output .= '
                    <tr>
                        <th>
                            <div class="btn-group">
                                <label style="margin-right:5px; margin-top:1.5px;">'.$cont.'</label>
                                <div class="form-group">
                                </div>

                            </div>
                        </th>
                        <td>'.$item->titulo.'</a></td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm" style="margin-right:10px;" onclick="editarSecaoModal('.$item->id.',\''."$item->titulo".'\',\''."$item->descricao".'\');" data-toggle="modal" data-target="#editarSecaoModal">
                                    <img src="'.asset('/imagens/logo_editar.png').'" alt="Logo" width="17px"/>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deletarSecaoModal('.$item->id.',\''."$item->titulo".'\',\''."$item->descricao".'\')" data-toggle="modal" data-target="#deletarSecaoModal">
                                    <img src="'.asset('/imagens/logo_lixo.png') .'" alt="Logo" width="15px"/>
                                </button>
                            </td>
                    </tr>';
                $cont=$cont+1;
            }
        $data = array(
            'success'      => $save,
            'table_data'   => $output,
        );
        echo json_encode($data);
    }
    public function homeInformacoes(Request $request){
        $resultado = Secao::where('servico_id','=',Crypt::decrypt($request->value))->orderBy('posicao', 'ASC')->get();
        $titulo = Servico::where('id','=',Crypt::decrypt($request->value))->first();
        return view('naoLogado/informacoes_naoLogado',["secoes"=>$resultado, "titulo"=>$titulo->titulo]);

    }
    public function homeOutrasInformacoes(){
        $resultado = Servico::orderBy('posicao', 'ASC')->get();
        return view('naoLogado/outros_servicos_naoLogado',["servicos"=>$resultado]);

    }

}

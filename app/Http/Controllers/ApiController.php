<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Inspecao;
use App\Inspetor;
use App\Endereco;
use App\Telefone;
use App\InspecaoFoto;
use App\Requerimento;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Svg\Tag\Rect;
use Intervention\Image\ImageManagerStatic as Image;

class ApiController extends Controller
{
    /*
    *   FUNCAO: Funcao para verificar se o usuario esta cadastrado no sistema
    *   ENTRADA: email, senha
    *   RETURN: id, nome, email e senha
    */
    public function apiLogin(Request $request){
        $resultados = User::where('email','=',$request->email)->get();
        $output = '';
        $status = 'false';
        $token = '';
        foreach($resultados as $item){
            if(Hash::check($request->password ,$item->password) == true){
                $output =  $resultados;
                $token = Str::random(60);
                $status = 'true';

                $resultadoAtual = User::where('email','=',$request->email)->first();
                $resultadoAtual->remember_token = $token;
                $resultadoAtual->save();
            }
        }
        $data = array(
            'success'   => $status,
            'table_data' => $output,
            'token' => $token,
        );
        echo json_encode($data);
    }
    /*
    *   FUNCAO: Funcao para atualizar o token
    *   ENTRADA: token
    *   RETURN: token
    */
    public function apiRefresh(Request $request){
        $resultados = User::where('remember_token','=',$request->token)->first();
        $output = '';
        $status = 'false';
        $token = '';
        if(isset($resultados)==1){
            $output =  $resultados;
            $token = Str::random(60);
            $status = 'true';

            $resultadoAtual = User::where('remember_token','=',$request->token)->first();
            $resultadoAtual->remember_token = $token;
            $resultadoAtual->save();
        }
        $data = array(
            'success'   => $status,
            'table_data' => $output,
            'token' => $token,
        );
        echo json_encode($data);
    }
    /*
    *   FUNCAO: Funcao para baixar as inspecoes
    *   ENTRADA: token
    *   RETURN: lista de inspecoes
    */
    public function apiDonwloadInspecoes(Request $request){
        $user = User::where('remember_token','=',$request->token)->first();
        $inspetor = Inspetor::where('user_id','=',$user->id)->first();
        $inspecoes = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();
        $temp = [];

        foreach ($inspecoes as $indice) {
            $endereco = Endereco::where('empresa_id', $indice->requerimento->empresa->id)
            ->first();
            $telefone = Telefone::where('empresa_id', $indice->requerimento->empresa->id)
            ->first();

            $obj = (object) array(
                'empresa_nome'  => $indice->requerimento->empresa->nome,
                'rua'           => $endereco->rua,
                'numero'        => $endereco->numero,
                'bairro'        => $endereco->bairro,
                'cep'           => $endereco->cep,
                'cnpjcpf'          => $indice->requerimento->empresa->cnpjcpf,
                'representante_legal' => $indice->requerimento->empresa->user->name,
                'telefone1'     => $telefone->telefone1,
                'telefone2'     => $telefone->telefone2,
                'email'         => $indice->requerimento->empresa->email,
                'data'          => $indice->data,
                'status'        => $indice->status,
                'tipo'          => $indice->requerimento->tipo,
                'descricao'     => $indice->requerimento->cnae->descricao,
                'inspecao_id'   => $indice->id,
            );
            array_push($temp, $obj);
        }
        $data = array(
            'success'   => 'true',
            'table_data' => $temp,
        );
        return $data;
    }
    /*
    *   FUNCAO: Salvar imagem da inspecao
    *   ENTRADA: inspecao_id, imagem
    *   RETURN: confirmacao que a imagem foi salva
    */
    public function apiSaveImg(Request $request){

        $destinationPath = public_path('imagens/inspecoes');
        $image1=$request->photo;
        $_image1 = rand().'.jpeg';
        $image1->move($destinationPath,$_image1);

        $fotoDaInspecao = new InspecaoFoto;
        $fotoDaInspecao->imagemInspecao = $_image1;
        $fotoDaInspecao->inspecao_id = $request->id;
        $fotoDaInspecao->orientation = $request->orientation;
        $fotoDaInspecao->descricao = "";
        $fotoDaInspecao->save();

    }
}

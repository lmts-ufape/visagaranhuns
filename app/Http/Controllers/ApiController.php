<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Checklistemp;
use App\Denuncia;
use Illuminate\Http\Request;
use App\User;
use App\Inspecao;
use App\Inspetor;
use App\Endereco;
use App\Telefone;
use App\Empresa;
use App\InspecaoFoto;
use App\Docempresa;
use App\InspecAgente;
use App\Requerimento;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Svg\Tag\Rect;
use Intervention\Image\ImageManagerStatic as Image;
use stdClass;

class ApiController extends Controller
{
    /*
    *   FUNCAO: Funcao para verificar se o usuario esta cadastrado no sistema
    *   ENTRADA: email, senha
    *   RETURN: id, nome, email e senha
    */
    /*public function apiLogin(Request $request){
        $resultados = User::where('email','=',$request->email)->get();
        $output = '';
        $status = 'false';
        $token = '';
        foreach($resultados as $item){
            if(Hash::check($request->password ,$item->password) == true && $item->tipo == "inspetor"){
                $output =  $resultados;
                $token = Str::random(60);
                $status = 'true';

                $resultadoAtual = User::where('email','=',$request->email)->first();
                $resultadoAtual->remember_token = $token;
                $resultadoAtual->save();


                //  inspecoes
        $user = User::where('remember_token','=',$token)->first();
        $inspetor = Inspetor::where('user_id','=',$user->id)->first();
        $inspecoes = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();
        $listaDeInspecoes = [];
        foreach ($inspecoes as $indice) {
            $endereco = Endereco::where('empresa_id', $indice->requerimento->empresa->id)
            ->first();
            $telefone = Telefone::where('empresa_id', $indice->requerimento->empresa->id)
            ->first();


                    //documentos
                    $docsempresa = Docempresa::where('empresa_id', $indice->requerimento->empresa->id)->where('area', $indice->requerimento->cnae->areas_id)->get();
                    $listaDocumentos = [];
                    foreach ($docsempresa as $indicedoc) {
                        $obj2 = (object) array(
                            'inspecao_id'   => $indice->id,
                            'nome'      =>  $indicedoc->tipodocemp->nome,
                            'caminho'   =>  $indicedoc->nome,
                            'data_emissao'=> $indicedoc->data_emissao,
                            'data_validade'=> $indicedoc->data_validade,
                        );
                        array_push($listaDocumentos, $obj2);
                    }

                    //album de fotos (foto e comentario)
                    $resultado = InspecaoFoto::where('inspecao_id','=',$indice->id)->orderBy('created_at', 'ASC')->get();
                    $albumDeFotos = [];
                    foreach($resultado as $item){
                        $objFoto = (object) array(
                            'inspecao_id'           => $item->inspecao_id,
                            'imagemInspecao'        => $item->imagemInspecao,
                            'nome'                  => $item->nome,
                            'orientation'           => $item->orientation,
                            'descricao'             => $item->descricao,
                        );
                        array_push($albumDeFotos, $objFoto);
                    }



                $obj = array(
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
                    'listaDocumentos'=> $listaDocumentos,
                    'albumDeFotos'=> $albumDeFotos,
                );
                array_push($listaDeInspecoes, $obj);
                $listaDocumentos = [];
                $albumDeFotos = [];
            }
            $data = array(
                'success'   => $status,
                'table_data' => $output,
                'token' => $token,
                'inspecoes' => $listaDeInspecoes,
                'documentos' => 0,
            );
            echo json_encode($data);


            }else{
                $data = array(
                    'success'   => "false",
                    'table_data' => '',
                    'token' => '',
                    'inspecoes' => '',
                    'documentos' => '',
                );
                echo json_encode($data);
                break;
            }
        }


    }
    */
    public function apiLogin(Request $request)
    {
        $resultados = User::where('email', '=', $request->email)->get();
        $output = '';
        $status = 'false';
        $token = '';
        foreach ($resultados as $item) {
            if (Hash::check($request->password, $item->password) == true && $item->tipo == "inspetor") {
                $output =  $resultados;
                $token = Str::random(60);
                $status = 'true';

                $resultadoAtual = User::where('email', '=', $request->email)->first();
                $resultadoAtual->remember_token = $token;
                $resultadoAtual->save();

                $request->token = $token;

                $inspecoes = $this->getAllInspecao($request);

                $data = array(
                    'success'   => $status,
                    'table_data' => $output,
                    'token' => $token,
                    'inspecoes' => $inspecoes,
                    'documentos' => 0,
                );

                echo json_encode($data);
            } else {

                $data = array(
                    'success'   => "false",
                    'table_data' => '',
                    'token' => '',
                    'inspecoes' => '',
                    'documentos' => '',
                );
                echo json_encode($data);
                break;
            }
        }
    }

    /*
    *   FUNCAO: Funcao para atualizar o token
    *   ENTRADA: token
    *   RETURN: token
    */
    public function apiRefresh(Request $request)
    {
        $resultados = User::where('remember_token', '=', $request->token)->first();
        $output = '';
        $status = 'false';
        $token = '';
        if (isset($resultados) == 1) {
            $output =  $resultados;
            $token = Str::random(60);
            $status = 'true';

            $resultadoAtual = User::where('remember_token', '=', $request->token)->first();
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
    public function apiDonwloadInspecoes(Request $request)
    {
        $data = $this->getAllInspecao($request);
        return $data;
    }

    public function apiDonwloadInspecoesAgente(Request $request)
    {

        $user = User::where('remember_token', '=', $request->token)->first();
        $agente = Agente::where('user_id', '=', $user->id)->first();
        $inspecAgentes = InspecAgente::where('agente_id', $agente->id)->orderBy('id', 'ASC')->get();
        // $inspecoes = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();
        $temp = [];

        foreach ($inspecAgentes as $indice) {
            if ($indice->inspecao->requerimento_id == null) {
                $endereco = Endereco::where('empresa_id', $indice->inspecao->empresa->id)
                    ->first();
                $telefone = Telefone::where('empresa_id', $indice->inspecao->empresa->id)
                    ->first();

                $obj = (object) array(
                    'empresa_nome'  => $indice->inspecao->empresa->nome,
                    'rua'           => $endereco->rua,
                    'numero'        => $endereco->numero,
                    'bairro'        => $endereco->bairro,
                    'cep'           => $endereco->cep,
                    'cnpjcpf'          => $indice->inspecao->empresa->cnpjcpf,
                    'representante_legal' => $indice->inspecao->empresa->user->name,
                    'telefone1'     => $telefone->telefone1,
                    'telefone2'     => $telefone->telefone2,
                    'email'         => $indice->inspecao->empresa->email,
                    'data'          => $indice->inspecao->data,
                    'status'        => $indice->inspecao->status,
                    'tipo'          => $indice->inspecao->motivo,
                    // 'descricao'     => $indice->requerimento->cnae->descricao,
                    'inspecao_id'   => $indice->inspecao->id,
                );
                array_push($temp, $obj);
            } else {
                $endereco = Endereco::where('empresa_id', $indice->inspecao->requerimento->empresa->id)
                    ->first();
                $telefone = Telefone::where('empresa_id', $indice->inspecao->requerimento->empresa->id)
                    ->first();

                $obj = (object) array(
                    'empresa_nome'  => $indice->inspecao->requerimento->empresa->nome,
                    'rua'           => $endereco->rua,
                    'numero'        => $endereco->numero,
                    'bairro'        => $endereco->bairro,
                    'cep'           => $endereco->cep,
                    'cnpjcpf'          => $indice->inspecao->requerimento->empresa->cnpjcpf,
                    'representante_legal' => $indice->inspecao->requerimento->empresa->user->name,
                    'telefone1'     => $telefone->telefone1,
                    'telefone2'     => $telefone->telefone2,
                    'email'         => $indice->inspecao->requerimento->empresa->email,
                    'data'          => $indice->inspecao->data,
                    'status'        => $indice->inspecao->status,
                    'tipo'          => $indice->inspecao->requerimento->tipo,
                    'descricao'     => $indice->inspecao->requerimento->cnae->descricao,
                    'inspecao_id'   => $indice->inspecao->id,
                );
                array_push($temp, $obj);
            }
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
    public function apiSaveImg(Request $request)
    {
        $comentario = "";
        if ($request->comentario != null) {
            $comentario = $request->comentario;
        }

        $destinationPath = public_path('imagens/inspecoes');
        $image1 = $request->photo;
        $_image1 = rand() . '.jpeg';
        $image1->move($destinationPath, $_image1);

        $fotoDaInspecao = new InspecaoFoto;
        $fotoDaInspecao->imagemInspecao = $_image1;
        $fotoDaInspecao->inspecao_id = $request->id;
        $fotoDaInspecao->orientation = $request->orientation;
        $fotoDaInspecao->descricao = $comentario;
        $fotoDaInspecao->nome = "$request->nome";
        $fotoDaInspecao->save();

        $resultadoImg = InspecaoFoto::where('inspecao_id', '=', $request->id)->where('nome', '=', $request->nome)->exists();
        $data = array(
            'status'   => $resultadoImg,
        );
        return $data;
    }
    /*
    * FUNCAO: funcao que salva/atualiza o comentario em uma imagem
    * ENTRADA: inspecao_id, nome, comentario
    * SAIDA: true ou false
    */
    public function apiSaveComentario(Request $request)
    {
        //SALVO O COMENTARIO
        $InspecaoFoto = InspecaoFoto::where('inspecao_id', '=', $request->id)->where('nome', '=', $request->nome)->first();
        $InspecaoFoto->descricao = $request->comentario;
        $InspecaoFoto->save();

        //VERIFICO SE FOI SALVO
        $resultadoComentario = InspecaoFoto::where('inspecao_id', '=', $request->id)->where('nome', '=', $request->nome)->first();
        if ($resultadoComentario->descricao != "" || $resultadoComentario->descricao == $request->comentario) {
            $data = array(
                'status'   => true,
            );
            return $data;
        } else {
            $data = array(
                'status'   => false,
            );
            return $data;
        }
    }
    /*
    *
    *
    *
    */
    public function apiVerifica(Request $request)
    {
        $resultadoImg = InspecaoFoto::where('inspecao_id', '=', $request->inspecao_id)->where('nome', '=', $request->nome)->exists();
        $resultado = InspecaoFoto::where('inspecao_id', '=', $request->inspecao_id)->where('nome', '=', $request->nome)->where('descricao', '=', $request->comentario)->exists();

        $data = array(
            'imagem'   => $resultadoImg,
            'comentario' => $resultado,
        );
        return $data;
    }
    /*
    *   FUNCAO: Enviar para o app as imagens por inspecao
    *   ENTRADA: inspecao_id
    *   RETURN: lista com os nome das imagens
    */
    public function apiDownloadImg(Request $request)
    {
        $resultado = InspecaoFoto::where('inspecao_id', '=', $request->inspecao_id)->get();
        $temp = [];
        foreach ($resultado as $item) {
            $obj = (object) array(
                'inspecao_id'           => $item->inspecao_id,
                'imagemInspecao'        => $item->imagemInspecao,
                'nome'                  => $item->nome,
                'orientation'           => $item->orientation,
                'descricao'             => $item->descricao,
            );
            array_push($temp, $obj);
        }

        return $temp;
    }
    /*
    *   FUNCAO: Enviar para o app a lista de documentos por cnae
    *   ENTRADA: inspecao_id
    *   RETURN: lista com os nome dos documentos
    */
    public function apiDownloadDoc(Request $request)
    {
        $user = User::where('remember_token', '=', $request->token)->first();
        $inspetor = Inspetor::where('user_id', '=', $user->id)->first();
        $inspecoes = Inspecao::where('inspetor_id', $inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();
        //$inspecao = Inspecao::find($request->inspecao_id);
        $documentos = [];
        foreach ($inspecoes as $item) {
            $docsempresa = Docempresa::where('empresa_id', $item->requerimento->empresa->id)->where('area', $item->requerimento->cnae->areas_id)->get();

            foreach ($docsempresa as $indice) {
                $obj = (object) array(
                    'inspecao_id' => $item->id,
                    'nome'      =>  $indice->tipodocemp->nome,
                    'caminho'   =>  $indice->nome,
                );
                array_push($documentos, $obj);
            }
            if (count($documentos) > 0) {
                $data = array(
                    'success'   => 'true',
                    'table_data' => $documentos,
                );
            } else {
                $data = array(
                    'success'   => 'false',
                    'table_data' => $documentos,
                );
            }
        }
        return $data;
    }
    /*
    *   FUNCAO: Pegar arquivo PDF
    *   ENTRADA: caminho
    *   RETURN: Arquivo PDF
    */
    public function apiDownloadImagemPDF(Request $request)
    {
        //$file = 'C:/xampp/htdocs/siteVisaGaranhuns/storage/app/public/'.$request->caminho;
        $file = '/home/adminuag/site/visagaranhuns/storage/app/public/' . $request->caminho;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file, 'filename.pdf', $headers);
    }
    /*
    *   FUNCAO: Envia todas as inspecoes, documentos, imagens e comentarios de um determinado inspetor
    *   ENTRADA: token
    *   RETURN: (lista) inspecoes, documentos, imagens e comentarios
    */
    //
    //
    //
    public function apiAtualizarApp(Request $request)
    {
        $data = $this->getAllInspecao($request);
        return $data;
    }

    private function getAllInspecao(Request $request)
    {
        $user = User::where('remember_token', '=', $request->token)->first();
        $inspetor = Inspetor::where('user_id', '=', $user->id)->first();
        $inspecoes = Inspecao::where('inspetor_id', $inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();

        $listaDeInspecoes = [];
        $listaDeDocumentos = [];
        $listaDeImagens = [];

        foreach ($inspecoes as $indice) {

            $endereco = $telefone = $denuncia = $empresa = null;

            if ($indice->requerimento_id == null) {
                if (!is_null($indice->empresas_id)) {
                    $endereco = Endereco::where('empresa_id', $indice->empresas_id)
                        ->first();
                    $telefone = Telefone::where('empresa_id', $indice->empresas_id)
                        ->first();

                    $empresa = Empresa::where('id', $indice->empresas_id)->first();

                    $userEmpresa = User::where('id', $empresa->user_id)->first();
                }

                $denuncia = Denuncia::where('id', $indice->denuncias_id)->first();

                $obj = (object) array(
                    'empresa_nome'          => $empresa ? $empresa->nome : $denuncia->empresa,
                    'rua'                   => $empresa ? $endereco->rua : $denuncia->endereco,
                    'numero'                => $empresa ? $endereco->numero : "",
                    'bairro'                => $empresa ? $endereco->bairro : "",
                    'cep'                   => $empresa ? $endereco->cep : "",
                    'cnpjcpf'               => $empresa ? $empresa->cnpjcpf : "",
                    'representante_legal'   => $empresa ? $userEmpresa->name : "",
                    'telefone1'             => $empresa ? $telefone->telefone1 : "",
                    'telefone2'             => $empresa ? $telefone->telefone2 : "",
                    'email'                 => $empresa ? $empresa->email : "",
                    'data'                  => $indice->data,
                    'status'                => $indice->status,
                    'tipo'                  => "Denuncia",
                    'descricao'             => $denuncia->denuncia,
                    'inspecao_id'           => $indice->id,
                );
                array_push($listaDeInspecoes, $obj);
            } else {
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
                array_push($data, $obj);
            }

            if (!is_null($indice->empresas_id)) {
                $docsempresa = $indice->requerimento_id == null ?
                    Docempresa::where('empresa_id', $empresa->id)->get() :
                    Docempresa::where('empresa_id', $indice->requerimento->empresa->id)->where('area', $indice->requerimento->cnae->areas_id)->get();

                foreach ($docsempresa as $indicedoc) {
                    $obj2 = (object) array(
                        'inspecao_id'           => $indice->id,
                        'nome'                  => $indicedoc->tipodocemp->nome,
                        'caminho'               => $indicedoc->nome,
                        'data_emissao'          => $indicedoc->data_emissao,
                        'data_validade'         => $indicedoc->data_validade,
                    );
                    array_push($listaDeDocumentos, $obj2);
                }
            } else {
                array_push($listaDeDocumentos, new stdClass());
            }

            $resultado = InspecaoFoto::where('inspecao_id', '=', $indice->id)->orderBy('created_at', 'ASC')->get();
            foreach ($resultado as $item) {
                $objFoto = (object) array(
                    'inspecao_id'           => $item->inspecao_id,
                    'imagemInspecao'        => $item->imagemInspecao,
                    'nome'                  => $item->nome,
                    'orientation'           => $item->orientation,
                    'descricao'             => $item->descricao,
                );
                array_push($listaDeImagens, $objFoto);
            }
        }

        $data = array(
            'lista_inspecoes'           => $listaDeInspecoes,
            'lista_documentos'          => $listaDeDocumentos,
            'lista_imagens'             => $listaDeImagens,
        );

        return $data;
    }
}

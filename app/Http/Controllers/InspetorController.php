<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspetor;
use App\User;
use App\Inspecao;
use App\InspecAgente;
use App\Endereco;
use App\InspecaoFoto;
use App\InspecaoRelatorio;
use App\Telefone;
use Auth;
use Illuminate\Support\Facades\Crypt;

class InspetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarInspetores()
    {
        $inspetores = User::where("tipo", "inspetor")->where("status_cadastro", "aprovado")->get();
        return view('coordenador/inspetores_coordenador', [ 'inspetores'  => $inspetores ]);
    }

    public function home()
    {
        $token = User::where('id','=',Auth::user()->id)->first();
        $inspetor = Inspetor::where('user_id','=',Auth::user()->id)->first();
        $pendente = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->count();
        $concluido = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'concluido')->orderBy('data', 'ASC')->count();
        $aviso = $token->remember_token;
        if($aviso == null){
            return view('inspetor.home_inspetor',['pendente' => $pendente, 'concluido' => $concluido, 'aviso' => 0]);
        }else{
            return view('inspetor.home_inspetor',['pendente' => $pendente, 'concluido' => $concluido, 'aviso' => 1]);
        }
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
        return view('inspetor.cadastrar_inspetor')->with(["user" => $user->email]);
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

        // Atualiza dados de user para inspetor
        $user->name = $request->nome;
        $user->password = bcrypt($request->password);
        $user->status_cadastro = "aprovado";
        $user->save();

        $inspetor = Inspetor::create([
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

    public function inspecoes(Request $request)
    {
        $inspecoes = Inspecao::where('inspetor_id', 1)
        ->where('status', 'pendente')->get();
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
                'data'          => $indice->data,
                'status'        => $indice->status,
            );
            array_push($temp, $obj);
        }
    }

    /*
    * FUNCAO: Mostrar a pagina de programacao
    * ENTRADA:
    * SAIDA: Listar inspecoes programadas para o inspetor
    */
    public function showProgramacao(){
        $inspetor = Inspetor::where('user_id','=',Auth::user()->id)->first();
        $inspecoes = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'pendente')->orderBy('data', 'ASC')->get();
        return view('inspetor/programacao_inspetor', ['inspecoes' => $inspecoes]);
    }

    /*
    * FUNCAO: Mostrar as imagens capturadas pela camera
    * ENTRADA: inspecao_id
    * SAIDA: listagem com as imagens da camera
    */
    public function showAlbum(Request $request){
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->value))->orderBy('created_at','ASC')->get();
        return view('inspetor/album_inspetor', ['album' => $resultado]);
    }
    /*
    * FUNCAO:  Deletar uma imagem
    * ENTRADA: inspecao_id, imagem_id
    * SAIDA:
    */
    public function deleteFoto(Request $request){
        $nomeDoArquivo = "";
        $resultado = InspecaoFoto::where('id','=',Crypt::decrypt($request->value))->first();
        $nomeDoArquivo = $resultado->imagemInspecao;
        $resultado->delete();
        unlink("imagens/inspecoes/".$nomeDoArquivo);
        return redirect()->back()->with('success', "Foto deletada com sucesso!");
    }
    /*
    * FUNCAO: mostrar a pagina de relatorio
    * ENTRADA: inspecao_id
    * SAIDA:
    */
    public function showRelatorio(Request $request){
        $resultado = InspecaoFoto::where('inspecao_id','=', Crypt::decrypt($request->value))->orderBy('created_at','ASC')->get();
        $relatorio = InspecaoRelatorio::where('inspecao_id','=', Crypt::decrypt($request->value))->first();
        if($relatorio == null){
            return view('inspetor/relatorio_inspetor',['album' => $resultado, 'inspetor_id' => Crypt::decrypt($request->value), 'relatorio' => ""]);
        }else{
            return view('inspetor/relatorio_inspetor',['album' => $resultado, 'inspetor_id' => Crypt::decrypt($request->value), 'relatorio' => $relatorio->relatorio]);
        }
    }
    /*
    * FUNCAO: mostrar a pagina de historico
    * ENTRADA:
    * SAIDA:
    */
    public function showHistorico(){
        $inspetor = Inspetor::where('user_id','=',Auth::user()->id)->first();
        $inspecoes = Inspecao::where('inspetor_id',$inspetor->id)->where('status', 'concluido')->orderBy('data', 'ASC')->get();
        return view('inspetor/historico_inspetor', ['inspecoes' => $inspecoes]);
    }
    /*
    * FUNCAO: Add descricao a imagem
    * ENTRADA: inspecao_id, descricao
    * SAIDA:
    */
    public function saveDescricao(Request $request){
        $resultado = InspecaoFoto::where('id','=',$request->inspecao_id)->first();
        $resultado->descricao = $request->descricao;
        $resultado->save();
        return redirect()->back()->with('success'.$resultado->id, "Comentário salvo com sucesso!");
    }
    /*
    * FUNCAO: salvar/atualizar o relatorio
    * ENTRADA: relatorio
    * SAIDA:
    */
    public function saveRelatorio(Request $request){

        $verifica = InspecaoRelatorio::where('inspecao_id','=',$request->inspecao_id)->exists();
        $numAgentes = InspecAgente::where('inspecoes_id',$request->inspecao_id)->count();

        if($verifica == true){ //atualizo
            $atualizar = InspecaoRelatorio::where('inspecao_id','=',$request->inspecao_id)->first();
            $atualizar->update(['relatorio'=>$request->relatorio]);
            return redirect()->back()->with('success', "Relatório atualizado com sucesso!");
        }else{ //salvo
            $relatorio = new InspecaoRelatorio;
            $relatorio->inspecao_id = $request->inspecao_id;
            $relatorio->relatorio = $request->relatorio;
            $relatorio->status = "avaliacao";
            $relatorio->num_avaliadores = $numAgentes + 1;

            $relatorio->save();
            return redirect()->back()->with('success', "Relatório salvo com sucesso!");
        }
    }
}

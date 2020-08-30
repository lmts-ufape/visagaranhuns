<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordenador;
use App\User;
use App\Agente;
use App\Empresa;
use App\Endereco;
use App\Telefone;
use App\CnaeEmpresa;

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
        return view('coordenador.home_coordenador');
    }

    /* Função para listar em tela todas empresas que se cadastraram
    e que o acesso não foi liberado.
    */
    public function listarPendente()
    {
        $empresas = Empresa::where("status_cadastro","pendente")->get();
        return view('coordenador.cadastro_pendente', ["empresa" => $empresas]);
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

    public function julgar(Request $request)
    {
        // Encontrar email do perfil da empresa
        //*******************************************************
        $useremail = User::find($request->user_id);
        // ****************************************************** 
        $empresa = Empresa::find($request->empresa_id);

        if($empresa->status_cadastro == "pendente"){

            if($request->decisao == 'true'){

                // Enviar e-mai de comprovação de cadastro
                //************************************** */
                
                $user = new \stdClass();
                $user->name = $useremail->name;
                $user->email = $useremail->email;
    
                \Illuminate\Support\Facades\Mail::send(new \App\Mail\ConfirmaCadastro($user));
                // *************************************
                
                $empresa->status_cadastro = "aprovado";
                $empresa->save();
    
                session()->flash('success', 'Cadastro aprovado com sucesso');
                return redirect()->route('confirma.cadastro');
            }
            else{
              $empresa->status_cadastro = "reprovado";
              $empresa->save();
    
              session()->flash('success', 'Cadastro reprovado com sucesso');
              return redirect()->route('/');
            }

        }

        // Trecho para o caso de coordenador precisar reavaliar cadastro de empresa
        // elseif ($estabelecimento->status == "Aprovado" || $estabelecimento->status == "Reprovado") {
            
        //     if($request->decisao == 'true'){

        //         // Enviar e-mai de comprovação de cadastro
        //         //************************************** */
                
        //         $user = new \stdClass();
        //         $user->name = $userfound[0]->name;
        //         $user->email = $userfound[0]->email;
    
        //         \Illuminate\Support\Facades\Mail::send(new \App\Mail\SendMailUser($user));
        //         // *************************************
                
        //         $estabelecimento->status = "Aprovado";
        //         $estabelecimento->save();
    
        //         session()->flash('success', 'Estabelecimento aprovado com sucesso');
        //         return redirect()->route('estabelecimentoAdmin.revisar');
        //     }
        //     else{
        //       $estabelecimento->status = "Reprovado";
        //       $estabelecimento->save();
    
        //       session()->flash('success', 'Estabelecimento reprovado com sucesso');
        //       return redirect()->route('estabelecimentoAdmin.revisar');
        //     }
        // } 
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordenador;
use App\User;
use App\Agente;
use App\Inspetor;
use App\Empresa;
use App\Endereco;
use App\Telefone;
use App\CnaeEmpresa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

                session()->flash('success', 'Cadastros aprovados com sucesso');
                return redirect()->route('/');
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

                $empresa->status_cadastro = "reprovado";
                $useremail->status_cadastro = "reprovado";
                $empresa->save();
                $useremail->save();

              session()->flash('success', 'Cadastros reprovados com sucesso');
              return redirect()->route('/');
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

                session()->flash('success', 'Cadastro aprovado com sucesso');
                return redirect()->route('/');
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
        $resultado = Empresa::get();
        $output = '';
        if($resultado->count() > 0){
            $rota = "pagina.detalhes";
            foreach($resultado as $item){
                $id = $item->id;
                if($filtro == "all"){
                    if($item->status_cadastro == "pendente"){
                        $output .= '
                            <div class="container cardListagem">
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
                                            <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                    <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <div class="btn-group" style="margin-bottom:-15px;">
                                                <div class="form-group" style="font-size:15px;">
                                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                    <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                    <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                    <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                    <button type="button" onclick="empresaId('.$item->id.')" class="btn btn-info">Avaliar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="idTabela">
                                    <table>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        ';
                        }elseif($item->status_cadastro == "renovacao_de_licenca"){
                            $output .= '
                                <div class="container cardListagem">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <div class="btn-group" style="margin-bottom:-15px;">
                                                <div class="form-group" style="font-size:15px;">
                                                    <div class="textoCampo">'.$item->nome.'</div>
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
                                                <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                        <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                        <div class="d-flex">
                                            <div class="mr-auto p-2">
                                                <div class="btn-group" style="margin-bottom:-15px;">
                                                    <div class="form-group" style="font-size:15px;">
                                                        <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                        <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                        <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                        <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="idTabela">
                                        <table>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            ';
                            }elseif($item->status_cadastro == "aprovado"){
                                $output .= '
                                    <div class="container cardListagem">
                                        <div class="d-flex">
                                            <div class="mr-auto p-2">
                                                <div class="btn-group" style="margin-bottom:-15px;">
                                                    <div class="form-group" style="font-size:15px;">
                                                        <div class="textoCampo">'.$item->nome.'</div>
                                                        <span>Aprovado</span>
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
                                                    <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                            <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                            <div class="d-flex">
                                                <div class="mr-auto p-2">
                                                    <div class="btn-group" style="margin-bottom:-15px;">
                                                        <div class="form-group" style="font-size:15px;">
                                                            <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                            <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                            <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                            <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="idTabela">
                                            <table>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                ';
                                }
                    }elseif($filtro == "pendente" && $item->status_cadastro == "pendente"){
                        $output .= '
                            <div class="container cardListagem">
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
                                            <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                    <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <div class="btn-group" style="margin-bottom:-15px;">
                                                <div class="form-group" style="font-size:15px;">
                                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                    <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                    <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                    <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                    <button type="button" onclick="empresaId('.$item->id.')" class="btn btn-info">Avaliar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="idTabela">
                                    <table>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        ';

                    }elseif($filtro == "aprovado" && $item->status_cadastro == "aprovado"){
                        $output .= '
                            <div class="container cardListagem">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <div class="btn-group" style="margin-bottom:-15px;">
                                            <div class="form-group" style="font-size:15px;">
                                                <div class="textoCampo">'.$item->nome.'</div>
                                                <span>Aprovado</span>
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
                                            <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                    <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <div class="btn-group" style="margin-bottom:-15px;">
                                                <div class="form-group" style="font-size:15px;">
                                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                    <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                    <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                    <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="idTabela">
                                    <table>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        ';
                    }elseif($filtro == "renovacao_de_licenca" && $item->status_cadastro == "renovacao_de_licenca"){
                        $output .= '
                            <div class="container cardListagem">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <div class="btn-group" style="margin-bottom:-15px;">
                                            <div class="form-group" style="font-size:15px;">
                                                <div class="textoCampo">'.$item->nome.'</div>
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
                                            <button class="btn btn-info  btn-sm" type="button" id="dropdownMenuButton" onclick="mostrar('.$item->id.')">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="cardEstabelecimento'.$item->id.'" style="display:none;">
                                    <hr style="margin-bottom:-0.1rem; margin-top:-0.2rem;">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <div class="btn-group" style="margin-bottom:-15px;">
                                                <div class="form-group" style="font-size:15px;">
                                                    <div>Tipo: <span class="textoCampo">'.$item->tipo.'</span></div>
                                                    <div>CNPJ/CPF: <span class="textoCampo">'.$item->cnpjcpf.'</span></div>
                                                    <div>Responsável Técnico:<span class="textoCampo">Fulano de Tal</span></div>
                                                    <div>Última Inspeção: <span class="textoCampo">Ainda não foi realizada</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="idTabela">
                                    <table>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        ';
                    }
            }
        }else{
            $output .= '
                    <tr>
                        <td>'.'Nenhum Requerimento!'.'</td>
                    </tr>
                    ';
                $data = array(
                    'success'   => false,
                    'table_data' => $output,
                );
                echo json_encode($data);
        }


        $data = array(
            'success'   => true,
            'table_data' => $output,
        );
        echo json_encode($data);
    }
}

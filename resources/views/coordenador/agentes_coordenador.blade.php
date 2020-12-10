@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$message}}</strong>
        </div>
    @elseif ($message = Session::get('error'))
    <div class="alert alert-warning alert-block fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="barraMenu">
        <div class="d-flex justify-content-center">
            <div class="mr-auto p-2 styleBarraPrincipalMOBILE">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
            </div>
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Agente</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Membros > Agentes</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="dropdown" style="margin-top:10px">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:2rem;margin-left:10px; margin-bottom:17%;">
        <div class="form-row">
            <div class="form-group col-md-12">

                @if(count($agentes)>0)
                    @foreach($agentes as $item)
                        <div class="cardListagem" >
                            <div class="container">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <div class="btn-group" style="margin-bottom:-15px;">
                                            <div class="form-group" style="font-size:15px;">
                                                <div class="textoCampo">{{$item->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="dropdown">
                                            <a href="" data-toggle="modal" data-target="#exampleModalInfo" onclick="agentes({{$item->id}})">Abrir</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row justify-content-center" style="margin-top:4rem;margin-bottom:10rem">
                        <div class="col-12" style="text-align:center;color:gray;font-size:15px;font-weight:bold;">Nenhum agente cadastrado!</div>
                        <div class="col-5" style="text-align:center">
                            <a data-toggle="modal" data-target="#exampleModal" style="color:#1493e6; cursor:pointer">Clique aqui para convidar um agente</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
{{-- modal - enviar convite --}}


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Convidar agente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{route('convidar.agente')}}">
                @csrf 
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Para convidar um agente, basta enviar um e-mail:</label>
                        </div>
                        <div class="col-md-12">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                            <input type="hidden" name="tipo" value="agente">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Enviar convite</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal - Infos do agente -->
      <div class="modal fade" id="exampleModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dados do Agente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label></label>
                        </div>
                        <div class="col-md-4">
                            <label class="styleTituloDoInputCadastro" for="inputNome4">Nome do Usuário:<span style="color:red"></span></label>
                            <input id="nomeAgente" type="text" class="styleInputCadastro" name="name" placeholder="" value="" disabled>
                        </div>
                        <div class="form-group col-md-4"  style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputCpfl4">Cpf:<span style="color:red"></span></label>
                            <input id="cpfAgente" type="text" class="styleInputCadastro" placeholder="" name="cpf" value="" disabled>
                        </div>
                        <div class="form-group col-md-4"  style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputFormacao4">Formação:</label>
                            <input id="formacaoAgente" type="text" class="styleInputCadastro" placeholder="" name="formacao" value="" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4"  style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEspecializacao4">especialização:</label>
                            <input id="especializacaoAgente" type="text" class="styleInputCadastro" placeholder="" name="especializacao" value="" disabled>
                        </div>
                        <div class="form-group col-md-4"  style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputTelefone4">Telefone:<span style="color:red"></span></label>
                            <input id="telefoneAgente" type="text" class="styleInputCadastro" placeholder="" name="telefone" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-light">Cancelar</button> --}}
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      <script type="text/javascript">

        window.agentes = function($id){
            //area

            $.ajax({
                url:'{{ config('prefixo.PREFIXO') }}encontrar/agente',
                type:"get",
                dataType:'json',
                data: {"id": $id},
                success: function(response){
                    console.log(response);
                    // $('tbody').html(response.table_data);
                    document.getElementById('nomeAgente').value = response.nome;
                    document.getElementById('cpfAgente').value = response.cpf;
                    document.getElementById('formacaoAgente').value = response.formacao;
                    document.getElementById('especializacaoAgente').value = response.especializacao;
                    document.getElementById('telefoneAgente').value = response.telefone;
                }
            });
        }
      </script>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
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
                        <div class="tituloBarraPrincipal">Denúncias</div>
                        <div>
                            <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Denúncias </div>
                        </div>
                    </div>
                </div>
                <div class="p-2" style="width:20%">
                    {{-- <div class="dropdown" style="width:50px"> --}}
                        {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                        </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('error'))
            <div class="alert alert-warning alert-block fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{$message}}</strong>
            </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        @if(!empty($aprovado))
        <div class="alert alert-warning alert-block fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$aprovado}}</strong>
        </div>
        @endif
        @if(!empty($reprovado))
        <div class="alert alert-warning alert-block fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$reprovado}}</strong>
        </div>
        @endif
    <div class="container" style="margin-top:2rem;margin-left:10px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a data-toggle="tab" class="nav-link active" href="#pendente">Pendentes</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" class="nav-link" href="#aceito">Aceitas</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" class="nav-link" href="#arquivado">Arquivadas</a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#concluido">Concluidas</a>
              </li>
        </ul>

        <div class="tab-content">
            <div id="pendente" class="tab-pane in active">
                <div class="form col-md-12" style="margin-top:10px; margin-bottom: 210px;">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            {{-- <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Nome</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">E-mail</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Telefone</th> --}}
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Empresa</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Endereço</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Status</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Descrição</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Avaliar</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Imagens</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendente as $item)
                            <tr>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->empresa}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->endereco}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Pendente</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denuncia('{{$item->denuncia}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denunciaId('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelB">Avaliar</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="abrirImagens('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelC">Abrir</button></th>
                                {{-- <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->status}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->status}}</th> --}}
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="aceito" class="tab-pane">
                <div class="form col-md-12" style="margin-top:10px; margin-bottom: 210px;">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            {{-- <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Nome</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">E-mail</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Telefone</th> --}}
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Empresa</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Endereço</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Status</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Descrição</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Avaliar</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Imagens</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($aceito as $item)
                            <tr>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->empresa}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->endereco}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Aceito</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denuncia('{{$item->denuncia}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="avaliarDenuncia('{{$item->id}}')">Avaliar</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="abrirImagens('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelC">Abrir</button></th>
                                {{-- <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="arquivado" class="tab-pane">
                <div class="form col-md-12" style="margin-top:10px; margin-bottom: 210px;">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            {{-- <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Nome</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">E-mail</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Telefone</th> --}}
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Empresa</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Endereço</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Status</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Descrição</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Avaliar</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Imagens</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($arquivado as $item)
                            <tr>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->empresa}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->endereco}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Arquivado</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denuncia('{{$item->denuncia}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denunciaId('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelB">Avaliar</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="abrirImagens('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelC">Abrir</button></th>
                                {{-- <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="concluido" class="tab-pane">
                <div class="form col-md-12" style="margin-top:10px; margin-bottom: 210px;">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            {{-- <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Nome</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">E-mail</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Telefone</th> --}}
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Empresa</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Endereço</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Status</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Descrição</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Avaliar</th>
                            <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Imagens</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($concluido as $item)
                            <tr>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->empresa}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">{{$item->endereco}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Concluido</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denuncia('{{$item->denuncia}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" data-toggle="modal" data-target="#exampleModalLabelB" disabled>Avaliar</button></th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="abrirImagens('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelC">Abrir</button></th>
                                {{-- <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<form id="submeterIdDenuncia" method="GET" action="{{route('pagina.detalhes.denuncia')}}">
    @csrf
    <input id="inputSubmeterIdDenuncia" type="hidden" name="empresa" value="">
</form>

<form id="licenca" method="POST" action="{{route('licenca')}}">
    @csrf
    <input id="licencaAvaliacao" type="hidden" name="empresa"         value="">
    <input id="areaCnae"         type="hidden" name="area"            value="">
    <input id="requerimento"     type="hidden" name="requerimento"    value="">
</form>

<!-- Modal de Aviso -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Descrição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif; margin-bottom:10px;">Relato descrito pelo denunciante:</div>
                        <div class="col-12"><textarea name="modalDenuncia" id="summary-ckeditor" value="" disabled></textarea></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal - Avaliar Denúncia-->
<div class="modal fade" id="exampleModalLabelB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#2a9df4;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabelB" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Avaliar Denúncia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;">Você deseja arquivar ou acatar esta denúncia <label id="nomeDoEstabelecimento" style="font-weight:bold; font-family: 'Roboto', sans-serif;"></label>?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('avaliar.denuncia') }}">
                        @csrf

                        {{-- <input  type="hidden" name="empresa"       value="{{$empresa->id}}"> --}}
                        <input  type="hidden" name="decisao"       value="false">
                        <input  type="hidden" name="denunciaId"    id="denunciaIdArquivar" value="">

                        <div class="col-md-12" style="padding-right:0">
                            <button type="submit" class="btn btn-outline-secondary botao-form" style="width:100px;">Arquivar</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('avaliar.denuncia') }}">
                        @csrf

                        {{-- <input  type="hidden" name="empresa"       value="{{$empresa->id}}"> --}}
                        <input  type="hidden" name="decisao"       value="true">
                        <input  type="hidden" name="denunciaId"    id="denunciaIdAcatar" value="">

                        <div class="col-md-12" style="padding-right:0">
                            <button type="submit" class="btn btn-outline-secondary botao-form" style="width:100%">
                                Aceitar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal - Imagens da Denúncia -->
<div class="modal fade bd-example-modal-lg" id="exampleModalLabelC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabelB" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Imagens da Denúncia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Imagens anexadas junto a denúncia:</div>
                </div>
                <div id="tbody_imagens">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
</div>

</div>
<script type="text/javascript">
    window.onload= function() {
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}denuncia',
            type:"get",
            dataType:'json',
            data: {"filtro": "all" },
            success: function(response){
                console.log("Chegou aqui");
                $('tbody_').html(response.table_data);
            }
        });
    };

    window.selecionarFiltro = function(){
        //area
        var historySelectList = $('select#idSelecionarFiltro');
        var $opcao = $('option:selected', historySelectList).val();
        // console.log($opcao);
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}requerimento',
            type:"get",
            dataType:'json',
            data: {"id_area": $opcao},
            success: function(response){
                $('tbody').html(response.table_data);
                // document.getElementById('idArea');
            }
        });
    }

    window.selecionarFiltroRequerimento = function($filtro){
        if($filtro == 'pendente'){
            document.getElementById('filtroButtonRequerimento').innerHTML = "Cadastro Pendente";
        }else if($filtro == 'primeira_licenca'){
            document.getElementById('filtroButtonRequerimento').innerHTML = "Primeira licença";
        }else if($filtro == 'renovacao_de_licenca'){
            document.getElementById('filtroButtonRequerimento').innerHTML = "Renovação de licença";
        }else if($filtro == 'all'){
            document.getElementById('filtroButtonRequerimento').innerHTML = "Mostrar tudo";
        }

        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}requerimento',
            type:"get",
            dataType:'json',
            data: {"filtro": $filtro },
            success: function(response){
                console.log(response.table_data);
                $('tbody_').html(response.table_data);
            }
        });
    }

    window.abrirImagens = function($id){
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}denuncia/imagens',
            type:"get",
            dataType:'json',
            data: {"Id": $id },
            success: function(response){
                // console.log(response.table_data);
                // $('#tbody_imagens').html(response.table_data);
                caminho = '<img style="margin-left: 80px; margin-top: 10px; margin-bottom: 10px;" src="{{asset("storage/$")}}">';
                var element = document.getElementById('tbody_imagens');
                for (let index = 0; index < response.table_data.length; index++) {
                    // document.getElementById("resultado-repeticao").innerHTML += "Repetição";
                    resultado = caminho.replace("$", response.table_data[index]);
                    console.log(resultado);
                    element.innerHTML += resultado;   
                }
            }
        });        
    }

    // window.limparModal = function(params) {
    //     console.log("FECHANDO");
    //     var element = document.getElementById('tbody_imagens');
    //     element.innerHTML = "";
    // }

    var modal = document.getElementById('exampleModalLabelC');
    modal.addEventListener('click', function(e) {
        var element = document.getElementById('tbody_imagens');
        element.innerHTML = "";
    });

    window.avaliarDenuncia = function($id){
        console.log($id);
        // document.getElementById("denunciaIdArquivar").value = $id;
        // document.getElementById("denunciaIdAcatar").value = $id;

        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}denuncia/inspecao',
            type:"get",
            dataType:'json',
            data: {"denunciaId": $id },
            success: function(response){
                console.log(response.resultado);
                if (response.resultado == true) {
                    console.log("AQUI MERMO");
                    alert("Está denúncia já possui uma inspeção relacionada a ela! Por isso não pode ser avaliada.");
                }
                else {
                    console.log('ALI MERMO');
                    $("#exampleModalLabelB").modal({
                        show: true
                    });

                    document.getElementById("denunciaIdArquivar").value = $id;
                    document.getElementById("denunciaIdAcatar").value = $id;
                }
            }
        });
    }

    // window.denuncia = function(descricao){
    //     CKEDITOR.instances["summary-ckeditor"].setData(descricao)
    // }
</script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection



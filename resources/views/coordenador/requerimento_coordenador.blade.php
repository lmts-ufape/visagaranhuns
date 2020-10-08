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
                        <div class="tituloBarraPrincipal">Requerimento</div>
                        <div>
                            <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Requerimento </div>
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

    <div class="container" style="margin-top:2rem;margin-left:10px;">
        <div class="form-row">
            <div class="form-group col-md-8">
                    <div class="d-flex">
                            <div class="mr-auto p-2">
                                    <div class="btn-group">
                                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px;">Estabelecimentos</div>
                                    </div>
                            </div>
                           <div class="p-2">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="filtroButtonRequerimento" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Filtro
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" onclick="selecionarFiltroRequerimento('aprovado')" style="text-decoration:none;cursor:pointer">Cadastro Aprovado</a> --}}
                                        {{-- <a class="dropdown-item" onclick="selecionarFiltroRequerimento('denuncia')" style="text-decoration:none;cursor:pointer">Denúncia</a> --}}
                                        <a class="dropdown-item" onclick="selecionarFiltroRequerimento('pendente')" style="text-decoration:none;cursor:pointer">Cadastro Pendente</a>
                                        <a class="dropdown-item" onclick="selecionarFiltroRequerimento('primeira_licenca')" style="text-decoration:none;cursor:pointer">Primeira Licença</a>
                                        <a class="dropdown-item" onclick="selecionarFiltroRequerimento('renovacao_de_licenca')" style="text-decoration:none;cursor:pointer">Renovação de Licença</a>
                                        <a class="dropdown-item" onclick="selecionarFiltroRequerimento('all')" style="text-decoration:none;cursor:pointer">Mostrar Tudo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div id="idTabela">
                    <table style="width:100%">
                        <tbody_>

                        </tbody_>
                    </table>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="container cardProgramacao" style="margin-bottom:3rem;">
                    <div style="margin-top:20px;margin-bottom:5px;">
                        <label class="titulo">Criar uma programação</label>
                    </div>
                    <div class="form-group">
                        <label class="textoCampo">Selecione o Inspetor</label>
                        <select class="custom-select" id="inputGroupSelect01" name="inspetor" required>
                            <option selected> -- Selecione o Inspetor -- </option>
                            @foreach ($inspetores as $item)
                            <option value="{{$item->id}}">{{$item->user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="textoCampo">Selecione o Agente 1</label>
                        <select class="custom-select" id="inputGroupSelect01" name="agente1" required>
                            <option selected> -- Selecione o Agente 1 -- </option>
                            @foreach ($agentes as $item)
                                <option value="{{$item->id}}">{{$item->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="textoCampo">Selecione o Agente 2</label>
                        <select class="custom-select" id="inputGroupSelect01" name="agente2" required>
                            <option selected> -- Selecione o Agente 2 -- </option>
                            @foreach ($agentes as $item)
                                <option value="{{$item->id}}">{{$item->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="textoCampo">Data de Inspeção</label>
                        <input class="form-control" type="date" name="data">
                    </div>
                    <div class="form-group">
                        <label class="textoCampo">Lista de estabelecimentos</label>
                        <div style="width:100%; height:250px; display: inline-block; border: 1.5px solid #f2f2f2; border-radius: 2px; overflow:auto;">
                            <table>
                                <tbody>
                                    <div class="cardDoEstabelecimento">
                                        <div class="container">
                                            <div class="d-flex">
                                                <div class="mr-auto p-2">
                                                    <div class="btn-group">
                                                            <div>Nome do estabelecimento</div>
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                    <div class="dropdown">
                                                        <button class="btn btn-danger  btn-sm" type="button" id="dropdownMenuButton"  style="width:26px; height:26px;">
                                                            x
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cardDoEstabelecimento">
                                            <div class="container">
                                                <div class="d-flex">
                                                    <div class="mr-auto p-2">
                                                        <div class="btn-group">
                                                                <div>Nome do estabelecimento</div>
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="dropdown">
                                                            <button class="btn btn-danger  btn-sm" type="button" id="dropdownMenuButton"  style="width:26px; height:26px;">
                                                                x
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr style="margin-top:1rem;">
                    <div class="form-group" style="margin-bottom:1rem;">
                        <button type="button" class="btn btn-success botao" style="width:100%;">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

<form id="submeterId" method="POST" action="{{route('pagina.detalhes')}}">
    @csrf
    <input id="inputSubmeterId" type="hidden" name="empresa" value="">
</form>
</div>
<script type="text/javascript">
    window.onload= function() {
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}requerimento',
            type:"get",
            dataType:'json',
            data: {"filtro": "all" },
            success: function(response){
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
</script>
@endsection



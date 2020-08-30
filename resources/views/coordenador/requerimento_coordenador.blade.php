@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
            </div>
           {{-- <div class="p-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Solicitar</a>
                         <a class="dropdown-item" href="#">Enviar notificação</a>
                        <a class="dropdown-item" href="#">Editar perfil</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="container">
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:1.5rem; margin-left:20px;">Requerimento</div>
    </div>

    <div class="container" style="margin-top:1rem;margin-left:10px;">
        <div class="form-row">
            <div class="form-group col-md-8">
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
@endsection



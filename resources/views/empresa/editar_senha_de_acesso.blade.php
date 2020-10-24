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
                    <div class="tituloBarraPrincipal">Editar senha de acesso</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Editar senha de acesso </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
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

        <div class="container">
        <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
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
                                <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">ACESSO AO SISTEMA</label>
                            </div>
                        </div>
                        <form id="formEditarMinhaSenhaDeAcessoEmpresa" method="POST" action="{{ route('atualizar.gerente') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4"  style="padding-right:15px;">
                                    <label class="styleTituloDoInputCadastro" for="inputEmail4">Senha atual:<span style="color:red">*</span></label>
                                    <input type="password" class="styleInputCadastro" name="senhaAtual" placeholder="">
                                </div>
                                <div class="form-group col-md-4"  style="padding-right:15px;">
                                    <label class="styleTituloDoInputCadastro" for="inputEmail4">Digite sua nova senha:<span style="color:red">*</span></label>
                                    <input type="password" class="styleInputCadastro" name="senhaAtual" placeholder="">
                                </div>
                                <div class="form-group col-md-4"  style="padding-right:15px;">
                                    <label class="styleTituloDoInputCadastro" for="inputEmail4">Digite sua nova senha mais uma vez:<span style="color:red">*</span></label>
                                    <input type="password" class="styleInputCadastro" name="senhaAtual" placeholder="">
                                </div>
                            </div>
                        <form>
                        <hr size = 7>
                        <div style="margin-bottom:0.2rem;">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label style="font-weight:bold; color:red; font-family:Arial, Helvetica, sans-serif"><span style="font-size:20px">*</span> campos obrigatórios</label>
                                    </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success" style="width:100%;" >Atualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal de Aviso -->
<div class="modal fade" id="exampleModalAtualizarMeusDadosEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="idCorCabecalhoModalEditarMeusDados">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Editar meus dados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="idTituloDaMensagemMeusDadosEmpresa"></label></div>
                        <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
                    <div id="botaoIdAtualizarMeusDadosEmpresa" style="display: block">
                        <button type="button" class="btn btn-success" style="width:200px;" onclick="submitAtualizarMeusDadosEmpresa()">Sim, alterar meu nome</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



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
           <div class="p-2">
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
            </div>
        </div>
    </div>
    <div class="container" style="margin-top:1rem;margin-left:10px;">
        <fieldset disabled>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Nome/Razão Social:</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="{{$empresa->user->name}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CNPJ/CPF:</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="{{$empresa->cnpjcpf}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CNAE:</label>
                    <input type="text" class="form-control" id="inputPassword4" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">E-mail:</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="{{$empresa->email}}">
                </div>
                <div class="form-grtextoup col-md-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Telefone 1:</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$empresa}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Telefone 2:</label>
                            <input type="text" class="form-control" id="inputPassword4"  placeholder="{{$empresa}}">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Nº CNAE:</label>
                    <input type="text" class="form-control" id="inputPassword4"  placeholder="{{$empresa}}">
                </div>
            </div>
        </fieldset>
    </div>
    <div class="barraMenu" style="margin-top:0.7rem;">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Endereço</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top:1rem;margin-left:10px;">
            <fieldset disabled>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Rua:</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="{{$endereco->rua}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Número:</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="{{$empresa->endereco}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Complemento:</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="{{$empresa->endereco}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Bairro:</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="{{$empresa->endereco}}">
                    </div>
                    <div class="form-group col-md-4">
                            <label for="inputEmail4">Cidade/UF:</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="{{$empresa->endereco}}/{{$empresa->endereco}}">
                        </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">CEP:</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="{{$empresa->endereco}}">
                    </div>
                    </div>
                </div>
            </fieldset>
        </div>


</div>
@endsection



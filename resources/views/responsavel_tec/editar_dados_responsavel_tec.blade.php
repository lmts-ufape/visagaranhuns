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
                    
                </div>
            </div>
        </div>
    </div>
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
                    <div class="btn-group">
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;margin-bottom:-5px">Editar responsável técnico</div>
                    </div>
                </div>
                <div class="p-2">
                    <div style="width:70px">
                    </div>
                </div>
            </div>
        </div>

    <form id="teste" method="POST" action="{{ route('update.rt') }}">
        @csrf
        <input type="hidden" name="respTecnico" value="{{$respTecnico->id}}">
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Nome Completo<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="nome" value="{{$user->name}}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CPF:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="cpf" value="{{$respTecnico->cpf}}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Formação:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="formacao" value="{{$respTecnico->formacao}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Especialização:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="especializacao" value="{{$respTecnico->especializacao}}" required>
                </div>
                <div class="form-grtextoup col-md-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Telefone:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="telefone" id="inputTelefone1" value="{{$respTecnico->telefone}}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <div class="btn-group">
                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Email para login de acesso ao sistema</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:1rem;margin-left:1px;">
                <div class="container" style="margin-top:1rem;margin-left:10px;">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">E-mail:<span style="color:red">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="{{$user->email}}" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Senha:<span style="color:red">*</span></label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Confirmar senha:<span style="color:red">*</span></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>

        <hr size = 7>
        <div style="margin-bottom:10rem;">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                    </div>
                <div class="p-2">
                    <button type="submit" class="btn btn-success" style="width:340px;">Cadastrar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection



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
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;margin-bottom:-5px">Cadastrar responsável técnico</div>
                    </div>
                </div>
                <div class="p-2">
                    <div style="width:70px">
                    </div>
                </div>
            </div>
        </div>

    <form id="teste" method="POST" action="{{ route('cadastrar.rt') }}">
        @csrf
        <input type="hidden" name="empresaId" value="{{$empresaId}}">
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Nome Completo<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="nome" placeholder="" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CPF:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="cpf" placeholder="" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Formação:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="formacao" placeholder="" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Especialização:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="especializacao" placeholder="" required>
                </div>
                <div class="form-grtextoup col-md-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Telefone:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="telefone" id="inputTelefone1" placeholder="" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <div class="btn-group">
                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Área de atuação</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:1rem;margin-left:1px;">
                <div class="container" style="margin-top:1rem;margin-left:10px;">
                    @if ($message = Session::get('error'))
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{$message}}</strong>
                            </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="form-control" name="area">
                                <option value="">AREAS</option>
                                @foreach ($areas as $item)
                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                        </div>
                        <div class="form-group col-md-4">
                            <h5>Responsáveis técnicos já cadastrados:</h5>
                            @if (count($respTecnicos) == 0)
                                <h6>Ainda não há responsáveis técnicos cadastrados</h6>
                            @else
                                <ul class="list-group">
                                    @foreach ($areas as $area)
                                        @foreach ($respTecnicos as $rt)
                                            @if ($area->id == $rt->area_id)
                                                <li class="list-group-item">{{$rt->user->name}}: {{$area->nome}}</li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <hr size = 7>

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
                        <input type="email" class="form-control" name="email">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="inputPassword4">Senha:<span style="color:red">*</span></label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Confirmar senha:<span style="color:red">*</span></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div> --}}
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



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
                    <div class="tituloBarraPrincipal">Cadastrar responsável técnico</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimentos > {{$empresaNome}} > Cadastrar responsável técnico</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
            </div>
        </div>
    </div>

    <form id="teste" method="POST" action="{{ route('cadastrar.rt') }}">
        @csrf
        <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
                <div class="container" style="margin-top:1rem;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DADOS DO RESPONSÁVEL TÉCNICO</label>
                                </div>
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
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{$message}}</strong>
                            </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEmail4">Nome Completo<span style="color:red">*</span></label>
                            <input type="text" class="styleInputCadastro" name="nome" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputPassword4">CPF:<span style="color:red">*</span></label>
                            <input type="text" class="styleInputCadastro" name="cpf" placeholder="" required>
                        </div>

                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputPassword4">Formação:<span style="color:red">*</span></label>
                            <input type="text" class="styleInputCadastro" name="formacao" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEmail4">Especialização:<span style="color:red">*</span></label>
                            <input type="text" class="styleInputCadastro" name="especializacao" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEmail4">Telefone:<span style="color:red">*</span></label>
                            <input type="text" class="styleInputCadastro" name="telefone" id="inputTelefone1" placeholder="" required>
                        </div>

                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEmail4">Carga horária:<span style="color:red">*</span></label>
                            <input type="number" class="styleInputCadastro" name="carga_horaria" id="carga_horaria" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">SELECIONE A ÁREA DE ATUAÇÃO</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="container" style="margin-top:10px;margin-left:10px;">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    @foreach ($areas as $item)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="area" name="area[]" value="{{$item->id}}">
                                            <label class="form-check-label" for="exampleCheck1">{{$item->nome}}</label>
                                        </div>
                                        {{-- <option value="{{$item->id}}">{{$item->nome}}</option> --}}
                                    @endforeach
                                </div>
                                <div class="form-group col-md-4">
                                </div>
                                <div class="form-group col-md-4">
                                    <h5>Responsáveis técnicos já cadastrados:</h5>
                                    @if (count($respTecnicos) == 0)
                                        <h6>Ainda não há responsáveis técnicos cadastrados</h6>
                                    @else
                                        <ul class="list-group">
                                            @foreach ($rtempresa as $rtemp)
                                                @foreach ($respTecnicos as $rt)
                                                    @if ($rtemp->resptec_id == $rt->id)
                                                        <li class="list-group-item">{{$rt->user->name}}: {{$rtemp->area->nome}}</li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">E-MAIL PARA ENVIAR DADOS DE LOGIN</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <label class="styleTituloDoInputCadastro" for="inputEmail4">E-mail:<span style="color:red">*</span></label>
                            <input type="email" class="styleInputCadastro" name="email">
                        </div>
                    </div>
                    <hr size = 7>
                            <div style="margin-bottom:1rem;">
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <label style="font-weight:bold; color:red; font-family:Arial, Helvetica, sans-serif"><span style="font-size:20px">*</span> campos obrigatórios</label>
                                        </div>
                                    <div class="p-2">
                                            <input type="hidden" name="user" value="{{Auth::user()->id}}">
                                        <button type="submit" class="btn btn-success" style="width:340px;">Cadastrar</button>
                                    </div>
                                </div>
                            </div>
                </div>


        </div>
        <input type="hidden" name="empresaId" value="{{$empresaId}}">
        <div class="container" style="margin-top:1rem;margin-left:10px;">
        </div>
    </form>
</div>
@endsection



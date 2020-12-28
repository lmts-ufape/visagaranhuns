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
                    <div class="tituloBarraPrincipal">Finalizar Cadastro</div>
                </div>
            </div>
        </div>
    </div>

    <form id="teste" method="POST" action="{{ route('cadastrar.rt') }}">
        @csrf
        <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
                <div class="container" style="margin-top:1rem;">
                    {{-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DADOS DO RESPONSÁVEL TÉCNICO</label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                    {{-- <div class="form-row">
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
                    </div> --}}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DADOS DO RESPONSÁVEL TÉCNICO</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="container" style="margin-top:10px;margin-left:10px;">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    
                                </div>
                                <div class="form-group col-md-3">
                                </div>
                                <div class="form-group col-md-5">
                                    <h5>Responsáveis técnicos já cadastrados:</h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">CARGA HORÁRIA<span style="color:red">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4" style="padding-right:15px;">
                            <input type="number" class="styleInputCadastro" name="carga_horaria" id="carga_horaria" placeholder="" required>
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

        <div class="container" style="margin-top:1rem;margin-left:10px;">
        </div>
    </form>
</div>

<!-- Modal - deletar rt -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:red;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Deletar Responsável Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Tem certeza de que deseja deletar este responsável técnico <label id="nomeDoEstabelecimento" style="font-weight:bold; font-family: 'Roboto', sans-serif;"></label>?</div>
                    {{-- <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;"><img src="{{ asset('/imagens/logo_bloqueado.png') }}" alt="Logo" style="width:15px; margin-right:5px;"/> Essa ação não poderá ser desfeita</div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" id="idRespTecnicoDelete" name="idRespTecnico" value="">
                    <input type="hidden" id="idEmpresa"           name="idEmpresa" value="">
                    <input type="hidden" id="idArea"              name="idArea" value="">
                    <div class="col-md-12" style="padding-left:0">
                        <button type="submit" class="btn btn-success botao-form" style="width:100%">
                                Sim, deletar responsável técnico
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">

    function myFunction($resptecId, $empresaId, $areaId) {
        // console.log($resptecId);
        // console.log($empresaId);
        // console.log($areaId);
        document.getElementById('idRespTecnicoDelete').value = $resptecId;
        document.getElementById('idEmpresa').value = $empresaId;
        document.getElementById('idArea').value = $areaId; 

    }
    
</script>

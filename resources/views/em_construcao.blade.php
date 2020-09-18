@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 0.5rem;">
        <div class="barraMenu" style="margin-top:2rem; margin-bottom:-2.5rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <img src="{{ asset('/imagens/logo_aviso2.png') }}" alt="Logo" style="width:100%; margin-top:10px; margin-bottom:10px;"/>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label style="font-size:35px;margin-top:10px;font-weight:bold;color:#6c63ff; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Oops!</label>
                            </div>
                            <div class="form col-md-12" style="margin-top:10px;">
                                <label style="font-weight:normal;font-size:22px; font-family: 'Roboto', sans-serif; color:#3f3d56; line-height:30px;">Página em construção</label>
                            </div>
                            <div class="form col-md-12" style="margin-top:10px;">
                                {{-- <label style="font-size:16px;font-family: 'Quicksand', sans-serif;">Seus dados encontram-se em avaliação, espere a sua aprovação para que possa ter acesso a outras funcionalidades do sistema. </label> --}}
                            </div>
                            <div class="form col-md-12" style="margin-top:220px;">
                                <a class="btn btn-success botao-form"  href="{{route("/")}}" style="weight:500px; color:white;">Clique aqui</a>
                                <label style="margin-left:10px; font-family: 'Roboto', sans-serif;"> para voltar à página inicial</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:0.5rem; margin-bottom:5rem;padding:0px;">
            <div class="container" style="margin-top:2rem;">
                <div class="row" style="padding-top:15px;">
                    <div class="col-6">
                        <a href="http://ww3.uag.ufrpe.br/" target="_blank" style="font-family: 'Roboto', sans-serif; text-decoration:none; color:black;">VISA-GARANHUNS foi desenvolvido pela Universidade Federal do Agreste de Pernambuco - UFAPE</a>
                    </div>
                    <div class="col-6" style="margin-top:-10px; text-align:right">
                        <img src="{{ asset('/imagens/logo_visa_menu.png') }}" alt="Logo" style="width:200px; margin-bottom:0px;"/>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

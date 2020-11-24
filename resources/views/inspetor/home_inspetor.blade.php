@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom:5%">
    <div class="form-row justify-content-center" style="margin-bottom:3rem; margin-top:1.5em">
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Programação</label>
                    </div>
                    {{-- <label style="margin-left:5px; font-family: 'Roboto', sans-serif;">Inspeções pendentes:</label> --}}
                    <div class="col-12">
                        <label class="cardDashboard_titulo" style="text-align:center; width:100%; font-size:13.7px">Inspeções pendentes</label>
                        <div class="form-group">
                            <div class="cardDashboard_titulo" style="text-align:center; width:100%; font-size:20px">{{$pendente}}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="cardDashboard_titulo" style="text-align:center; width:100%; font-size:13.2px">Inspeções completas</label>
                        <div class="form-group">
                            <div class="cardDashboard_titulo" style="text-align:center; width:100%; font-size:20px">{{$aprovado}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_megafone.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Applicativo</label>
                    </div>
                    @if($aviso == 1)
                        <label style="margin-left:5px; font-family: 'Roboto', sans-serif;">Dispositivo:</label>
                        <div style="text-align:center; width:100%; margin-top:15%"><img src="{{ asset('/imagens/logo_aprovado2.png') }}" alt="Logo" style="width:60px;margin-top:-9px; margin-right:5px; margin-bottom:10px;"/><label style="font-size: 20px; color:#909090">Seu aplicativo está instalado e pronto para ser utilizado.</label></div>
                    @else
                        <label style="margin-left:5px; font-family: 'Roboto', sans-serif;">Dispositivo:</label>
                        <div style="text-align:center; width:100%; margin-top:15%"><img src="{{ asset('/imagens/logo_error.png') }}" alt="Logo" style="width:50px;margin-top:-9px; margin-right:5px; margin-bottom:10px;"/><label style="font-size: 17px; color:#909090">Você ainda não baixou o nosso aplicativo.</label></div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

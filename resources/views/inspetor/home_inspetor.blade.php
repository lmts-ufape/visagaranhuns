@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom:10%">
    <div class="form-row justify-content-center" style="margin-bottom:3rem; margin-top:1.5rem">
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Programação</label>
                    </div>
                    <label style="margin-left:5px; font-family: 'Roboto', sans-serif;">Inspeções pendentes:</label>
                    <div style="text-align:center; width:100%; margin-top:15%"><label style="font-size: 50px; color:#909090">{{$pendente}}</label></div>

                    <div class="col-12" style="font-size:13.5px; margin-bottom:-0.4rem">
                        <ul style="margin-left:-5px; height:175px; width:175px;overflow: auto;">

                        </ul>
                    </div>
                    <div class="col-12" style="height:20px; text-align:right;">

                    </div>
                    <div class="col-12" style=" text-align:right;">

                    </div>
                </div>
            </div>
        </div>

        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Histórico</label>
                    </div>
                    <label style="margin-left:5px; font-family: 'Roboto', sans-serif;">Inspeções concluídas:</label>
                    <div style="text-align:center; width:100%; margin-top:15%"><label style="font-size: 50px; color:#909090">{{$aprovado}}</label></div>
                </div>
            </div>
        </div>

        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_megafone.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Avisos</label>
                    </div>
                    @if($aviso != "null")
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

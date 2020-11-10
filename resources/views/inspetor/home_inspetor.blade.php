@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom:10%">
    <div class="form-row justify-content-center" style="margin-bottom:3rem; margin-top:1.5rem">
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Programacao</label>
                    </div>
                    <div style="text-align:center; width:100%; margin-top:40%"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px;"/> Em construção</div>

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
                    <div style="text-align:center; width:100%; margin-top:40%"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px;"/> Em construção</div>
                    {{-- <div class="col-12" style="font-size:13.5px">Inspeções para <span style="font-weight:bold">setembro:</span></div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">09</div>
                    <div class="col-12" style="font-size:13.5px">Inspeções para <span style="font-weight:bold">outubro:</span></div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">02</div> --}}
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
                    <div style="text-align:center; width:100%; margin-top:40%"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; "/> Em construção</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

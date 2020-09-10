@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-row justify-content-center" style="margin-bottom:3rem; margin-top:1.5rem">
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_megafone.png') }}" alt="Logo" style="width:19px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Denúncias</label>
                    </div>
                    <div class="col-12">Denúncias em <span style="font-weight:bold">2020:</span></div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">85</div>
                    <div class="col-12">Denúncias não lidas:</div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">25</div>
                </div>
            </div>
        </div>
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Requerimento</label>
                    </div>
                    <div class="col-12" style="font-size:13.5px">Em aberto:</div>
                    <div class="col-12" style="margin-top:2rem;font-size:60px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">33</div>
                </div>
            </div>
        </div>
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_calendario.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Programação</label>
                    </div>
                    <div class="col-12" style="font-size:13.5px">Inspeções para <span style="font-weight:bold">setembro:</span></div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">09</div>
                    <div class="col-12" style="font-size:13.5px">Inspeções para <span style="font-weight:bold">outubro:</span></div>
                    <div class="col-12" style="margin-top:rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">02</div>
                </div>
            </div>
        </div>
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_predio.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Estabelecimentos</label>
                    </div>
                    <div class="col-12" style="font-size:13.5px">Pendentes</div>
                    <div class="col-12" style="font-size:13.5px">
                        <ul style="margin-left:-22px;">
                            <li>Estabelecimentos:</li>
                        </ul>
                    </div>
                    <div class="col-12" style="margin-top:-1.5rem;margin-bottom:-0.8rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">12</div>
                    <div class="col-12" style="font-size:13.5px">
                            <ul style="margin-left:-22px;">
                                <li>Documentos:</li>
                            </ul>
                        </div>
                        <div class="col-12" style="margin-top:-1.0rem;font-size:50px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">03</div>
                </div>
            </div>
        </div>
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Notificação</label>
                    </div>
                    <div class="col-12" style="font-size:13.5px">Pendentes</div>
                    <div class="col-12" style="margin-top:2.0rem;font-size:60px;text-align:center;font-weight:lighter;font-family:monospace;color:gray">65</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

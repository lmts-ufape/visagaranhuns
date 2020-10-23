@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom:30%">
    <div class="form-row justify-content-center" style="margin-bottom:3rem; margin-top:1.5rem">
        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_predio.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Estabelecimentos</label>
                    </div>
                    <div class="col-12" style="font-size:13.5px"></div>
                    <div class="col-12" style="font-size:13.5px">
                        <ul style="margin-left:-22px;">
                            @foreach($empresas->slice(0,10) as $item)
                                <li>
                                    <a href="{{ route('pagina.mostrar.empresa',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">{{$item->nome}}</a>
                                </li>
                            @endforeach
                            @if(count($empresas) >= 9)
                                <div style="text-align:right">
                                    <a href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'estabelecimentos']) }}">Ver todos</a>
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="cardDashboard">
            <div class="container">
                <div class="form-row">
                    <div class="col-12" style="margin-bottom:0.5rem;">
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Licenças</label>
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
                        <img src="{{ asset('/imagens/logo_papel.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px; margin-right:5px;"/>
                        <label class="cardDashboard_titulo">Documentação</label>
                    </div>
                    <div style="text-align:center; width:100%; margin-top:40%"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="width:17px; height:20px; margin-top:-5px;"/> Em construção</div>
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

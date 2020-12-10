@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 130px">
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
                    <div class="tituloBarraPrincipal"><label class="limiteDeTexto" style="margin-bottom:-0.3rem;">{{$titulo}}</label></div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Serviços > <label class="limiteDeTexto" style="margin-bottom:-0.3rem;">{{$titulo}}</label></div>
                    </div>
                </div>
            </div>
            <div class="p-2" style="width:50px;">
                {{-- <div class="dropdown" style="margin-top:10px">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        @if(count($secoes)>0)
                            @foreach ($secoes as $item)
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">{{$item->titulo}}</label>
                                    </div>
                                    <div class="form col-md-12" style="margin-top:-10px;">
                                        <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">{!! $item->descricao !!}</label>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row">
                                <div class="form-group col-md-12" style="margin-bottom:5rem;">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Página em construção</label>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection



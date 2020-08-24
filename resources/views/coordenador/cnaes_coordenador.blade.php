@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <a href="{{route('listagem.area')}}" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
            </div>
            {{-- <div class="p-2">
                <img src="{{ asset('/imagens/logo_lupa_1.png') }}" alt="Logo" style="margin-right:13px;"/>
            </div> --}}
            <div class="p-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Criar cnae</a>
                        {{-- <a class="dropdown-item" href="#">Editar área</a>
                        <a class="dropdown-item" href="#">Deletar área</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:14px; margin-left:20px;">CNAE</div>
    </div>
    <div class="container">
        <div class="row justify-content-left" style="margin-left:0px;">
            @if(count($cnaes)>0)
                @foreach ($cnaes as $item)
                    <div class="cardArea">
                        <div class="col-12" style="text-align:right;color:gray;margin-left:8px;">{{$item->codigo}}</div>
                        <div class="col-12" style="margin-top:-10px;">
                            @if(strlen($item->descricao) > 56)
                                @php
                                    $str = substr($item->descricao, 0, 56) . '...';
                                @endphp
                                <label style="width:100%; margin-top:10px;margin-left:-5px;margin-right:-20px;text-decoration:none;cursor:pointer;color:black;">{{$str}}</label>
                            @else
                                <label style="width:100%; margin-top:10px;margin-left:-5px;margin-right:-20px;text-decoration:none;cursor:pointer;color:black;">{{$item->descricao}}</label>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12" style="text-align:center;color:gray;font-weight:bold;margin-top:4rem; margin-bottom:5rem;font-size:20px;font-family:Arial, Helvetica, sans-serif;">Nenhum CNAE cadastrado!</div>
            @endif
        </div>
    </div>
    <!-- Paginacao -->
    <div class="col-md-12" style="margin-bottom:2rem;">
        <div class="row justify-content-center">
            <span>{{$cnaes->links()}}</span>
        </div>
        </div>
        <!--x Paginacao x-->
</div>
@endsection



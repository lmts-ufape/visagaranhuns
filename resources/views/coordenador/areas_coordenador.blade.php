@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <a href="{{route('home.coordenador')}}" style="text-decoration:none;cursor:pointer;color:black;">
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
                        <a class="dropdown-item" href="#">Criar área</a>
                        {{-- <a class="dropdown-item" href="#">Editar área</a>
                        <a class="dropdown-item" href="#">Deletar área</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:14px; margin-left:20px;">Áreas</div>
    </div>
    <div class="container">
        <div class="row justify-content-left" style="margin-left:0px;">
            {{-- @foreach ($areas as $item)
                <a href="{{ route('listagem.cnae',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="cardArea">
                        <div class="col-12" style="margin-top:10px;">{{$item->nome}}</div>
                    </div>
                </a>
            @endforeach --}}
            @if(count($areas)>0)
                @foreach ($areas as $item)
                    <a href="{{ route('listagem.cnae',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;cursor:pointer;color:black;">
                        <div class="cardArea">
                            <div class="col-12">
                                @if(strlen($item->nome) > 56)
                                    @php
                                        $str = substr($item->nome, 0, 56) . '...';
                                    @endphp
                                    <label style="width:100%; margin-top:10px;margin-left:-5px;margin-right:-20px;text-decoration:none;cursor:pointer;color:black;">{{$str}}</label>
                                @else
                                    <label style="width:100%; margin-top:10px;margin-left:-5px;margin-right:-20px;text-decoration:none;cursor:pointer;color:black;">{{$item->nome}}</label>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="col-12" style="text-align:center;color:gray;font-weight:bold;margin-top:4rem; margin-bottom:5rem;font-size:20px;font-family:Arial, Helvetica, sans-serif;">Nenhuma área cadastrada!</div>
            @endif
        </div>
    </div>
    <!-- Paginacao -->
    <div class="col-md-12" style="margin-bottom:2rem;">
        <div class="row justify-content-center">
            <span>{{$areas->links()}}</span>
        </div>
        </div>
        <!--x Paginacao x-->
</div>
@endsection



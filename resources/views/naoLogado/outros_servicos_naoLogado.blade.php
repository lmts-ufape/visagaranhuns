@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="form-row" style="margin-bottom:5rem;">
        <div class="col-md-12" style="margin-left:10px; font-family:'Roboto'; font-size:18px; margin-bottom:9px;">Outros Serviços</div>
        @foreach ($servicos as $item)
            <div class="form-group col-md-4">
                <a href="{{ route('home.informacao',["value"=>Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">
                    <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:{{$item->cor}}">
                        <div class="form-row">
                            <div class="col-12" style="height:80px;  text-align:right;">
                                    <img src="{{ $item->icone }}" alt="Logo" style="width:40px;"/>
                                </div>
                            <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px;">{{$item->titulo}}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

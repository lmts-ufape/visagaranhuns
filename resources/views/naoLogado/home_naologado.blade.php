@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom:15rem;">
    <a href="{{ route('home.cadastrar')}}" style="text-decoration:none;cursor:pointer;color:black;">
        <div class="cardAreaGrande">
            <div class="col-12" style="margin-top:85px;color:white">Cadastre sua empresa</div>
        </div>
    </a>
</div>
@endsection

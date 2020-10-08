@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
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
                    <div class="tituloBarraPrincipal">Requerimentos</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Empresa > Requerimentos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">

    </div>
    <div class="container">
        <div class="row justify-content-left" style="margin-left:0px;padding-bottom:20rem;">
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                    @csrf
                    <input type="hidden" name="resptecnico" value="{{$resptecnico}}">
                    <input type="hidden" name="empresa" value="{{$empresa}}">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de requerimento</label>
                        @if ($status == "aprovado2")
                        <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                            <option value="primeira_licenca" disabled>Primeira Licença</option>
                            <option value="renovacao">Renovação</option>
                        </select>
                        @elseif ($status == "aprovado")
                        <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                            <option value="primeira_licenca">Primeira Licença</option>
                            <option value="renovacao" disabled>Renovação</option>
                        </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Cnaes</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="cnae">
                            @foreach ($cnaes as $item)
                                <option value="{{$item->id}}">{{$item->codigo}} - {{$item->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Paginacao -->
    {{-- <div class="col-md-12" style="margin-bottom:2rem;">
        <div class="row justify-content-center">
            <span>{{$empresas->links()}}</span>
        </div>
    </div> --}}
    <!--x Paginacao x-->
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
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
                    <div class="tituloBarraPrincipal">Estabelecimentos</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Áreas > CNAE > Estabelecimentos</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="dropdown" style="margin-top:10px; width:20%;">
                    {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Criar cnae</a>
                        <a class="dropdown-item" href="#">Editar área</a> --}}
                        {{-- <a class="dropdown-item" href="#">Editar área</a>
                        <a class="dropdown-item" href="#">Deletar área</a> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="container" style="margin-top:1rem;">
        <div class="row justify-content-left" style="margin-left:0px;padding-bottom:20rem;">
            @if(count($empresas)>0)
                @foreach ($empresas as $item)
                    <div class="d-flex cardEmpresa">
                        <div class="mr-auto p-2">
                            <a style="text-decoration:none;cursor:null;color:black;">
                                <div class="btn-group">
                                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">{{$item->nome}}</div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('mostrar.empresas',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">
                                <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12" style="text-align:center;color:gray;font-weight:bold;margin-top:4rem; margin-bottom:5rem;font-size:20px;font-family:Arial, Helvetica, sans-serif;">Nenhuma empresa cadastrada!</div>
            @endif
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



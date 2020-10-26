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
                @if($tipo == "estabelecimentos")
                    <div class="form-group">
                        <div class="tituloBarraPrincipal">Estabelecimentos</div>
                        <div>
                            <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimentos</div>
                        </div>
                    </div>
                @elseif($tipo == "requerimentos")
                    <div class="form-group">
                        <div class="tituloBarraPrincipal">Requerimentos</div>
                        <div>
                            <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Requerimentos</div>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <div class="tituloBarraPrincipal">Documentação</div>
                        <div>
                            <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Documentação</div>
                        </div>
                    </div>
                @endif
            </div>
            @if($tipo == "estabelecimentos")
                <div class="p-2">
                    <div class="dropdown" style="margin-top:10px;">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        @if (Auth::user()->status_cadastro == "pendente")

                        @else
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('pagina.adicionar.empresa') }}">Cadastrar estabelecimento</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container">
        {{-- @if($tipo == "estabelecimentos")
            <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:14px; margin-left:20px;">Estabelecimentos</div>
        @elseif($tipo == "documentacao")
            <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:14px; margin-left:20px;">Documentação</div>
        @endif --}}
    </div>
    <div class="container">
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
                        @if($item->status_cadastro == "pendente")
                            <div class="p-2">
                                <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                    <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    <span class="btn-sm btn-warning">Pendente</span>
                                </div>
                            </div>
                        @else
                            <div class="p-2">
                                <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                    <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    <span class="btn-sm btn-success">Aprovado</span>
                                </div>
                            </div>
                        @endif
                        <div class="p-2">
                            @if($tipo == "estabelecimentos")
                                <a href="{{ route('pagina.mostrar.empresa',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            @elseif($tipo == "documentacao")
                                <a href="{{ route('pagina.mostrar.documentacao',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">
                                    @if ($item->status_cadastro == "aprovado")
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    @else
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px; width:35px;"></div>
                                    @endif
                                </a>
                            @elseif($tipo == "requerimentos")
                                <a href="{{ route('mostrar.requerimentos',["value" => Crypt::encrypt($item->id)]) }}" style="text-decoration:none;">
                                    @if ($item->status_cadastro == "aprovado")
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    @else
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px; width:35px;"></div>
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12" style="text-align:center;color:gray;font-weight:bold;margin-top:4rem; margin-bottom:5rem;font-size:20px;font-family:Arial, Helvetica, sans-serif;">Nenhuma empresa cadastrada!</div>
            @endif
        </div>
    </div>
    <!-- Paginacao -->
    <div class="col-md-12" style="margin-bottom:2rem;">
        <div class="row justify-content-center">
            <span>{{$empresas->links()}}</span>
        </div>
        </div>
    <!--x Paginacao x-->
</div>
@endsection



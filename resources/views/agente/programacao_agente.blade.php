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
                    <div class="tituloBarraPrincipal">Programação</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Programação</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                {{-- <div class="dropdown" style="width:50px"> --}}
                    {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                    </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:6rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">INSPEÇÕES</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            @if ($message = Session::get('message'))
                                <div class="alert alert-warning alert-block fade show">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            @if(count($inspecoes)>0)
                                <table class="table table-responsive-lg table-hover" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold; width:100%">Estabelecimento/Tipo/CNAE</th>
                                        <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold; margin-right:30px;">Data</th>
                                        <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                        <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Relatório</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inspecoes as $item)
                                            <tr>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">
                                                    <div class="btn-form">
                                                        @if($item->empresa != null)
                                                            <div style="font-weight:bold;">{{$item->empresa->nome}}</div>
                                                        @elseif($item->denuncia != null)
                                                            @if($item->denuncia->empresaRelacionamento != null) 
                                                                <div style="font-weight:bold;">{{$item->denuncia->empresaRelacionamento->nome}}</div>
                                                            @else
                                                                <div style="font-weight:bold;">{{$item->denuncia->empresa}}</div>
                                                            @endif
                                                        @endif

                                                        <div>{{$item->motivo}}</div>
                                                        @if ($item->motivoInspecao == "Denuncia")
                                                            <div></div>
                                                        @else
                                                            <div>{{$item->cnae}}</div>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{ date( 'd/m/Y' , strtotime($item->data))}}</th>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">
                                                    <div class="btn-group">
                                                        @if ($item->relatorio == null)
                                                            <div style="margin:5px;"><button type="button" class="btn btn-warning" disabled>Não Finalizado</button></div>
                                                        @else
                                                            @if ($item->relatorio->status == "reprovado")
                                                                <div style="margin:5px;"><a href="{{ route('show.relatorio.agente.verificar', ['relatorio' => Crypt::encrypt($item->relatorio->id), 'inspecao' => Crypt::encrypt($item->id)])}}" type="button" class="btn btn-danger">Reprovado</a></div>
                                                            @else
                                                                @if($item->relatorio->agentes()->where('aprovacao', 'reprovado')->count() > 0)
                                                                    <div style="margin:5px;"><a href="{{ route('show.relatorio.agente.verificar', ['relatorio' => Crypt::encrypt($item->relatorio->id), 'inspecao' => Crypt::encrypt($item->id)])}}" type="button" class="btn btn-danger">Reprovado</a></div>
                                                                @else 
                                                                    @if ($item->relatorio->agentes()->where([['aprovacao', 'aprovado'], ['agente_id', auth()->user()->agente->id]])->exists())
                                                                        <div style="margin:5px;"><a href="{{ route('show.relatorio.agente.verificar', ['relatorio' => Crypt::encrypt($item->relatorio->id), 'inspecao' => Crypt::encrypt($item->id)])}}" type="button" class="btn btn-success">Aprovado</a></div>
                                                                    @else 
                                                                        <div style="margin:5px;"><a href="{{ route('show.relatorio.agente', ['relatorio' => Crypt::encrypt($item->relatorio->id), 'inspecao' => Crypt::encrypt($item->id)])}}" type="button" class="btn btn-primary">Avaliar</a></div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div style="margin-bottom:5rem; text-align:center; font-size:19px;"> Nenhuma inspeção programada!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

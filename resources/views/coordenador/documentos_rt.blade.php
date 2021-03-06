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
                            <div class="tituloBarraPrincipal">Documentação do Responsável Técnico</div>
                            <div>
                                <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Documentação</div>
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


    <div class="barraMenu"style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                    <div class="form-row">
                        <div class="form-group col-md-12" >
                            <div>
                                {{-- <label style="color:black; font-size:35px;  margin-bottom:-10px; font-weight:400; font-family: 'Libre Baskerville', serif;;
                                ;">{{$empresa->nome}}</label> --}}
                            </div>
                            <div>
                                <div style="font-size:13px;margin-top:2px; margin-bottom:-10px;color:gray;">Início > Documentação do Responsável Técnico</div>
                            </div>
                            <hr size = 7 style="margin-bottom:-2px;">
                        </div>

                        <div class="form-group col-md-7">
                            @if($errors->any())
                                <div class="alert alert-warning alert-block fade show">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{$errors->first()}}</strong>
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block fade show">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-warning alert-block fade show">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DOCUMENTOS</label>
                                </div>

                                {{-- <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:2px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Obrigatórios:</label>
                                </div> --}}

                                {{-- @foreach ($areas as $item)
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:2px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">{{$item->nome}}</label>
                                </div> --}}

                                @foreach ($checklist as $indice)
                                        @if($indice->anexado == "false")
                                        <div class="form col-md-12">
                                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:3px"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:10px;"/> {{$indice->nomeDoc}} -
                                                <span style="color:#e1ad01">Pendente</span>
                                            </label>
                                        </div>
                                        @else
                                            @foreach ($docsrt as $docrt)
                                                @if ($docrt->resptecnicos_id == $indice->resptecnicos_id && $docrt->tipodocresp_id == $indice->tipodocres_id)
                                                <div class="form col-md-12">
                                                    <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:3px"><img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/> {{$indice->nomeDoc}} -
                                                        <a href="{{route('coordenador.download.arquivo.rt', ['file' => $docrt->nome])}}" target="_blank"> Baixar Anexo</a>
                                                    </label>
                                                    {{-- <a data-toggle="modal" data-target="#exampleModalCenter" onclick="findDocRt({{$docrt->id}})" style="cursor:pointer; color:#249BE3">- Editar Anexo</a> --}}
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    {{-- @endif --}}
                                {{-- @endforeach --}}
                                @endforeach


                            </div>
                        </div>
                    </div>
                    {{-- <hr size = 7 style="margin-bottom:-15px;"> --}}
                    <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">

                        </div>
                </div>
            </div>
    </div>
</div>
@endsection



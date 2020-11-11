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
                            <div class="tituloBarraPrincipal">Documentação</div>
                            <div>
                                <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Documentação > {{$nome}}</div>
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






    {{-- <div class="barraMenu" style="margin-top:0.7rem;"">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <div class="btn-group">
                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos - {{$item->nome}}</div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($checklist as $indice)
        @if ($indice->areas_id == $item->id)
        <div class="container" style="margin-bottom:1rem">

            <div class="cardDocumentos">
                <div class="d-flex justify-content-center">
                    <div class="mr-auto p-2">
                        <div class="form-group">
                            <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">{{$indice->nomeDoc}}<span style="color:red">*</span></div>
                            <div style="margin-left:10px; margin-bottom:-15px;">Data do envio: dd/mm/aaaa</div>
                        </div>
                    </div>
                    @if($indice->anexado == "false")
                        <div class="p-2">
                            <div class="form-row">
                                <div style="margin-top:1px;margin-right:15px;font-size:15px;">
                                    <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    <span class="btn-sm btn-warning">Pendente</span>
                                </div>
                                <div style="margin-top:1px;margin-right:15px;font-size:15px;" class="dropdown show">
                                    <a class="btn btn-secondary btn-sm" href="#" role="button" id="dropdownMenuLink" onclick="foundChecklist({{$indice->id}},{{$empresaId}})" data-toggle="modal" data-target="#exampleModalCenter">
                                        Anexar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="p-2">
                        <div class="form-row">
                            <div style="margin-top:1px;margin-right:15px;font-size:15px;">
                                <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                <span class="btn-sm btn-success">Anexado</span>
                            </div>
                            <div style="margin-top:1px;margin-right:15px;font-size:15px;" class="dropdown show">
                                <a class="btn btn-secondary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ação
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach ($docsempresa as $docempresa)
                                        @if ($docempresa->empresa_id == $indice->empresa_id)
                                            <a href="{{route('download.arquivo', ['file' => $docempresa->nome, "empresaId" => $empresaId, "areaId" => $item->id])}}" class="dropdown-item" href="#">Baixar</a>
                                        @endif
                                    @endforeach
                                    <a class="dropdown-item" href="#">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Anexar Arquivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="arquivo" class="btn btn-primary">Anexar</button>
                </div>
            </div>
            </div>
        </div>
        @endif
    @endforeach --}}


    <div class="barraMenu"style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                    <div class="form-row">
                        <div class="form-group col-md-12" >
                            <div>
                                <label style="color:black; font-size:35px;  margin-bottom:-10px; font-weight:400; font-family: 'Libre Baskerville', serif;;
                                ;">{{$nome}}</label>
                            </div>
                            <div>
                                <div style="font-size:13px;margin-top:2px; margin-bottom:-10px;color:gray;">Início > Estabelecimentos > {{$nome}} > Documentos </div>
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
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DOCUMENTOS REQUERIDOS</label>
                                </div>

                                {{-- <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:2px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Obrigatórios:</label>
                                </div> --}}

                                {{-- @foreach ($areas as $item)
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:2px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">{{$item->nome}}</label>
                                </div> --}}
                                @foreach ($areas as $item)
                                    <div class="form-group col-md-12">
                                        <label style="font-size:14px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">{{$item->nome}}</label>
                                    </div>
                                    @foreach ($checklist as $indice)
                                        @if ($indice->areas_id == $item->id)
                                            @if($indice->anexado == "false")
                                            <div class="form col-md-12">
                                                <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:3px"><img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:10px;"/> {{$indice->nomeDoc}} -

                                                    <span style="color:#e1ad01">Pendente</span>
                                                </label>
                                            </div>
                                            @else
                                                @foreach ($docsempresa as $docempresa)
                                                    @if ($docempresa->empresa_id == $indice->empresa_id && $docempresa->tipodocemp_id == $indice->tipodocemp_id && $docempresa->area == $indice->areas_id)
                                                        <div class="form col-md-12">
                                                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:3px"><img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/> {{$indice->nomeDoc}} -
                                                                <a href="{{route('download.arquivo', ['file' => $docempresa->nome])}}"> Baixar arquivo</a>
                                                            </label>
                                                            <a data-toggle="modal" data-target="#exampleModalCenter" onclick="findDoc({{$docempresa->id}})" style="cursor:pointer; color:#249BE3">- Substituir arquivo</a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Arquivo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editDocForm" method="POST" action="{{ route('editar.arquivos') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form col-md-12" >
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Emissão</label>
                                                    <input type="date" class="form-control" placeholder="" id="data_emissao_edit" name="data_emissao_editar">
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Validade</label>
                                                    <input type="date" class="form-control" placeholder="" id="data_validade_edit" name="data_validade_editar">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form col-md-12">
                                          <label for="exampleFormControlFile1">Substituir arquivo</label>
                                          <input id="editarDoc" type="hidden" name="file" value="">
                                          <input id="empresa_id" type="hidden" name="empresa_id" value="{{$empresaId}}">
                                          <input type="file" class="form-control-file" id="arquivoSelecionado_edit" name="arquivo" onchange="verificarArquivoAnexado_Empresa_Edit()">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" form="editDocForm" class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="form col-md-5" style="margin-top:10px;">
                            <div class="form-row">
                                <form id="arquivo" method="POST" action="{{route('anexar.arquivos')}}" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-bottom:-5px; font-family: 'Roboto', sans-serif;">ANEXAR DOCUMENTO</label>
                                </div>


                                    <input id="empresa" type="hidden" name="empresaId" value="{{$empresaId}}">
                                    <div class="form col-md-12" style="margin-top:1px;margin-bottom:10px;">
                                        <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Tipo de documento <span style="font-size:20px;color:red">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="tipodocempresa" required>
                                            <option disabled selected>Tipos de documentos</option>
                                            @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form col-md-12" >
                                        <div class="row">
                                            <div class="col">
                                                <label for="data_emissao" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Áreas <span style="font-size:20px;color:red">*</span></label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="area" required>
                                                    <option disabled selected>Áreas</option>
                                                    @foreach ($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form col-md-12" >
                                            <div class="row">
                                                <div class="col">
                                                    <label for="data_emissao" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Emissão <span style="font-size:20px;color:red">*</span></label>
                                                    <input type="date" class="form-control" id="data_emissao" placeholder="" name="data_emissao" required>
                                                </div>
                                                <div class="col">
                                                    <label for="data_validade" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Validade<span style="font-size:20px;color:red"></span></label>
                                                    <input type="date" class="form-control" id="data_validade" placeholder="" name="data_validade">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form col-md-12" style="margin-top: 30px">
                                        <input type="file" class="form-control-file" id="arquivoSelecionado_empresa" name="arquivo" required onchange="verificarArquivoAnexado_Empresa()">
                                        <label for="" style="color:red;margin-top:4px;">Arquivo no formato PDF e tamanho máximo de 5mb</label>
                                    </div>
                                    <div class="form col-md-12" style="margin-top: 20px">
                                        <button type="submit" class="btn btn-success" style="width:100%;">Enviar</button>
                                    </div>
                                    <hr style="margin-top: 40px; margin-bottom:10px">
                                    <div class="col-md-12">
                                        <label style="font-weight:bold; color:red; font-family:Arial, Helvetica, sans-serif"><span style="font-size:20px">*</span> campos obrigatórios</label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        </div>

                    </div>
                    {{-- <hr size = 7 style="margin-bottom:-15px;"> --}}
                    <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">

                        </div>
                    </form>
                </div>
    </div>
</div>
<!-- Modal de Aviso -->
<div class="modal fade" id="exampleModalAnexarDocumentoEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="idCorCabecalhoModalDocumentoEmpresa">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="idTituloDaMensagemModalDocumentoEmpresa"></label></div>
                        <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Aviso Edit -->
<div class="modal fade" id="exampleModalAnexarDocumentoEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="idCorCabecalhoModalDocumentoEdit">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="idTituloDaMensagemModalDocumentoEdit"></label></div>
                    <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    window.findDoc = function($id){
        console.log($id);
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}encontrar/doc',
            type:"get",
            dataType:'json',
            data: {"id": $id},
            success: function(response){
                console.log(response.data_emissao);
                $('#editarDoc').val(response.nome);
                $('#data_emissao_edit').val(response.data_emissao);
                $('#data_validade_edit').val(response.data_validade);
            }
        });
    }
</script>

@endsection



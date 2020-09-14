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
                    <div class="btn-group">
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;margin-bottom:-5px">Documentos</div>
                    </div>
                </div>
                <div class="p-2">
                    <div style="width:70px">
                    </div>
                </div>
            </div>
        </div>
    <div class="container" style="margin-top:1rem;">

        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif"><img src="{{ asset('/imagens/logo_predio.png') }}" alt="Logo" style="width:22px; height:26px; margin-top:-5px; margin-right:5px;"/>{{$nome}}</div>
                    <div><span style="font-weight:bold">CNPJ: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Tipo: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Última alteração: </span>dd/mm/aaaa</div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif; color:green"><img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="width:20px; height:20px; margin-top:-5px; margin-right:5px;"/>Aprovado</div>
                    <div><span style="font-weight:bold">Nome do inspetor: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Código do inspetor: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Data da aprovação: </span>dd/mm/aaaa</div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif"><img src="{{ asset('/imagens/logo_atencao2.png') }}" alt="Logo" style="width:22px; height:20px; margin-top:-5px; margin-right:5px;"/>Aviso!</div>
                    <div><span style="font-weight:normal">Toda modificação de documentos deverá passar pela aprovação da Vigilância Sanitária de Garanhuns!</span></div>
                </div>
            </div>

        </div>
    </div>

    @foreach ($areas as $item)

    <div class="barraMenu" style="margin-top:0.7rem;"">
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
                    <form id="arquivo" method="POST" action="{{route('anexar.arquivos')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="arquivo" id="exampleFormControlFile1" required>
                            <label for="inicioSubmissao" class="col-form-label">{{ __('Início da Submissão') }}</label>
                            <input id="inicioSubmissao" type="date" class="form-control @error('inicioSubmissao') is-invalid @enderror" name="data" required>
                            <input id="foundChecklist" type="hidden" name="checklistId" value="">
                            <input id="foundEmpresa" type="hidden" name="empresaId" value="">
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="arquivo" class="btn btn-primary">Anexar</button>
                </div>
            </div>
            </div>
        </div>
        @endif
    @endforeach

    @endforeach

</div>
@endsection



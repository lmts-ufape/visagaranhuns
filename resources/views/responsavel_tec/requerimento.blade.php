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
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > {{$nome}} > Requerimentos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">LISTA DE CNAE</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Código</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">CNAE</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Tipo</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(isset($resultados))
                                        @foreach($resultados as $item)
                                            <tr>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->codigo}}</th>
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->descricao}}</th>
                                                {{-- tipo --}}
                                                @if($item->tipo == "")
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black"></th>
                                                @else
                                                    @if($item->tipo == "primeira_licenca")
                                                        <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">Primeira licença</th>
                                                    @elseif($item->tipo == "renovacao")
                                                        <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">Renovação</th>
                                                    @endif
                                                @endif
                                                {{-- status --}}
                                                @if($item->status == "")
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black; cursor:pointer;" onclick="statusCNAERequisicaoRT('criarRequisicao','{{$item->descricao}}',null, '{{$item->id}}')" data-toggle="modal" data-target="#requerimentoCnaeRequisicaoRTModal">Nenhum requerimento</th>
                                                @elseif($item->status == "aprovado")
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:#0e6b0e; cursor:pointer;" onclick="statusCNAERequisicaoRT('aprovado','{{$item->descricao}}',null,null)" data-toggle="modal" data-target="#statusCnaeRequisicaoRTModalAprovado"><img src="{{ asset('/imagens/logo_aprovado.png') }}" width="20px" alt="Logo" style="margin-right:13px;"/> Aprovado</th>
                                                @elseif($item->status == "reprovado")
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:#c4302b; cursor:pointer;" onclick="statusCNAERequisicaoRT('reprovado','{{$item->descricao}}','{{$item->aviso}}',null)" data-toggle="modal" data-target="#statusCnaeRequisicaoRTModalReprovado"><img src="{{ asset('/imagens/logo_atencao4.png') }}" width="20px" alt="Logo" style="margin-right:13px;"/> Reprovado</th>
                                                @elseif($item->status == "pendente")
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:#e1ad01;"><img src="{{ asset('/imagens/logo_atencao.png') }}" width="22px" alt="Logo" style="margin-right:13px;"/>Pendente</th>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th></th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">Nenhum cnae cadastrado.</th>
                                            <th></th>
                                            <th></th>
                                        </tr>

                                    @endif
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal - cnae aprovado-->
<div class="modal fade" id="statusCnaeRequisicaoRTModalAprovado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_aprovado.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#00b300; font-weight:bold; font-family: 'Roboto', sans-serif;">CNAE aprovado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Cnae <label id="descricaoCNAERT" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> xxxx</label> aprovado!</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - cnae reprovado-->
<div class="modal fade" id="statusCnaeRequisicaoRTModalReprovado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_atencao4.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#940405; font-weight:bold; font-family: 'Roboto', sans-serif;">CNAE reprovado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Cnae <label id="descricaoCNAERTreprovado" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label> reprovado!</div>

                    <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                        <label style="font-weight:normal; font-family: 'Roboto', sans-serif;">Motivo da reprovação: </label>
                        <label id="avisoCNAERTreprovado" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - cnae requerimento-->
<div class="modal fade" id="requerimentoCnaeRequisicaoRTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#2a9df4;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Criar requerimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" style="font-family: 'Roboto', sans-serif;">Criar requerimento para o CNAE <label id="criarRequerimentoCNAERT" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label> ?</div>

                            <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                                <input type="hidden" name="resptecnico" value="{{$resptecnico}}">
                                <input type="hidden" name="empresa" value="{{$empresas->id}}">
                                <input type="hidden" name="cnae" id="idCnaeRequerimentoRT">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de requerimento</label>
                                    @if ($status == "aprovado2" || $status == "renovacao")
                                    <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                        <option value="primeira_licenca" disabled>Primeira Licença</option>
                                        <option value="renovacao">Renovação</option>
                                    </select>
                                    @elseif ($status == "aprovado" || $status == "primeira_licenca")
                                    <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                        <option value="primeira_licenca">Primeira Licença</option>
                                        <option value="renovacao" disabled>Renovação</option>
                                    </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Cancelar</button>
                        <button type="submit" class="btn btn-success" style="width:200px;">Sim, criar requerimento</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection



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
                    <div class="tituloBarraPrincipal">Histórico de Inspeções</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > Inspeções > Histórico</div>
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
                        <div class="form-group col-md-6">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">INSPEÇÕES</label>
                        </div>
                        <div class="form-group col-md-6" style="align-content: right">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; margin-left:435px; font-family: 'Roboto', sans-serif;"><a href="{{ route('listagem.area') }}">BAIXAR</a>
                            </label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-responsive-lg table-hover" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold; margin-right:30px;">Data</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Inspetor</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Agente</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Agente</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Empresa</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Cnae</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($inspecoes as $item)
                                        <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->data}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspetor}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->agente}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->agente}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->empresa}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->cnae}}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Aviso -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Avisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif;"></div>
                    </div>
                </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal - Checklist completo-->
<div class="modal fade" id="statusCompleto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_aprovado.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#00b300; font-weight:bold; font-family: 'Roboto', sans-serif;">Checklist Completa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="descricaoCNAERT" style="font-weight:bold; font-family: 'Roboto', sans-serif;"></label>Os documentos para o checklist deste cnae foram todos anexados.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - Checklist pendente-->
<div class="modal fade" id="statusPendente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_atencao4.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#940405; font-weight:bold; font-family: 'Roboto', sans-serif;">Checklist Pendente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="descricaoCNAERTreprovado" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label>Algum documento para o checklist deste cnae ainda está pendente!</div>
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
                                {{-- <input type="hidden" name="resptecnico" value="{{$resptecnico}}">
                                <input type="hidden" name="empresa" value="{{$empresas->id}}">
                                <input type="hidden" name="cnae" id="idCnaeRequerimentoRT"> --}}
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de requerimento</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                        <option id="priLicenca" value="primeira_licenca">Primeira Licença</option>
                                        <option id="renoLicenca" value="renovacao">Renovação</option>
                                    </select>
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

{{-- <script type="text/javascript">
    window.onload= function() {
        $.ajax({
            url:'/requerimento',
            type:"get",
            dataType:'json',
            data: {"filtro": "all" },
            success: function(response){
                $('tbody_').html(response.table_data);
            }
        });
    };
</script> --}}
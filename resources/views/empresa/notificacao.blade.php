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
                    <div class="tituloBarraPrincipal">Notificações</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > {{$empresa->nome}} > Notificações</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:9rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">NOTIFICAÇÕES</label>
                        </div>
                        @if ($message = Session::get('error'))
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong style="margin-right: 30px;">{{$message}}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong style="margin-right: 30px;">{{$message}}</strong>
                            </div>
                        @endif
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Motivo</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">CNAE</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Notificação</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($notificacoes as $item)
                                        <tr>
                                            <input type="hidden" id="avisoTempRequerimentoRt{{$item->id}}" value="{{ $item->notificacao }}">
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspecao->motivo}}</th>
                                            @if ($item->inspecao->motivo == 'Denuncia')
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black"></th>
                                            @else
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspecao->requerimento->cnae->descricao}}</th>
                                            @endif
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="avisoReqRt('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
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

<!-- Modal de Notificação -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Notificação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif; margin-bottom:10px;">Descrição da notificação:</div>
                        <div class="col-12"><textarea name="avisoRequerimentoRt" id="summary-ckeditor" cols="30" rows="10" disabled></textarea></div>
                    </div>
                </div>
        </form>
        </div>
    </div>
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>

@endsection

<script type="text/javascript">
    window.statusCNAERequisicaoRT = function($flag, $descricao, $aviso, $idCnae, $respTecnico, $empresa){

    $.ajax({
        url:'{{ config('prefixo.PREFIXO') }}cnae/encontrar',
        type:"get",
        dataType:'json',
        data: {'cnaeId': $idCnae,
               'respTecnico': $respTecnico,
               'empresa': $empresa,
        },
        success: function(response){
            console.log(response.tipo);
            if (response.tipo == "Primeira Licenca") {
                console.log("Primeira Licenca");
                if (response.valor == "pendente") {
                    $("option[value='Primeira Licenca']").prop("disabled", true);
                    $("option[value='Renovacao']").prop("disabled", true);
                }else if (response.valor == "aprovado") {
                    $("option[value='Primeira Licenca']").prop("disabled", true);
                    $("option[value='Renovacao']").prop("disabled", false);
                }else {
                    $("option[value='Primeira Licenca']").prop("disabled", false);
                    $("option[value='Renovacao']").prop("disabled", true);
                }
            }else if (response.tipo == "Renovacao"){
                console.log("Renovacao");
                if (response.valor == "pendente") {
                    $("option[value='Primeira Licenca']").prop("disabled", true);
                    $("option[value='Renovacao']").prop("disabled", true);
                }else if (response.valor == "aprovado") {
                    $("option[value='Primeira Licenca']").prop("disabled", true);
                    $("option[value='Renovacao']").prop("disabled", false);
                }else {
                    $("option[value='Primeira Licenca']").prop("disabled", true);
                    $("option[value='Renovacao']").prop("disabled", false);
                }
            }else if (response.tipo == "nenhum") {
                console.log("Né");
                $("option[value='Primeira Licenca']").prop("disabled", false);
                $("option[value='Renovacao']").prop("disabled", true);
            }
        }
    });

    if($flag == "reprovado"){

        document.getElementById('descricaoCNAERTreprovado').innerHTML = $descricao;
        document.getElementById('avisoCNAERTreprovado').innerHTML = $aviso;

    }else if($flag == "aprovado"){

        document.getElementById('descricaoCNAERT').innerHTML = $descricao;

    }else if($flag == "criarRequisicao"){

        document.getElementById('criarRequerimentoCNAERT').innerHTML = $descricao;
        document.getElementById('idCnaeRequerimentoRT').value = $idCnae;
    }
}

</script>

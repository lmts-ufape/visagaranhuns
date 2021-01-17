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
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">INSPEÇÕES</label>
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
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Inspetor</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Notificações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($inspecoes as $item)
                                        <tr>
                                            {{-- <input type="hidden" id="avisoTempRequerimentoRt{{$item->id}}" value="{{ $item->notificacao }}"> --}}
                                            @if ($item->motivo == "Primeira Licenca")
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">Primeira Licença</th>    
                                            @elseif ($item->motivo == "Denuncia")
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">Denúncia</th>
                                            @endif
                                            @if ($item->motivo == 'Denuncia')
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black"></th>
                                            @else
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->requerimento->cnae->descricao}}</th>
                                            @endif
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspetor->user->name}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="notificacoes('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
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
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Notificações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="form col-md-12" style="margin-top:-10px;">
                        <table class="table table-hover">
                            <thead> 
                                <tr>
                                <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Item</th>
                                <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Exigência</th>
                                <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Prazo (Qt. Dias)</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    window.notificacoes = function($id){
        
        $.ajax({
            url:'{{ config('prefixo.PREFIXO') }}estabelecimento/encontrar/notificacoes',
            type:"get",
            dataType:'json',
            data: {"id": $id},
            success: function(response){
                console.log(response.table_data);
                $('#tbody').html(response.table_data);
            }
        });
    }

</script>

@endsection

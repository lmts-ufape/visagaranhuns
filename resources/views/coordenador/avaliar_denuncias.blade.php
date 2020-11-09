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
                    <div class="tituloBarraPrincipal">Denúncias</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > {{$empresa->nome}} > Denúncias</div>
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
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">DENÚNCIAS</label>
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
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Nome</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">E-mail</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Telefone</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Status</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Relato</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black; font-weight:bold">Avaliar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($denuncias as $item)
                                    <tr>
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->nome}}</th>
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->email}}</th>
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->telefone}}</th>
                                        @if ($item->status == "pendente")
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Pendente</th>
                                        @elseif ($item->status == "Acatado")
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Acatado</th>
                                        @elseif ($item->status == "Arquivado")
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black">Arquivado</th>
                                        @endif
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denuncia('{{$item->denuncia}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</button></th>
                                        <th class="subtituloBarraPrincipal" style="font-size:15px; text-align:center; vertical-align:middle; color:black"><button type="button" class="btn btn-primary btn-sm" style="font-size:15px;" onclick="denunciaId('{{$item->id}}')" data-toggle="modal" data-target="#exampleModalLabelB">Avaliar</button></th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Relato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif; margin-bottom:10px;">Relato descrito pelo denunciante:</div>
                        <div class="col-12"><textarea name="modalDenuncia" id="modalDenuncia" disabled></textarea></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal - Avaliar Denúncia-->
<div class="modal fade" id="exampleModalLabelB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#2a9df4;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabelB" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Avaliar Denúncia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;">Você deseja arquivar ou acatar o esta denúncia para a empresa <label id="nomeDoEstabelecimento" style="font-weight:bold; font-family: 'Roboto', sans-serif;">{{$empresa->nome}}</label>?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('avaliar.denuncia') }}">
                        @csrf

                        <input  type="hidden" name="empresa"       value="{{$empresa->id}}">
                        <input  type="hidden" name="decisao"       value="false">
                        <input  type="hidden" name="denunciaId"    id="denunciaIdArquivar" value="">

                        <div class="col-md-12" style="padding-right:0">
                            <button type="submit" class="btn btn-outline-secondary botao-form" style="width:100px;">Arquivar</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('avaliar.denuncia') }}">
                        @csrf

                        <input  type="hidden" name="empresa"       value="{{$empresa->id}}">
                        <input  type="hidden" name="decisao"       value="true">
                        <input  type="hidden" name="denunciaId"    id="denunciaIdAcatar" value="">

                        <div class="col-md-12" style="padding-right:0">
                            <button type="submit" class="btn btn-outline-secondary botao-form" style="width:100%">
                                Acatar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

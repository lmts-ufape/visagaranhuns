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
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Empresa > Requerimentos</div>
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
                                    <th scope="col">Código</th>
                                    <th scope="col">Cnae</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cnaeRequerimento as $item)
                                        <tr>
                                            <th>{{$item->codigo}}</th>
                                            <td>{{$item->descricao}}</td>
                                            <td>{{$item->tipo}}</td>
                                            <td>{{$item->status}}</td>
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

    {{-- <div class="container">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2">Aprovar cadastro</button>
    </div> --}}
    <div class="container">
        <div class="row justify-content-left" style="margin-left:0px;padding-bottom:20rem;">
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                    @csrf
                    <input type="hidden" name="resptecnico" value="{{$resptecnico}}">
                    <input type="hidden" name="empresa" value="{{$empresa}}">
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
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Cnaes</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="cnae">
                            @foreach ($cnaes as $item)
                                <option value="{{$item->id}}">{{$item->codigo}} - {{$item->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal - tipo de requerimento-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#3ea81f;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Aprovar cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Tem certeza de que deseja aprovar o cadastro do estabelecimento <label id="nomeDoEstabelecimento" style="font-weight:bold; font-family: 'Roboto', sans-serif;">sadsa</label>?</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <form method="POST">
                    @csrf
                    <div class="col-md-12" style="padding-right:0">
                        <button type="submit" class="btn btn-success botao-form" style="width:100%">
                            Sim, aprovar cadastro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



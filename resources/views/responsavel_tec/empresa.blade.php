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
                    <div class="tituloBarraPrincipal">Perfil do estabelecimento</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimentos > {{$empresa->nome}} </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="dropdown" style="width:50px">
                    {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">
                <div class="form-group col-md-12" >
                    <div class="d-flex justify-content-center">
                        <div class="mr-auto p-2 ">
                            <div class="btn-group">
                                <div style="color:black; font-size:35px;  margin-bottom:-10px; font-weight:400; font-family: 'Libre Baskerville', serif;">{{$empresa->nome}}</div>
                            </div>
                        </div>
                        <div class="p-2" style="margin-top:16px;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {{-- <a class="dropdown-item" style="cursor:pointer" href="{{ route('cadastrar.rt.pagina', ['empresaId' => $empresaId]) }}" onclick="editarEstabelecimento()" disabled>Cadastrar Resp. Técnico</a> --}}
                                    {{-- <a class="dropdown-item" style="cursor:pointer">Cadastrar Resp. Técnico</a> --}}
                                    {{-- <a class="dropdown-item" style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" onclick="deletarEstabelecimento('{{$empresa->user->name}}')">Deletar Resp. Técnico</a> --}}
                                    {{-- <a class="dropdown-item" style="cursor:pointer">Deletar Resp. Técnico</a> --}}
                                    <a class="dropdown-item" style="cursor:pointer" href="{{ route('rt.documentacao.empresa', ['empresa' => Crypt::encrypt($empresaId)]) }}">Documentos</a>
                                    <a class="dropdown-item" style="cursor:pointer" href="{{ route('criar.requerimento', ['empresa' => Crypt::encrypt($empresaId)]) }}">Requerimento</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr size = 7 style="margin-bottom:-2px;">
                </div>

                <div class="form-group col-md-7">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">INFORMAÇÕES DO ESTABELECIMENTO</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Nome: </label>
                            <span style="color:#707070">{{$empresa->nome}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">CNPJ: </label>
                            <span style="color:#707070">{{$empresa->cnpjcpf}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Tipo: </label>
                            <span style="color:#707070">{{$empresa->tipo}}</span>
                        </div>

                        <div class="form-group col-md-12">
                            <label style="margin-top:10px;margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Endereço</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="margin-bottom:-15px; font-weight:normal;font-family: 'Roboto', sans-serif;">Rua: </label>
                            <span style="margin:0px;color:#707070">{{$endereco->rua}},</span>
                            <span style="margin:0px;color:#707070"> nº{{$endereco->numero}},</span>
                            <span style="margin:0px;color:#707070"> {{$endereco->bairro}},</span>
                            <span style="margin:0px;color:#707070"> {{$endereco->cidade}}/{{$endereco->uf}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:1px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">CEP: </label>
                            <span style="color:#707070">{{$endereco->cep}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Complemento: </label>
                            <span style="color:#707070">{{$endereco->complemento}}</span>
                        </div>


                        <div class="form-group col-md-12">
                            <label style="margin-top:10px;margin-bottom:-5px;font-family: 'Roboto', sans-serif;">Contato</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">E-mail: </label>
                            <span style="color:#707070">{{$empresa->email}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Telefone 1: </label>
                            <span style="color:#707070">{{$telefone->telefone1}}</span>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;margin-bottom:-30px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Telefone 2: </label>
                            <span style="color:#707070">{{$telefone->telefone2}}</span>
                        </div>
                    </div>
                </div>
                <div class="form col-md-5" style="margin-top:10px;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                                <label style="font-size:19px;margin-bottom:-5px; font-family: 'Roboto', sans-serif;">INFORMAÇÕES DO REPRESENTANTE LEGAL</label>
                            </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Nome: </label>
                            <span style="color:#707070">{{$empresa->user->name}}</span>
                        </div>
                        {{-- <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">CPF: </label>
                            <span style="color:#707070">000.000.000-00</span>
                        </div> --}}
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">E-mail: </label>
                            <span style="color:#707070">{{$empresa->user->email}}</span>
                        </div>
                        {{-- <div class="form col-md-12" style="margin-top:-10px;">
                            <label style="font-weight:normal;font-family: 'Roboto', sans-serif;">Telefone: </label>
                            <span style="color:#707070">(00) 0000-0000</span>
                        </div> --}}
                    </div>
                </div>


                <div class="form-group col-md-12" style="margin-top:15px;">
                    <label style="font-size:19px; margin-top:0px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">CNAE</label>
                </div>
                @foreach($cnae as $item)
                    <div class="form col-md-12" style="margin-top:-10px;margin-left:0px">
                        <img src="{{ asset('/imagens/logo_ponto.png') }}" alt="Logo" style="margin-top:-5px; margin-right:5px;"/>
                        <label style="  ">{{$item->cnae->codigo}} </label> |
                        <span style="color:#707070">{{$item->cnae->descricao}}</span>
                    </div>
                @endforeach
            </div>
            {{-- <hr size = 7 style="margin-bottom:-15px;"> --}}
            <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Requerimento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formRequerimento">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Tipo</label>
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option>Primeira Licença</option>
                        <option>Renovar de Licença</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Cnae</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option>Cnaes</option>
                        </select>
                      </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" form="formRequerimento" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        </div>
    </div> --}}
</div>
@endsection
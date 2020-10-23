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
                    <div class="tituloBarraPrincipal">Gerenciar conteúdo</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Gerenciar conteúdo</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="dropdown" style="margin-top:10px; width:20%;">
                    {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Criar cnae</a>
                        <a class="dropdown-item" href="#">Editar área</a> --}}
                        {{-- <a class="dropdown-item" href="#">Editar área</a>
                        <a class="dropdown-item" href="#">Deletar área</a> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="barraMenu" style="margin-top:2rem; margin-bottom:5rem;padding:15px;">
        <div class="d-flex justify-content-center">
            <div class="mr-auto p-2 ">
                <label style="font-size:19px;margin-top:-10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">Serviços cadastrados</label>
            </div>
            <div class="p-2">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adicionarServicoModal">
                    Novo serviço
                </button>
            </div>
        </div>
        <div class="form-group col-md-12" style="margin-top:10px;">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" style="width:20px;">Posição</th>
                    <th scope="col" style="width:100%;">Titulo</th>
                    <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $cont=1;  ?>
                    @foreach ($servicos as $item)
                        <tr>
                            <th>
                                <div class="btn-group">
                                    <label style="margin-right:5px; margin-top:1.5px;">{{$cont}}</label>
                                    <div class="form-group">
                                        <a style="cursor:pointer;" onclick="subirPosicaoServico({{$item->id}},{{$item->posicao}})"><img src="{{ asset('/imagens/logo_subir.png') }}" alt="Logo" width="14px"/></a>
                                        <a style="cursor:pointer;" onclick="descerPosicaoServico({{$item->id}},{{$item->posicao}})"><img src="{{ asset('/imagens/logo_descer.png') }}" alt="Logo" width="14px"/></a>
                                    </div>
                                </div>
                            </th>
                            <td class="limiteDeTexto"><a href="{{ route('secao.index', ['id' => Crypt::encrypt($item->id)])}}">{{$item->titulo}}</a></td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm" style="margin-right:10px;" onclick="editarServicoModal({{$item->id}},'{{$item->titulo}}');" data-toggle="modal" data-target="#editarServicoModal">
                                    <img src="{{ asset('/imagens/logo_editar.png') }}" alt="Logo" width="17px"/>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deletarServicoModal({{$item->id}},'{{$item->titulo}}')" data-toggle="modal" data-target="#deletarServicoModal">
                                    <img src="{{ asset('/imagens/logo_lixo.png') }}" alt="Logo" width="15px"/>
                                </button>
                            </td>
                        </tr>
                        <?php  $cont=$cont+1;  ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Criar um novo servico-->
<div class="modal fade" id="adicionarServicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#120a8f;">
                    <img src="{{ asset('/imagens/logo_folha.png') }}" alt="Logo" width="20px" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Novo serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">

                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Título</div>
                    <div class="col-12"><input type="text" class="form-control" id="idTitulo"></div>

                    {{-- <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">Ícone</div>
                    <div class="col-12">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected>Selecione o ícone...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> --}}

                    {{-- <div class="col-12" style="font-family: 'Roboto', sans-serif;">Cor</div>
                    <div class="col-12"><input type="text" class="form-control" ></div> --}}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <button type="submit" class="btn btn-success botao-form" data-dismiss="modal" onclick="criarServico()">Criar serviço</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Deletar um servico-->
<div class="modal fade" id="deletarServicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:red;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Deletar serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Tem certeza de que deseja deletar o serviço <label id="nomeDoServicoDeletar" style="font-weight:bold; font-family: 'Roboto', sans-serif;">xxx</label> ?</div>
                    <input type="hidden" id="idServicoDeletar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <button type="submit" class="btn btn-success botao-form"  data-dismiss="modal" onclick="deletarServico(idServicoDeletar)">Sim, deletar serviço</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar um servico-->
<div class="modal fade" id="editarServicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#949494;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Editar serviço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;">Título</div>
                        <div class="col-12"><input type="text" class="form-control" id="nomeDoServicoEditar"></div>
                        <input type="hidden" id="idServicoEditar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                    <button type="submit" class="btn btn-success botao-form"  data-dismiss="modal" onclick="editarServico(idServicoEditar, nomeDoServicoEditar)">Sim, editar serviço</button>
                </div>
            </div>
        </div>
    </div>


@endsection



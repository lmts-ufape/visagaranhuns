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
                    <div class="tituloBarraPrincipal">Álbum</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Programação > Inspeção > Álbum</div>
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
    <div class="" style="margin-top:1rem; margin-bottom:1rem;padding:15px;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{$message}}</strong>
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger alert-block fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{$message}}</strong>
            </div>
        @endif
        <div class="form-group col-md-12">
            @if(count($album)>0)
                @foreach ($album as $item)
                <div class="barraMenu container">
                    @if ($message = Session::get('success'.$item->id))
                        <div class="alert alert-success alert-block fade show" style="margin-top:1rem;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    <div class="row col-md-12" style="margin-top:10px; margin-left:1px;">
                    <div class=" col-md-4" style="margin-top: 3rem; margin-left:0px;width:100%; margin-bottom:2rem;">
                        @if($item->orientation == 6 || $item->orientation == 8)
                            <div style="width: 100%; text-align:center;">
                                <a type="button" onclick="mostrarImagemInspecao('{{$item->imagemInspecao}}')" data-toggle="modal" data-target="#exampleImagemInspecaoModal"><img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" style="padding-right:13px;" width="150px"/></a>
                            </div>
                        @elseif($item->orientation == 1 || $item->orientation == 3)
                            <div style="width: 100%; text-align:center; margin-top:50px;">
                                <a type="button" onclick="mostrarImagemInspecao('{{$item->imagemInspecao}}')" data-toggle="modal" data-target="#exampleImagemInspecaoModal"><img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" style="padding-right:13px;" height="150px"/></a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8" style="margin-top:2rem; width:100%;  margin-bottom:2rem; margin-left:-1rem;">
                        <div class="dropdown" style="text-align: right">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleDeletarImagemInspecaoModal" onclick="deletarImagemInspecao('{{Crypt::encrypt($item->id)}}')">Deletar</a>
                            </div>
                        </div>
                        <label class="styleTituloDoInputCadastro" for="descricao">Comentário:<span style="color:red">*</span></label>
                        <form id="savaComentarioFotoInspecao_inspetor{{$item->id}}" method="POST" action="{{ route('save.descricao') }}">
                            @csrf
                            <textarea id="comentarioImagem{{$item->id}}" class="form-control" rows="3" name="descricao">{{ $item->descricao}}</textarea>
                            <input type="hidden" name="inspecao_id" value="{{$item->id}}">
                        </form>
                        <div style="text-align: right; margin-top:15px;"><button type="button" class="btn btn-success" style="width:230px; color:white" data-toggle="modal" data-target="#exampleSalvarComentarioImagemInspecaoModal" onclick="modalImagemInspecao('{{$item->id}}','{{Crypt::encrypt($item->id)}}', '{{$item->descricao}}')">Salvar</button></div>
                    </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="barraMenu" style="padding-top:6rem; padding-bottom:6rem; text-align:center; margin-bottom:3rem;">
                    <div style="font-family: 'Roboto', sans-serif; font-size:20px;">Nenhuma foto cadastrada!</div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleImagemInspecaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Imagem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-md-12">
                    <img id="imgAlbumInspecao" alt="Logo" style="padding-right:0px; width:100%"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="width:230px;">Fechar</button>
        </div>
    </div>
    </div>
</div>
<!-- Modal Deletar uma foto-->
<div class="modal fade" id="exampleDeletarImagemInspecaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:red;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Deletar imagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;font-weight:bold; margin-bottom:1rem;">Tem certeza de que deseja deletar a imagem e o comentário?</div>
                    <form id="" method="POST" action="{{ route('delete.foto') }}">
                        @csrf
                        <input type="hidden" id="inspecao_id_inspetor" name="value">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <button type="submit" class="btn btn-success botao-form"  >Sim, deletar imagem</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Salvar uma foto-->
<div class="modal fade" id="exampleSalvarComentarioImagemInspecaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="modalSalvarComentarioFoto_InspetorCor" class="modal-header">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="modalTituloSalvarComentarioFoto_Inspetor" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Salvar comentário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12" ><label id="modalTextoSalvarComentarioImagem_Inspetor" style="font-family: 'Roboto', sans-serif;font-weight:bold; margin-bottom:1rem;"></label></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <button id="botaoSalvarComentarioModal_inspetor" type="button" class="btn btn-success botao-form" onclick="saveComentario()">Sim, salvar comentário</button>
            </div>
        </div>
    </div>
</div>
@endsection

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
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;margin-bottom:-5px">Informações</div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" style="cursor:pointer" onclick="editarEstabelecimento()">Editar estabelecimento</a>
                                <a class="dropdown-item" style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" onclick="deletarEstabelecimento('{{$empresa->user->name}}')">Deletar estabelecimento</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <form action="">
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <fieldset disabled id="idFieldset">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Nome/Razão Social:</label>
                        <input type="text" class="form-control" id="inputEmail4" placeholder="{{$empresa->nome}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">CNPJ/CPF:</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="{{$empresa->cnpjcpf}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">CNAE:</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="{{$cnae[0]->descricao}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">E-mail:</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="{{$empresa->email}}">
                    </div>
                    <div class="form-grtextoup col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Telefone 1:</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="{{$telefone->telefone1}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Telefone 2:</label>
                                <input type="text" class="form-control" id="inputPassword4"  placeholder="{{$telefone->telefone2}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Nº CNAE:</label>
                            <input type="text" class="form-control" id="inputPassword4"  placeholder="{{$cnae[0]->codigo}}">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                        <div class="btn-group">
                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Endereço</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:1rem;margin-left:10px;">
                <fieldset disabled id="idFieldsetEndereco">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Rua:</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$endereco->rua}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Número:</label>
                            <input type="text" class="form-control" id="inputPassword4" placeholder="{{$endereco->numero}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Complemento:</label>
                            <input type="text" class="form-control" id="inputPassword4" placeholder="{{$endereco->complemento}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Bairro:</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$endereco->bairro}}">
                        </div>
                        <div class="form-group col-md-4">
                                <label for="inputEmail4">Cidade/UF:</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="{{$endereco->cidade}}/{{$endereco->uf}}">
                            </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">CEP:</label>
                            <input type="text" class="form-control" id="inputPassword4" placeholder="{{$endereco->cep}}">
                        </div>
                        </div>
                    </div>


                    <hr size = 7>
                    <div id="idBotaoAtualizar" style="margin-bottom:3rem; display:none;">
                            <div class="d-flex">
                                <div class="mr-auto p-2">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo.
                                </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-success" style="width:340px;">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div class="barraMenu">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                            <div class="btn-group">
                                <div style="margin-top:1.4px;margin-left:10px;font-size:15px;">Documentos do estabelecimento</div>
                            </div>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('pagina.mostrar.documentacao',["value" => Crypt::encrypt($empresa->id)]) }}" style="margin-right:15px">Abrir</a>
                        </div>
                    </div>
                </div>
                <div class="barraMenu" style="margin-top:1rem;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group">
                                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos - CNAE</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom:5rem">

                        <div class="cardDocumentos">
                            <div class="d-flex justify-content-center">
                                <div class="mr-auto p-2">
                                    <div class="form-group">
                                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Exemplo1<span style="color:red">*</span></div>
                                        <div style="margin-left:10px; margin-bottom:-15px;">Data do envio: dd/mm/aaaa</div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="dropdown show">
                                        <a class="btn btn-secondary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ação
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">Abrir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cardDocumentos">
                                <div class="d-flex justify-content-center">
                                    <div class="mr-auto p-2">
                                        <div class="form-group">
                                            <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Exemplo2<span style="color:red">*</span></div>
                                            <div style="margin-left:10px; margin-bottom:-15px;">Data do envio: dd/mm/aaaa</div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="dropdown show">
                                            <a class="btn btn-secondary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ação
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Abrir</a>
                                                <a class="dropdown-item" href="#">Adicionar</a>
                                                <a class="dropdown-item" href="#">Deletar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>


<!-- Modal - campo deletar estabelecimento-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
            <img src="{{ asset('/imagens/logo_atencao2.png') }}" alt="Logo" style="width:35px; margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel" style="font-size:20px;">Excluir estabelecimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12">Tem certeza de que deseja excluir este estabelecimento <label id="nomeDoEstabelecimento" style="font-weight:bold;"></label>?</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
        <button type="button" class="btn btn-danger" style="width:100px;">Sim, excluir</button>
    </div>
    </div>
</div>
</div>
<script>
    function editarEstabelecimento(){
        // console.log("OPA");
        if(document.getElementById("idFieldset").disabled == true){
            //Estabelecimento
            document.getElementById("idFieldset").disabled = false;
            //Endereco
            document.getElementById("idFieldsetEndereco").disabled = false;
            //botao atualizar
            document.getElementById("idBotaoAtualizar").style.display = "block";
        }else{
            //Estabelecimento
            document.getElementById("idFieldset").disabled = true;
            //Endereco
            document.getElementById("idFieldsetEndereco").disabled = true;
            //botao atualizar
            document.getElementById("idBotaoAtualizar").style.display = "none";
        }
    }
    function deletarEstabelecimento($nome){
        console.log($nome);
        document.getElementById("nomeDoEstabelecimento").innerHTML=$nome;
    }
</script>

</div>
@endsection



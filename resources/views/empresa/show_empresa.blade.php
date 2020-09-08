@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
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
                    <div class="barraMenu">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                                    <div class="btn-group">
                                        <div style="margin-top:1px;margin-left:5px;"></div>
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Responsável Técnico</div>
                                    </div>
                                </a>
                            </div>
                           <div class="p-2">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" style="cursor:pointer" href="{{ route('cadastrar.rt.pagina', ['empresaId' => $empresaId]) }}" onclick="editarEstabelecimento()">Cadastrar Resp. Técnico</a>
                                         <a class="dropdown-item" style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" onclick="deletarEstabelecimento('{{$empresa->user->name}}')">Deletar Resp. Técnico</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-top:1rem;margin-left:10px;">
                        @if ($respTecnico == null)
                            <div class="col-12" style="text-align:center;color:gray;font-weight:bold;margin-top:2rem; margin-bottom:3rem;font-size:20px;font-family:Arial, Helvetica, sans-serif;">Nenhum Responsável Técnico Cadastrado!</div>
                        @else
                        <fieldset disabled id="idFieldset">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Nome:</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="{{$respTecnico->user->name}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">CPF:</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="{{$empresa->cnpjcpf}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Formação:</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="{{$respTecnico->formacao}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Especialização:</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="{{$respTecnico->especializacao}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Telefone:</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="{{$respTecnico->user->name}}">
                                </div>
                            </div>
                        </fieldset>
                        @endif
                    </div>
                    <div class="barraMenu" style="margin-top:0.7rem;">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group">
                                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos do Responsável Técnico</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr size = 7>
                    <div id="idBotaoAtualizar" style="margin-bottom:10rem; display:none;">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-success" style="width:340px;">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
    </form>

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



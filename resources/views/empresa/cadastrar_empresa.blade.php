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
        </div>
    </div>
    <div class="container">
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:14px; margin-left:20px;">Adicionar um novo estabelecimento</div>
    </div>

    <form id="teste" method="POST" action="{{ route('adicionar.empresa') }}">
        @csrf
        <input type="hidden" name="user" value="{{Auth::user()->id}}">
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Nome/Razão Social:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="nome" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CNPJ/CPF:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="cnpjcpf" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">TIPO:<span style="color:red">*</span></label>
                    <input type="text" class="form-control"  name="tipo" placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">E-mail do estabelecimento:</label>
                    <input type="email" class="form-control" name="emailEmpresa" placeholder="">
                </div>
                <div class="form-grtextoup col-md-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Telefone 1:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="telefone1" id="inputTelefone1" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Telefone 2:</label>
                            <input type="text" class="form-control" name="telefone2" id="inputTelefone1" placeholder="">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Cnae</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:1rem;margin-left:1px;">

            <div class="container">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12" >
                                <label for="exampleFormControlSelect1">Áreas</label>
                                <select class="form-control" id="idSelecionarArea" onChange="selecionarArea(this)">
                                    <option>-- Selecione --</option>
                                    @foreach ($areas as $item)
                                        <option value={{$item->id}}>{{$item->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="btn-group col-md-12">
                                <div class="col-md-6" style="margin-left:-15px;margin-right:30px;">CNAE</div>
                                <div class="col-md-6 input-group input-group-sm mb-2">
                                    <input type="text" class="form-control" placeholder="Nome ou código do CNAE">
                                </div>

                            </div>
                            <div class="form-row col-md-12">
                                <div style="width:100%; height:250px; display: inline-block; border: 1.5px solid #f2f2f2; border-radius: 2px; overflow:auto;">
                                    <table cellspacing="0" cellpadding="1"width="300" >
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlSelect1">Meus CNAES</label>
                        <div class="form-group col-md-12" id="adicionar" style="width:100%; height:339px; display: inline-block; border: 1.5px solid #f2f2f2; border-radius: 2px; overflow:auto;">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Endereço</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Rua:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="rua" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Número:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="numero" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Complemento:</label>
                    <input type="text" class="form-control" name="complemento" placeholder="">
                </div>
            </div>
            <div class="form-row" style="padding-bottom:1.5rem;">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Bairro:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="bairro" placeholder="">
                </div>
                <div class="form-group col-md-4">
                        <label for="inputEmail4">Cidade:<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="cidade" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">UF:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="uf" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">CEP:<span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="cep" placeholder="">
                </div>
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos do estabelecimento</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos do representante (Dono/Gerente)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="barraMenu" style="margin-top:0.7rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <div class="btn-group">
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Representante técnico</div>
                    </div>
                </div>
            </div>
        </div>

        <hr size = 7>
        <div style="margin-bottom:10rem;">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                    </div>
                <div class="p-2">
                    <button type="submit" class="btn btn-success" style="width:340px;">Cadastrar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection



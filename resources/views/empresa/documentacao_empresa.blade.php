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
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;margin-bottom:-5px">Documentos</div>
                    </div>
                </div>
                <div class="p-2">
                    <div style="width:70px">
                    </div>
                </div>
            </div>
        </div>
    <div class="container" style="margin-top:1rem;">

        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif"><img src="{{ asset('/imagens/logo_predio.png') }}" alt="Logo" style="width:22px; height:26px; margin-top:-5px; margin-right:5px;"/>{{$nome}}</div>
                    <div><span style="font-weight:bold">CNPJ: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Tipo: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Última alteração: </span>dd/mm/aaaa</div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif; color:green"><img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="width:20px; height:20px; margin-top:-5px; margin-right:5px;"/>Aprovado</div>
                    <div><span style="font-weight:bold">Nome do inspetor: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Código do inspetor: </span> XXXXXXXXXXXXXXX</div>
                    <div><span style="font-weight:bold">Data da aprovação: </span>dd/mm/aaaa</div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="barraMenu" style="padding:1rem;">
                    <div style="font-size:20px; font-family:Arial, Helvetica, sans-serif"><img src="{{ asset('/imagens/logo_atencao2.png') }}" alt="Logo" style="width:22px; height:20px; margin-top:-5px; margin-right:5px;"/>Aviso!</div>
                    <div><span style="font-weight:normal">Toda modificação de documentos deverá passar pela aprovação da Vigilância Sanitária de Garanhuns!</span></div>
                </div>
            </div>

        </div>
    </div>
    <div class="barraMenu" style="margin-top:0.7rem;"">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <div class="btn-group">
                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Documentos - Serviço de ensino</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom:5.5rem">

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Requerimento Preenchido<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">CNPJ<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">RG e CPF<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Atestado de regularidade do corpo de bombeiro<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Licença Anterior<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">IPTU Quitado<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Certificado de detetizadora + Licença Sanitária<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Licença Ambiental<span style="color:red">*</span></div>
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

        <div class="cardDocumentos">
            <div class="d-flex justify-content-center">
                <div class="mr-auto p-2">
                    <div class="form-group">
                        <div style="font-weight:bold; color:#707070; margin-left:0px; margin-left:10px;">Taxa de vigilância sanitária<span style="color:red">*</span></div>
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
@endsection



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
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Documentos do estabelecimento {{$nome}}</div>
    </div>
    <hr/>
    <form id="submeterDocs" method="POST" enctype="multipart/form-data" action="{{route('arquivos.empresa', ['empresa' => $id])}}">
        @csrf
        <div class="container" style="margin-top:1rem;margin-left:10px;">
            <div class="form-row" style="margin-bottom:2rem;">
                
                
                @if (in_array("1", $areas))

                    <div class="container">
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Serviço de Ensino</div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Requerimento Preenchido</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CNPJ</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Contrato Social ou Registro de firma individual ou Certificado de MEI</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">RG</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CPF</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Atestado de regularidade do corpo de bombeiro</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Anterior</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Certificado de detetizadora + Licença Sanitária</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">IPTU Quitado</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Ambiental</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Taxa de vigilância sanitária</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endif

                @if (in_array("2", $areas))

                
                    <div class="container">
                        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Serviços de Saúde/Interesse a saúde/outros</div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Requerimento Preenchido:</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CNPJ</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Contrato Social ou Registro de firma individual ou Certificado de MEI</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">RG</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Cpf</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Atestado de regularidade do corpo de bombeiro</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Certificado de detetizadora</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Sanitária</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">IPTU Quitado</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Ambiental</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">PGRSS</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Comprovante de pagamento de taxa de vigilância sanitária</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-left" style="margin-left:0px;">
                            <div class="d-flex cardEmpresa">
                                <div class="mr-auto p-1">
                                    <a style="text-decoration:none;cursor:null;color:black;">
                                        <div class="form-group">
                                            <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CNESS</div>
                                            <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                        </div>
                                    </a>
                                </div>
                                @if ($status == "pendente")
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-2">
                                        <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                            <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-2">
                                    <a href="" style="text-decoration:none;">
                                        <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <hr/>
                @endif
                @if (in_array("3", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Distribuidora de serviços de saúde</div>
                </div>
                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Requerimento Preenchido</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CNPJ</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Contrato Social ou Registro de firma individual ou Certificado de MEI</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">RG</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">CPF</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Atestado de regularidade do corpo de bombeiro</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Anterior</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Certificado de detetizadora</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Sanitária</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">IPTU Quitado</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Licença Ambiental</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Projeto arquitetônico aprovado pela APEVISA</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Laudo de água microbiologico e físico-quimico</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">PGRSS</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">AFE/AE (FABRICAR/DÍSTRIBUIR/TRANSPORTAR)</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-left" style="margin-left:0px;">
                        <div class="d-flex cardEmpresa">
                            <div class="mr-auto p-1">
                                <a style="text-decoration:none;cursor:null;color:black;">
                                    <div class="form-group">
                                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Taxa de vigilância sanitária</div>
                                        <div style="margin-left:10px;font-size:11px;">Nome do doc</div>
                                    </div>
                                </a>
                            </div>
                            @if ($status == "pendente")
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_atencao.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @else
                                <div class="p-2">
                                    <div style="margin-top:2.4px;margin-right:15px;font-size:15px;">
                                        <img src="{{ asset('/imagens/logo_aprovado.png') }}" alt="Logo" style="margin-right:13px;"/>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-2">
                                <a href="" style="text-decoration:none;">
                                    <div style="margin-top:2.4px;margin-right:10px;font-size:15px;">Abrir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array("4", $areas))
                @endif
                @if (in_array("5", $areas))
                @endif
                @if (in_array("6", $areas))
                @endif
                @if (in_array("7", $areas))
                @endif
                @if (in_array("8", $areas))
                @endif
            </div>
        </div>
        {{-- <div style="margin-bottom:10rem;">
            <div class="d-flex">
                <div class="mr-auto p-2">
                </div>
            <div class="p-2">
                <button type="submit" class="btn btn-success" style="width:340px;">Cadastrar</button>
            </div>
        </div> --}}
        </div>
    </form>

</div>
@endsection



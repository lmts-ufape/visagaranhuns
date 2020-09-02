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
    <div class="container" style="margin-top:1rem;margin-left:10px;">
        <div class="form-row" style="margin-bottom:2rem;">
            
            @if (in_array("1", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Serviço de Ensino</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="req_preenchido"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="cnpj"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="contrato_social"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="rg"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiro<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="regula_bombeiro"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="licenca_anterior"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + Licença Sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="cert_deteti"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="iptu_quitado"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Ambiental<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="licenca_ambiental"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Taxa de vigilância sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="taxa_vigilancia"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("2", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Serviços de Saúde/Interesse a saúde/outros</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiro<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + Licença Sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Ambiental<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">PGRSS<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Comprovante de pagamento de taxa de vigilância sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNESS<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("3", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Distribuidora de serviços de saúde</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiro<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + Licença sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença ambiental<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Projeto arquitetônico aprovado pela APEVISA<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo de água microbiológico e Físico-Qumico<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">PGRSS<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">AFE/AE (Fabricar/Distribuir/Transportar)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Taxa de vigilância sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("4", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070;">Caminhão Pipa</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Declaração dos carros pipa na empresa<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Documentação dos veículos - CRLV<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Declaração da fonte<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Registro da ANTT<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Carteira nacional de habilitação dos motoristas - CNH<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Declaração do material de revestimento interno do tanque (No caso de não ser inox) <span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo da água (Análise Físico-Quimica e Microbiológica)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Taxa de vigilância sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("5", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Estação de tratamento de água</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiros<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + licença sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença ambiental (Secretária De Desenvolvimento Rural E Meio Ambiente CPRH)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo de água microbiológico e Físico-Quimico<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("6", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">MEI</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiros<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + licença sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença da Adagro<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Ambiental (Secretária de Desenvolvimento Rural E Meio Ambiente)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo de água microbiológico e físico-quimico<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("7", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">Distribuidora de serviços diversos</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiros<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + licença sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Ambiental (Secretária de Desenvolvimento Rural E Meio Ambiente)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Projeto Arquitetônico Aprovado pela APEVISA<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo de Água Microbiológico e Físico-Químico<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Taxa de Vigilância Sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <hr/>
            @endif
            @if (in_array("8", $areas))
                <div class="container">
                    <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem;">MEI/Serviço de alimentação</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" lang="PT">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">RG e Cpf<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Atestado de regularidade do corpo de bombeiros<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Anterior<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Adagro<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado do Curso de Higiene e Manipulação de Alimentos<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Certificado de detetizadora + licença sanitária<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">IPTU Quitado<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Licença Ambiental (Secretária de Desenvolvimento Rural E Meio Ambiente)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Laudo de Água Microbiológico e Físico-Quimico (Se tiver poço)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Taxa de Serviço do Estabelecimento (PAGO)<span style="color:red">*</span></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                    </div>

                </div>
            @endif

        </div>
    </div>


</div>
@endsection



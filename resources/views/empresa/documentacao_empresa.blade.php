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
        <div style="font-size:20px; font-weight:bold; color:#707070; margin-top:2rem; margin-left:20px;">Documentos do estabelecimento {{$nome}}</div>
    </div>

    <div class="container" style="margin-top:1rem;margin-left:10px;">
        <div class="form-row" style="margin-bottom:2rem;">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Contrato Social ou Registro de Firma Individual ou Certificado de MEI:<span style="color:red">*</span></label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" lang="PT">
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
                <label for="inputPassword4">Certificado de dedetização<span style="color:red">*</span></label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                </div>

            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Licença Sanitária<span style="color:red">*</span></label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                </div>

            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">IPTU quitado<span style="color:red">*</span></label>

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
                <label for="inputPassword4">Taxa de Vigilância Sanitária<span style="color:red">*</span></label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                </div>

            </div>

        </div>
    </div>


</div>
@endsection



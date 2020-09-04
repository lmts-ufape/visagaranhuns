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
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Requerimento Preenchido:<span style="color:red">*</span></label>
    
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="req_preenchido[]"
                            aria-describedby="inputGroupFileAddon01" lang="PT">
                            <input type="hidden" name="data[]" value="28/05/1994">
                            <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                        </div>
    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">CNPJ<span style="color:red">*</span></label>
    
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="req_preenchido[]"
                            aria-describedby="inputGroupFileAddon01">
                            <input type="hidden" name="data[]" value="28/05/1994">
                            <label class="custom-file-label" for="inputGroupFile01">-- Clique aqui para selecionar o aquivo --</label>
                        </div>
    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Contrato Social ou Registro de firma individual ou Certificado de MEI<span style="color:red">*</span></label>
    
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="req_preenchido[]"
                            aria-describedby="inputGroupFileAddon01">
                            <input type="hidden" name="data[]" value="28/05/1994">
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
            </div>
        </div>
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



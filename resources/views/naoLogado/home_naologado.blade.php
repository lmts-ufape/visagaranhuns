@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="form-row">
        <div class="col-md-12" style="margin-left:10px; font-family:'Roboto'; font-size:18px; margin-bottom:5px;">Principais Serviços</div>
        <div class="form-group col-md-4">
            <a href="{{ route('home.cadastrar')}}" style="text-decoration:none;cursor:pointer;color:black;">
                <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%; background-color:#d88366">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_predio2.png') }}" alt="Logo" style="width:50px; height:60px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:16px">Cadastre sua empresa</div>
                </div>
                </div>
            </a>
        </div>
        <div class="form-group col-md-4">
            <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:#88b6b6">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_telefone2.png') }}" alt="Logo" style="width:55px; height:60px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px">Atendimento ao setor regulado</div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:#e2cf5e">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_localizar1.png') }}" alt="Logo" style="width:57px; height:60px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px">Emitir uma licença</div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:#b5cc71">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_folha.png') }}" alt="Logo" style="width:48px; height:60px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px">Documentos</div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:#cc9f71">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_localizar2.png') }}" alt="Logo" style="width:90px; height:60px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px">Inspeções em estabelecimentos regulados</div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="cardAreaGrande" style="padding:1rem; width:100%; height:100%;background-color:#ae71cc">
                <div class="form-row">
                    <div class="col-12" style="height:80px;  text-align:right;">
                            <img src="{{ asset('/imagens/logo_mais.png') }}" alt="Logo" style="width:50px; height:50px;"/>
                        </div>
                    <div class="col-12" style="color:white;font-family:'Noto Sans SC'; font-weight:400; font-size:15px">Outros Serviços</div>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-left:10px;margin-top:10px; font-family:'Roboto'; font-size:18px; margin-bottom:5px;">Endereços</div>

        <div class="form-group col-md-4">
            <div  style="padding:1rem; width:350px; height:300px;">
                <div class="form-row">
                    <img id="img1" class="styleMapa" src="{{ asset('/imagens/mapa_ssg.png') }}" alt="Logo" style="width:100%; height:100%; display:block"/>
                    <img id="img2" class="styleMapa" src="{{ asset('/imagens/mapa_sms.png') }}" alt="Logo" style="width:100%; height:100%; display:none"/>
                </div>
            </div>
        </div>
        <div class="form-group col-md-8">
            <div class="" style="padding:1rem; width:100%; height:100%;">
                <div class="form-row">
                    <div class="cardMapa">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group">
                                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px; font-family:'Roboto'; font-weight:bold; color:#707070">Secretária de Saúde de Garanhuns - PE</div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div style="margin-right:10px; cursor:pointer;" onclick="mostrar('mostrar1','texto1','img1')"><span id="texto1">Mostrar</span></div>
                            </div>
                        </div>
                        <div id="mostrar1" style="display:block;">
                            <div class="container" style="margin-left:3px; font-family:arial;">R. Amauri de Medeiros, 215-387 - Heliópolis, Garanhuns - PE, 55295-430</div>
                            <div class="container" style="margin-left:3px; font-family:arial; color:red">Segunda a Sexta - 08:00-14:00</div>
                            <div class="container" style="margin-left:3px; margin-bottom:10px; font-family:arial;"></div>
                        </div>
                    </div>

                    <div class="cardMapa">
                        <div class="d-flex">
                            <div class="mr-auto p-2">
                                <div class="btn-group">
                                    <div style="margin-top:2.4px;margin-left:10px;font-size:15px; font-family:'Roboto'; font-weight:bold; color:#707070">Secretária Municipal de Garanhuns - PE</div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div style="margin-right:10px; cursor:pointer;" onclick="mostrar('mostrar2','texto2','img2')"><span id="texto2">Mostrar</span></div>
                            </div>
                        </div>
                        <div id="mostrar2" style="display:none;">
                            <div class="container" style="margin-left:3px; font-family:arial;">R. Joaquim Távora - Heliópolis, Garanhuns - PE, 55295-410</div>
                            <div class="container" style="margin-left:3px; font-family:arial; color:red">Segunda a Sexta - 08:00-14:00</div>
                            <div class="container" style="margin-left:3px; margin-bottom:10px; font-family:arial;">(87) 3762-7071</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

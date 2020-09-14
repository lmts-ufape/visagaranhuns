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

    <div class="barraMenu"style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                    <div class="form-row">
                        <div class="form-group col-md-12" >
                            <div>
                                <label style="color:black; font-size:35px;  margin-bottom:-10px; font-weight:400; font-family: 'Libre Baskerville', serif;;
                                ;">{{$nome}}</label>
                            </div>
                            <div>
                                <div style="font-size:13px;margin-top:2px; margin-bottom:-10px;color:gray;">Início > Estabelecimentos > {{$nome}} > Documentos </div>
                            </div>
                            <hr size = 7 style="margin-bottom:-2px;">
                        </div>

                        <div class="form-group col-md-7">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DOCUMENTOS NECESSÁRIOS</label>
                                </div>
                                <div class="form col-md-12">
                                    <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:-5px">Contrato Social ou Registro de Firma Indivídual ou Certificado de MEI <span style="color:#707070"> - Pendente</span></label>
                                    <div style="margin-bottom:10px;">
                                        <a href="" style="margin-right:10px;">Abrir arquivo</a>
                                        <a href="">Baixar arquivo</a>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">OUTROS DOCUMENTOS</label>
                                </div>
                                <div class="form col-md-12">
                                    <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:-5px">Exemplo A <span style="color:#707070"> - Pendente</span></label>
                                    <div style="margin-bottom:10px;">
                                        <a href="" style="margin-right:10px;">Abrir arquivo</a>
                                        <a href="">Baixar arquivo</a>
                                    </div>
                                </div>
                                <div class="form col-md-12">
                                    <label style="font-weight:normal;font-family: 'Roboto', sans-serif; margin-bottom:-5px">Exemplo B <span style="color:#707070"> - Pendente</span></label>
                                    <div style="margin-bottom:10px;">
                                        <a href="" style="margin-right:10px;">Abrir arquivo</a>
                                        <a href="">Baixar arquivo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form col-md-5" style="margin-top:10px;">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                        <label style="font-size:19px;margin-bottom:-5px; font-family: 'Roboto', sans-serif;">ANEXAR DOCUMENTO</label>
                                    </div>
                                <div class="form col-md-12" style="margin-top:-10px;margin-bottom:10px;">
                                    <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Tipo de documento</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form col-md-12" >
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Emissão</label>
                                                <input type="date" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlSelect1" style="font-weight:normal;font-family: 'Roboto', sans-serif;">Validade</label>
                                                <input type="date" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                </div>
                                <div class="form col-md-12" style="margin-top:30px;">
                                    <button type="button" class="btn btn-success" style="width:100%;">Enviar</button>
                                </div>
                            </div>


                        </div>

                    </div>
                    {{-- <hr size = 7 style="margin-bottom:-15px;"> --}}
                    <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">

                        </div>
                    </form>
                </div>
    </div>




</div>
@endsection



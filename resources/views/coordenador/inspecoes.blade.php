@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
            <div class="mr-auto p-2 styleBarraPrincipalMOBILE">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
            </div>
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Histórico de Inspeções</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > Inspeções > Histórico</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">INSPEÇÕES</label>
                        </div>
                        <div class="form-group col-md-6" style="align-content: right">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; margin-left:435px; font-family: 'Roboto', sans-serif;"><a href="{{ route('listagem.area') }}">BAIXAR</a>
                            </label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-responsive-lg table-hover" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold; margin-right:30px;">Data</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Inspetor</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Agente</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Agente</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Empresa</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Cnae</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($temp as $item)
                                        <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->data}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspetor}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->agente}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->agente}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->empresa}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->cnae}}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
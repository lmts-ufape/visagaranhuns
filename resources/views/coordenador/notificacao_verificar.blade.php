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
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Notificação</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Programação > Inspeção > Notificação</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                {{-- <div class="dropdown" style="width:50px"> --}}
                    {{-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#exampleModal">Convidar agente</a>
                    </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block fade show" style="margin-top:1rem;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">NOTIFICAÇÃO</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Item</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Exigência</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Prazo (Qt. Dias)</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Estabelecimento</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Data</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($notificacao as $item)
                                        <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->item}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->exigencia}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->prazo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                            @if($item->inspecao->empresa != null) 
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspecao->empresa->nome}}</th>
                                            @elseif($item->inspecao->denuncia != null)
                                                <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->inspecao->denuncia->empresa}}</th>
                                            @endif
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{date('d-m-Y', strtotime($item->created_at))}}</th> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr size = 7 style="margin-bottom:-15px;">
        </div>
    </div>
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection

<script type="text/javascript">

    // window.onload= function() {
    //     tinymce.get("textarea_relatorio_inspetor").setMode('readonly'); //desabilitar campo de texto
    // };
    
 
</script>
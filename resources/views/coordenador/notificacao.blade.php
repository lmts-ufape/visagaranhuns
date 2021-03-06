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
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Prazo</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($notificacao as $item)
                                        <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->item}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->exigencia}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->prazo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->status}}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr size = 7 style="margin-bottom:-15px;">
            <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                        <button type="button" class="btn btn-danger" style="margin-right:5px;" data-toggle="modal" data-target="#exampleModal1" onclick="reprovar('{{$inspecao_id}}', 'false')">Reprovar Notificação</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" onclick="aprovar('{{$inspecao_id}}', 'true')">Aprovar Notificação</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal - reprovar notificação -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:red;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Reprovar Notificação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;">Tem certeza de que deseja reprovar esta notificação?</div>
                    {{-- <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;"><img src="{{ asset('/imagens/logo_bloqueado.png') }}" alt="Logo" style="width:15px; margin-right:5px;"/> Essa ação não poderá ser desfeita</div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                <form method="POST" action="{{ route('julgar.notificacao.coordenador') }}">
                    @csrf
                    <input type="hidden" id="inspecao_idR" name="inspecao_id" value="">
                    <input type="hidden" id="decisaoR" name="decisao" value="">
                    <div class="col-md-12" style="padding-left:0">
                        <button type="submit" class="btn btn-success botao-form" style="width:100%">
                                Sim, reprovar notificação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal - aprovar cadastro-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3ea81f;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Aprovar Notificação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" style="font-family: 'Roboto', sans-serif;">Tem certeza de que deseja aprovar esta notificação?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"style="width:100px;">Não</button>
                    <form method="POST" action="{{ route('julgar.notificacao.coordenador') }}">
                        @csrf
                        <input type="hidden" id="inspecao_idA" name="inspecao_id" value="">
                        <input type="hidden" id="decisaoA" name="decisao" value="">
                        <div class="col-md-12" style="padding-right:0">
                            <button type="submit" class="btn btn-success botao-form" style="width:100%">
                                Sim, aprovar notificação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endsection

<script type="text/javascript">
    // tinymce.activeEditor.getBody().setAttribute('textarea_relatorio_inspetor', false);

    function reprovar($inspecao, $decisao) {

        document.getElementById("inspecao_idR").value = $inspecao;
        document.getElementById("decisaoR").value = $decisao;
    }

    function aprovar($inspecao, $decisao) {

        document.getElementById("inspecao_idA").value = $inspecao;
        document.getElementById("decisaoA").value = $decisao;
    }

    // window.onload= function() {
    //     tinymce.get("textarea_relatorio_inspetor").setMode('readonly'); //desabilitar campo de texto
    // };
    
 
</script>
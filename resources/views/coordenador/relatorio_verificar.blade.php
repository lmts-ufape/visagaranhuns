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
                    <div class="tituloBarraPrincipal">Relatório</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Programação > Inspeção > Relatório</div>
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
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">RELATÓRIO</label>
                        </div>
                        <div class="form col-md-9" style="margin-top:10px;">
                            <form id="form_relatorio_inspetor" method="POST" action="{{ route('save.relatorio') }}">
                                @csrf
                                <input type="hidden" name="inspecao_id" value="{{$inspecao_id}}">
                                <textarea id="summary-ckeditor" rows="40" name="relatorio" disabled>{{$relatorio}}</textarea>
                            </form>
                        </div>
                        <div class="form col-md-3">
                            <div class="col barraMenu">
                                <p style="margin-top:8px; margin-bottom:6px;">Álbum</p>
                            </div>
                            <div class=" overflow-auto" style="padding-left: 15px; padding-top:10px; height: 58rem;">
                                <table class="table table-borderless table-hover">
                                    <tbody>
                                    @foreach ($album as $item)
                                        @if($item->orientation == 6 || $item->orientation == 8)
                                        <tr style="text-align: center;border: 1.5px solid #f5f5f5;">
                                            <td style="width: 100%;" type="button" data-toggle="modal" data-target="#modaTipo1"><img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" height="90px"/></td>
                                        </tr>
                                        <!-- Modal TIPO 1-->
                                        <div class="modal fade" id="modaTipo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Imagem</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" height="290px"/>
                                                        </div>
                                                        <div class="form-group col-md-9">
                                                            <div style="overflow: auto; height:290px;">
                                                                <label>{!! $item->descricao !!}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal" style="width: 190px;">Fechar</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--x Modal x-->
                                        @else
                                        <tr style="text-align: center;border: 1.5px solid #f5f5f5;">
                                            <td style="width: 100%;"  type="button" data-toggle="modal" data-target="#modaTipo2"><img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" height="90px"/></td>
                                        </tr>
                                        <!-- Modal TIPO 2-->
                                        <div class="modal fade" id="modaTipo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Imagem</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <img src="/imagens/inspecoes/{{$item->imagemInspecao}}" alt="Logo" height="190px"/>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div style="overflow: auto; height:195px;">
                                                                <label>{!! $item->descricao !!}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal" style="width: 190px;">Fechar</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--x Modal x-->
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr size = 7 style="margin-bottom:-15px;">
        </div>
    </div>
</div>

    <script src="{{ asset('ckeditor_4_advanced/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.editorConfig = function( config ) {
            config.toolbarGroups = [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ];

            config.removeButtons = 'Source,Save,NewPage,Templates,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Bold,Italic,Underline,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,BGColor,ShowBlocks,About';
        };
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endsection
<script type="text/javascript">
    // window.onload= function() {
    //     tinymce.get("textarea_relatorio_inspetor").setMode('readonly'); //desabilitar campo de texto
    // };
</script>
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 0.5rem;">
        <div class="barraMenu" style="margin-top:1rem; margin-bottom:-2.5rem;padding:2px;">
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Orientações</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Orientações</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="barraMenu" style="margin-top:4rem; margin-bottom:-2.5rem;padding:15px;">
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Sobre</div>
                    <p style="margin-top: 10px; margin-left: 10px; margin-right: 10px;" align="justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec bibendum eu mi et ultrices. 
                        Morbi porta quis lorem at malesuada. Cras lacinia turpis vel semper tempus. Nullam vestibulum 
                        faucibus ex ac mattis. Duis eros tortor, rhoncus nec semper eu, fringilla at metus. Ut elit justo, 
                        mollis eu nulla a, fringilla egestas dui. Sed dapibus nisl sed magna dignissim vestibulum. 
                        Curabitur odio lacus, lacinia quis sagittis sit amet, tempus in sapien. Aliquam lobortis magna ac odio 
                        aliquet dapibus. Nullam aliquam mauris et urna ullamcorper consequat. Nunc auctor mollis fermentum. 
                        Integer efficitur dignissim ex sit amet tincidunt. Quisque sodales posuere lectus ultricies convallis. 
                        Fusce placerat enim a felis finibus pellentesque.

                        Sed facilisis imperdiet leo, vitae tempus ipsum rhoncus sit amet. Donec accumsan tincidunt euismod. 
                        Suspendisse quis ipsum vitae sapien scelerisque venenatis. Praesent tempus consectetur odio, sed gravida 
                        tortor tincidunt id. Integer vitae eleifend purus. Nulla at dignissim turpis. Donec hendrerit massa tellus, 
                        eu viverra mi commodo eu.

                        Sed at commodo leo, ac lacinia urna. Aenean feugiat laoreet nunc, ut viverra velit malesuada nec. 
                        Phasellus vehicula dignissim orci sit amet condimentum. Nullam vel quam convallis elit dapibus tincidunt. 
                        Morbi scelerisque arcu urna, nec commodo nunc mollis ac. In a augue in nulla lacinia accumsan. 
                        Sed vel lorem id metus consectetur egestas sed a turpis. Suspendisse tristique, magna sit amet interdum 
                        suscipit, turpis nibh pellentesque risus, nec placerat risus risus ut sapien. Nullam luctus non nulla nec ornare. 
                        Donec cursus vehicula dui, at rhoncus ante posuere vitae. Nunc dictum ante est, vel sollicitudin massa aliquet ac. 
                        Proin et tellus hendrerit, ornare eros a, bibendum dui. Suspendisse iaculis eu nibh sit amet cursus. 
                        Curabitur viverra id velit ac consequat. Vivamus sed tellus tempor, scelerisque elit sit amet, sagittis lectus.
                    </p>
                    <p style="margin-top: 10px; margin-left: 10px; margin-right: 10px;" align="justify">

                        Sed facilisis imperdiet leo, vitae tempus ipsum rhoncus sit amet. Donec accumsan tincidunt euismod. 
                        Suspendisse quis ipsum vitae sapien scelerisque venenatis. Praesent tempus consectetur odio, sed gravida 
                        tortor tincidunt id. Integer vitae eleifend purus. Nulla at dignissim turpis. Donec hendrerit massa tellus, 
                        eu viverra mi commodo eu.

                        Sed at commodo leo, ac lacinia urna. Aenean feugiat laoreet nunc, ut viverra velit malesuada nec. 
                        Phasellus vehicula dignissim orci sit amet condimentum. Nullam vel quam convallis elit dapibus tincidunt. 
                        Morbi scelerisque arcu urna, nec commodo nunc mollis ac. In a augue in nulla lacinia accumsan. 
                        Sed vel lorem id metus consectetur egestas sed a turpis. Suspendisse tristique, magna sit amet interdum 
                        suscipit, turpis nibh pellentesque risus, nec placerat risus risus ut sapien. Nullam luctus non nulla nec ornare. 
                        Donec cursus vehicula dui, at rhoncus ante posuere vitae. Nunc dictum ante est, vel sollicitudin massa aliquet ac. 
                        Proin et tellus hendrerit, ornare eros a, bibendum dui. Suspendisse iaculis eu nibh sit amet cursus. 
                        Curabitur viverra id velit ac consequat. Vivamus sed tellus tempor, scelerisque elit sit amet, sagittis lectus.
                    </p>
                </div>
            </div>
        </div>
        
        <div style="margin-top:0.5rem; margin-bottom:5rem;padding:0px;">
            <div class="container" style="margin-top:2rem;">
                <div class="row" style="padding-top:15px;">
                    <div class="col-6">
                        {{-- <a href="http://ww3.uag.ufrpe.br/" target="_blank" style="font-family: 'Roboto', sans-serif; text-decoration:none; color:black;">VISA-GARANHUNS foi desenvolvido pela Universidade Federal do Agreste de Pernambuco - UFAPE</a> --}}
                    </div>
                    <div class="col-6" style="margin-top:-10px; text-align:right">
                        {{-- <img src="{{ asset('/imagens/logo_visa_menu.png') }}" alt="Logo" style="width:200px; margin-bottom:0px;"/> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

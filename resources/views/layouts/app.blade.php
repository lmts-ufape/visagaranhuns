<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Visa Garanhuns</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/cadastrar_empresa.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/cadastrar_empresa_comum.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/requerimento_coordenador.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/naologado.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/checklist.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/findDoc.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/findDocRt.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/requerimento_rt.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/config_pagina_inicial.js')}}" defer></script>
    <script type="text/javascript" src="{{URL::asset('js/editar_meus_dados.js')}}" defer></script>

    <!-- load jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Noto+Sans+SC:wght@100;300;400;700;900&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu_rodape.css') }}" rel="stylesheet">
    <link href="{{ asset('css/naoLogado.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coordenador.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cadastrar_empresa.css') }}" rel="stylesheet">
    <link href="{{ asset('css/geral.css') }}" rel="stylesheet">
    <link href="{{ asset('css/agentes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/documentos_empresa.css') }}" rel="stylesheet">


    <!-- editor de texto -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: 'link image lists',
            menubar: false,
        });
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('imagens/logo_visa_menu.png')}}" style="width:145px; margin-top:-5px; margin-bottom:-5px; margin-left:10px; margin-right:30px;">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emconstrucao') }}">{{ __('A vigilância') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emconstrucao') }}">{{ __('Orientações') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emconstrucao') }}">{{ __('Contato') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emconstrucao') }}" style="margin-right:30px;">{{ __('Legislação') }}</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="font-weight:bold; color:black;"><span>Entrar</span></a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            @if(Auth::user()->tipo == "coordenador")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pagina.requerimento') }}">{{ __('Requerimento') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('criar.inspecao') }}">{{ __('Programação') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Membros<span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('listar.agentes') }}">Agentes</a>
                                            <a class="dropdown-item" href="{{ route('listar.inspetores') }}">Inspetores</a>
                                        </div>
                                    </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('listagem.area') }}">{{ __('Estabelecimentos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalLocalizar"><img src="{{asset('imagens/logo_lupa_1.png')}}" style="width:25px; margin-top:-4px; margin-left:10px; margin-right:30px;"></button>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('servico.index') }}">
                                            {{ __('Gerenciar conteúdo') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Sair do sistema') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif(Auth::user()->tipo == "empresa")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'estabelecimentos']) }}">{{ __('Estabelecimentos') }}</a>
                                    </li>
                                @if(Auth::user()->status_cadastro == "aprovado")
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('emconstrucao') }}">{{ __('Licenças') }}</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="{{ route('listar.responsavelTec') }}">{{ __('Responsável Técnico') }}</a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'documentacao']) }}">{{ __('Documentacao') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('emconstrucao') }}" style="margin-right:30px;">{{ __('Notificação') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('editar.gerente', ['user' => Auth::user()->id]) }}">
                                                {{ __('Editar meus dados') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('editar.gerente', ['user' => Auth::user()->id]) }}">
                                                {{ __('Editar senha de acesso') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            @elseif(Auth::user()->tipo == "inspetor")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Programação') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="margin-right:30px;">{{ __('Histórico') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif(Auth::user()->tipo == "agente")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Programação') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="margin-right:30px;">{{ __('Histórico') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif(Auth::user()->tipo == "rt")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('listar.empresa.rt',['flag'=>"estabelecimento"]) }}">{{ __('Estabelecimentos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('listar.empresa.rt',['flag'=>"requerimento"]) }}">{{ __('Requerimentos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('listar.empresa.rt',['flag'=>"documentos"]) }}">{{ __('Documentos') }}</a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Programação') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="margin-right:30px;">{{ __('Histórico') }}</a>
                                </li> --}}
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('rt.documentos') }}">
                                            {{ __('Meus documentos') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('editar.dados', ['user' => Auth::user()->id]) }}">
                                            {{ __('Editar meus dados') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- <main class="py-4">
            @yield('content')
        </main> --}}

        <div class="container" style="padding-top: 2rem; margin-bottom: 20px;">
            @yield('content')
        </div>
        {{-- footer --}}
        @include('layouts.footer')
    </div>



      <!-- Modal -->
      <div class="modal fade" id="exampleModalLocalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="-webkit-box-shadow: 2px 2px 35px 2px rgba(0,0,0,0.75);
          -moz-box-shadow: 2px 2px 35px 2px rgba(0,0,0,0.75);
          box-shadow: 2px 2px 35px 2px rgba(0,0,0,0.75);">
              <div class="row">
                  <div class="col-1"><img src="{{asset('imagens/logo_lupa_1.png')}}" style="width:20px; margin-top:8px; margin-left:17px; margin-right:5px;"></div>
                  <div class="col"><input type="text" class="form-control campoLocalizar" placeholder="Pesquisar" onkeyup="localizar(this.value);"
                  style="width:100%; border-color:white;outline:none !important; outline-width: 0 !important; box-shadow: none; -moz-box-shadow: none; -webkit-box-shadow: none;"></div>
                </div>

            <div id="idLocalizar" class="modal-content" style="display:none; border-color:white;">
                <div style="overflow: auto;height:200px;">
                    <table_ajax>
                    </table_ajax>
                </div>
            </div>
          </div>
        </div>
      </div>

</body>
<script type="text/javascript">
    function localizar($valor){
        if($valor.length >2){
            document.getElementById("idLocalizar").style.display = "block";
            $.ajax({
                url:'{{ config('prefixo.PREFIXO') }}coordenador/localizar',
                type:"get",
                dataType:'json',
                data: {"localizar": $valor},
                success: function(response){
                    $('table_ajax').html(response.table_data);
                    // document.getElementById('idTabela');
                    // $('#idTabela').animate({scrollTop: $('#idTabela')[0].scrollHeight},1000);
                }
            });
        }else if($valor.length == 1){
            $('table_ajax').html("");
        }
    };
</script>
</html>

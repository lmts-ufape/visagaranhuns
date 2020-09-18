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
                            <a class="nav-link" href="{{ route('/') }}">{{ __('Inicio') }}</a>
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Início') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pagina.requerimento') }}">{{ __('Requerimento') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('emconstrucao') }}">{{ __('Programação') }}</a>
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
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <img src="{{asset('imagens/logo_lupa_1.png')}}" style="width:25px; margin-top:-4px; margin-left:10px; margin-right:30px;">
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Olá, <span style="font-weight:bold; color:black;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Início') }}</a>
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
                                        {{-- <a class="dropdown-item" href="{{ route('home.cadastrar') }}">Dados do estabelecimento</a> --}}
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Início') }}</a>
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Início') }}</a>
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Início') }}</a>
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
                                        <a class="dropdown-item" href="{{ route('editar.dados', ['user' => Auth::user()->id]) }}">
                                            {{ __('Editar dados') }}
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
        <div id="appRodape" style="background-color:gray; padding-bottom:1rem;">
                <div class="container" >
                    <div class="row justify-content-center">
                        <div class="col-sm-2" align="center">
                            <div class="row justify-content-center">
                                <div class="col-sm-12 " style="margin-top:2.2rem;">
                                    <a href="http://ww3.uag.ufrpe.br/" target="_blank"><img src="{{ asset('/imagens/logo_ufape.png') }}" alt="Logo" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" align="center">
                            <div class="row justify-content-center">
                                <div class="col-sm-12 "style="margin-top:2.5rem;">
                                    <a target="_blank" href="http://lmts.uag.ufrpe.br/"><img src="{{ asset('/imagens/logo_lmts.png') }}" alt="Logo" style="margin-top:15px;"/></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" align="center">
                          <div class="row justify-content-center" style="margin-top:15px;">
                            <div class="col-sm-12 styleItemMapaDoSite" id="" style="font-weight:bold; font-family:arial">Mapa do site</div>
                            @guest
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >A vigilância</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Orientações</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Legislação</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Contato</a></div>
                            @elseif(Auth::user()->tipo == "coordenador")
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Requerimento</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Programação</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Inspetores</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Estabelecimentos</a></div>
                            @elseif(Auth::user()->tipo == "empresa")
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Estabelecimentos</a></div>
                                @if(Auth::user()->status_cadastro == "aprovado")
                                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Licenças</a></div>
                                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Responsável Técnico</a></div>
                                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Documentação</a></div>
                                    <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Notificação</a></div>
                                @endif
                            @elseif(Auth::user()->tipo == "agente")
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Programação</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Histórico</a></div>
                            @elseif(Auth::user()->tipo == "inspetor")
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Início</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Programação</a></div>
                                <div class="col-sm-12 styleItemMapaDoSite" style=" font-family:arial"><a >Histórico</a></div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-4" align="center">
                          <div class="row justify-content-center" style="margin-top:15px; margin-top:2.4rem;">
                                {{-- <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial; color:white">Apoio</div> --}}
                            <div style="margin:3px;"><img src="{{ asset('/imagens/logo_secretaria.png') }}"></div>
                          </div>
                        </div>
                </div>
            </div>
            {{-- <div class="row">
              <div class="col-md-12" align="center" style="color:black; margin-top:10px; border-bottom:1px;border-style: solid; border-width:1px;">
                <a href="https://www.google.com/maps/place/UFAPE+-+Universidade+Federal+do+Agreste+de+Pernambuco/@-8.9067588,-36.4943075,15z/data=!4m2!3m1!1s0x0:0x9e8a2fd11fab3580?sa=X&ved=2ahUKEwjegOe_z_voAhXhH7kGHYjPD5EQ_BIwCnoECA0QCg" target="tab"
                style="font-size:14px; font-family:arial; color:honeydew;">Av. Bom Pastor, s/n - Boa Vista, Garanhuns - PE, 55292-270</a>
              </div>
            </div> --}}
            <!--x footer x-->
        </div>
    </div>
</body>
</html>

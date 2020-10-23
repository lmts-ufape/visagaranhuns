<footer style="padding-top:rem;">
    <div id="appRodape" style="background-color:gray; padding-bottom:1rem;">
        <div class="row justify-content-center">
            <div class="col-12" style="display: flex;justify-content: center;color:white; margin-bottom:-1.5rem; margin-top:10px;">
                <ul>
                    @guest
                        <li style="float: left; margin-right:30px;font-family:arial"><a href="" style="text-decoration: none; color:#fff;">Início</a></li>
                        <li style="float: left; margin-right:30px;font-family:arial">A Vigilância</li>
                        <li style="float: left; margin-right:30px;font-family:arial">Orientações</li>
                        <li style="float: left; margin-right:30px;font-family:arial">Legislação</li>
                        <li style="float: left; margin-right:30px;font-family:arial">Contatos</li>
                        <li style="float: left; margin-right:30px;font-family:arial"></li>
                    @elseif(Auth::user()->tipo == "coordenador")
                        <li style=" float: left; margin-right:30px;font-family:arial"><a href="" style="text-decoration: none; color:#fff;cursor:pointer">Início</a></li>
                        <li style=" float: left; margin-right:30px;font-family:arial"><a href="{{ route('pagina.requerimento') }}" style="text-decoration: none; color:#fff;cursor:pointer">Requerimento</a></li>
                        <li style=" float: left; margin-right:30px;font-family:arial"><a href="{{ route('criar.inspecao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Programação</a></li>
                        <li style=" float: left; margin-right:30px;font-family:arial">
                            <label class="-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer; margin-bottom: 0rem;">
                                Membros<span class="caret"></span>
                            </label>
                            <div class="dropdown-menu"style="margin-bottom:-2rem;">
                                <a class="dropdown-item" style="cursor:pointer;font-family:arial" href="{{ route('listar.agentes') }}" style="text-decoration: none; color:#fff;cursor:pointer">Agentes</a>
                                <a class="dropdown-item" style="cursor:pointer;font-family:arial" href="{{ route('listar.inspetores') }}" style="text-decoration: none; color:#fff;cursor:pointer">Inspetores</a>
                            </div>
                        </li>
                        <li style="float: left; margin-right:30px;font-family:arial"><a href="{{ route('listagem.area') }}" style="text-decoration: none; color:#fff;">Estabelecimentos</a></li>
                        <li style="float: left; margin-right:30px;font-family:arial"></li>
                    @elseif(Auth::user()->tipo == "empresa")
                        <li style="float: left; margin-right:30px; font-family:arial"><a href="" style="text-decoration: none; color:#fff;">Início</a></li>
                        <li style="float: left; margin-right:30px; font-family:arial"><a style="text-decoration: none; color:#fff;" href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'estabelecimentos']) }}">Estabelecimentos</a></li>
                            @if(Auth::user()->status_cadastro == "aprovado")
                                <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Licenças</a></li>
                                <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('listar.responsavelTec') }}" style="text-decoration: none; color:#fff;cursor:pointer">Responsável Técnico</a></li>
                                <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'documentacao']) }}" style="text-decoration: none; color:#fff;cursor:pointer">Documentação</a></li>
                                <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Notificação</a></li>
                            @endif
                        <li style="float: left; margin-right:30px;"></li>
                    @elseif(Auth::user()->tipo == "agente")
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('/') }}">Início</a></li>
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Programação</a></li>
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Histórico</a></li>
                        <li style="float: left; margin-right:30px;font-family:arial"></li>
                    @elseif(Auth::user()->tipo == "inspetor")
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('/') }}">Início</a></li>
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Programação</a></li>
                        <li style="float: left; margin-right:30px;  font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Histórico</a></li>
                        <li style="float: left; margin-right:30px;font-family:arial"></li>
                    @elseif(Auth::user()->tipo == "rt")
                        <li style="float: left; margin-right:30px;font-family:arial"><a href="" style="text-decoration: none; color:#fff;">Início</a></li>
                        <li style="float: left; margin-right:30px; font-family:arial"><a href="{{ route('listar.empresa.rt',['flag'=>"estabelecimento"]) }}" style="text-decoration: none; color:#fff;cursor:pointer">Estabelecimentos</a></li>
                        <li style="float: left; margin-right:30px; font-family:arial"><a href="{{ route('listar.empresa.rt',['flag'=>"documentos"]) }}" style="text-decoration: none; color:#fff;cursor:pointer">Documentos</a></li>
                        @if(Auth::user()->status_cadastro == "aprovado")
                            <li style="float: left; margin-right:30px; font-family:arial"><a href="{{ route('listar.empresas', ['user' => Crypt::encrypt(Auth::user()->id), 'tipo' => 'documentacao']) }}" style="text-decoration: none; color:#fff;cursor:pointer">Documentação</a></li>
                            <li style="float: left; margin-right:30px; font-family:arial"><a href="{{ route('emconstrucao') }}" style="text-decoration: none; color:#fff;cursor:pointer">Notificação</a></li>
                            <li style="float: left; margin-right:30px;font-family:arial"></li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
        <div class="container">
            <hr style="background-color:red; color:#fff; border-color:#fff; border: solid 1px;">
        </div>
        <div class="container">
                <div class="row justify-content-center" style="text-align:center;">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-12">
                                <label style="color:#fff;font-family:arial">Desenvolvido por:</label>
                            </div>
                            <div class="col-12" style="margin-top:16px;">
                                <a target="_blank" href="http://lmts.uag.ufrpe.br/">
                                    <img src="{{ asset('/imagens/logo_lmts.png') }}" alt="Logo"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-12">
                                <label style="color:#fff;font-family:arial">Apoio:</label>
                            </div>
                            <div class="col-12">
                                <a href="http://ww3.uag.ufrpe.br/" target="_blank">
                                    <img src="{{ asset('/imagens/logo_ufape.png') }}" alt="Logo" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top:30px;">
                        <img src="{{ asset('/imagens/logo_secretaria.png') }}">
                    </div>
                </div>
        </div>
    </div>

</footer>

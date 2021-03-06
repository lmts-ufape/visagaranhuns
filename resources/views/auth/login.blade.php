@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="padding-bottom:2rem;">
        <div class="cardLogin" style="width:420px; padding-left:25px;padding-right:25px; padding-top:2rem; padding-bottom:2rem;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12 tituloBarraPrincipal" style="text-align:center">
                        <img src="{{ asset('/imagens/logo_visaGus_p.png') }}" alt="Logo"/>
                    </div>
                    <div class="col-md-12 tituloBarraPrincipal" style="text-align:center; margin-top:20px;margin-bottom:5px; color:#949494">Entrar</div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <label class="styleTituloDoInputCadastro" for="inputEmail4">E-mail</label>
                        <input id="email" type="email" class="styleInputCadastro @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <label class="styleTituloDoInputCadastro"  for="inputPassword4">Senha</label>
                        <input id="password" type="password" class="styleInputCadastro @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <button type="submit" class="btn btn-success" style="width:100%;">Entrar</button>
                    </div>
                    <div class="col-md-12" style="margin-top:10px; margin-bottom:20px;margin-left:38px;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-top:7px;">
                        <label class="form-check-label styleTituloDoInputCadastro" for="remember">
                            {{ __('Lembrar de mim') }}
                        </label>
                    </div>
                </div>
                <hr style="background-color:#d3d3d3; color:#d3d3d3; border-color:#d3d3d3; border: solid 0.5px;">
                <div class="styleTituloDoInputCadastro" style="margin-top:15px;">Esqueceu sua senha? <a href="{{ route('password.request') }}">Clique aqui</a></div>
            </form>
        </div>
    </div>
@endsection

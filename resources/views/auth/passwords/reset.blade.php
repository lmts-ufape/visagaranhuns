@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="padding-bottom:2rem;">
        <div class="cardLogin" style="width:420px; padding-left:25px;padding-right:25px; padding-top:2rem; padding-bottom:2rem;">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row justify-content-center">
                    <div class="col-md-12 tituloBarraPrincipal" style="text-align:center">
                        <img src="{{ asset('/imagens/logo_visaGus_p.png') }}" alt="Logo"/>
                    </div>
                    <div class="col-md-12 tituloBarraPrincipal" style="text-align:center; margin-top:20px;margin-bottom:5px; color:#949494">Redefinir senha</div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <label class="styleTituloDoInputCadastro" for="email">E-mail</label>
                        <input id="email" type="email" class="styleInputCadastro @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <label class="styleTituloDoInputCadastro"  for="password">Senha</label>
                        <input id="password" type="password" class="styleInputCadastro @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <label class="styleTituloDoInputCadastro"  for="password-confirm">Confirmar senha</label>
                        <input id="password-confirm" type="password" class="styleInputCadastro " name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <button type="submit" class="btn btn-success" style="width:100%;">Redefinir senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

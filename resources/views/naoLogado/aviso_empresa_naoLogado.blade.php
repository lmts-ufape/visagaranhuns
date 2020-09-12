@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 240px">
        <div class="row titulo col-md-12">
            <h1><strong>Confirmação de Cadastro</strong></h1>
        </div>
        <div class="row subtitulo">
            <div class="col-sm-12">
                <p>A solicitação de cadastro de usuário e empresa foi realizada com sucesso!

Seus dados encontram-se em avaliação, espere a sua aprovação para que possa ter acesso a outras funcionalidades do sistema.
    </p>
                <p><a class="btn btn-primary botao-form" style="width: 10%;" href="{{route("/")}}">Clique aqui</a> para voltar à página inicial</p>
            </div>
        </div>

    </div>
@endsection

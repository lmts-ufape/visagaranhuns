
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pendências</title>
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
    .line-title-2{
      border: 1;
      border-style: inset;
      border-top: 0px solid #808080;
    }
    .line-title-3{
      border: 1;
      border-style: inset;
      border-top: 0px solid #000;
      width: 175px;
    }
  </style>
</head>
<body>
  {{-- <img style="position: absolute; width: 60px; height: auto;" src="{{asset('imagens/logo_atencao2.png')}}"> --}}
  {{-- <img src="public/imagens/logo_atencao2.png" style="position: absolute; width: 60px; height: auto;"> --}}
  <table style="width: 100%;">
    <tr>
      <td align="center">
        <span style="line-height: 1.6; font-weight: bold;">
          Secretária de Saúde e Vigilância Sanitária de Garanhuns - PE
          <br>Pendência de Documentos
        </span>
      </td>
    </tr>
  </table>

  <hr class="line-title">

  <p style="text-align:left; font-size: 20px">
    <b>{{$empresa->nome}}</b> <br>
  </p>
  <div class="row">
    <div class="col-6" style="line-height: 10px">
      <b>CNPJ/CPF: {{$empresa->cnpjcpf}}</b>
    </div>
    <div class="col-6" style="margin-left: 300px; line-height: 10px;">
      <b>CEP: {{$endereco->cep}}</b>
    </div>      
  </div>
  <div class="row">
    <div class="col-4" style="line-height: 15px">
      <b>Tipo: {{$empresa->tipo}}</b> 
    </div>
    <div class="col-8" style="margin-left: 300px; line-height: 10px;">
      <b>Bairro: {{$endereco->bairro}}</b>
    </div>      
  </div>
  <div class="row">
    <div class="col-6" style="line-height: 10px">
      <b>Email: {{$empresa->email}}</b>
    </div>
    <div class="col-6" style="margin-left: 300px; line-height: 10px;">
      <b>Rua: {{$endereco->rua}}</b>
    </div>      
  </div>
  <div class="row">
    <div class="col-6" style="line-height: 10px">
      <b>Telefone 1: {{$telefone->telefone1}}</b>
    </div>
    <div class="col-6" style="margin-left: 300px; line-height: 10px;">
      <b>Complemento: {{$endereco->complemento}}</b>
    </div>      
  </div>
  <div class="row">
    <div class="col-6" style="line-height: 10px">
      <b>Telefone 2: {{$telefone->telefone2}}</b>
    </div>
    <div class="col-6" style="margin-left: 300px; line-height: 10px;">
      <b>Representante Legal: {{$empresa->user->name}}</b>
    </div>      
  </div>

  <hr class="line-title">

  <div class="form-group col-md-12">
    <label style="font-size:18px;margin-top:16px; margin-bottom:-5px;margin-left:-15px; font-family: 'Roboto', sans-serif;"><b>Áreas de atuação:</b></label>
  </div>

  @foreach ($areas as $indice)
    
    <div class="form-group col-md-12">
      <label style="font-size:18px;margin-top:16px; margin-bottom:-5px; margin-left:-15px; font-family: 'Roboto', sans-serif;"><b>-- {{$indice->areaNome}} --</b></label>
    </div>
    @foreach ($pendenciaDocs as $indice2)
      @if ($indice2->area == $indice->areaId)
        @if ($indice2->status == "false")
          
          {{$indice2->nome}} - Pendente<br/>
          
        @else
          
          {{$indice2->nome}} - Anexado<br/>
          
        @endif
      @endif
    @endforeach
  @endforeach
    
  <hr class="line-title">
  <p style="text-align:left; font-size: 20px">
    <b>Data de emissão: {{$emissao}}</b> <br>
  </p>
</body>
</html>
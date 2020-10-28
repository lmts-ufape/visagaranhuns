<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scae=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Histórico de inspeções</title>
</head>
<body>
    <h1>Histórico de inspeções</h1>
    
    {{-- <p>{{$dia}}/{{$mes}}/{{$ano}}</p> --}}
    @foreach ($empresas as $indice)
    <h3>{{$indice}}</h3>
    <table class="table">
            <thead>
                <tr>
                  <th scope="col">Data</th>
                  <th scope="col">Inspetor</th>
                  <th scope="col">Agente 1</th>
                  <th scope="col">Agente 2</th>
                  <th scope="col">Cnae</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($inspecao as $item)
                    @if ($item->empresa == $indice)
                        <tr>
                            <td>{{$item->data}}</td>
                            <td>{{$item->inspetor}}</td>
                            <td>{{$item->agente1}}</td>
                            <td>{{$item->agente2}}</td>
                            <td>{{$item->cnae}}</td>
                            <td>{{$item->status}}</td>
                        </tr>
                    @endif
                  @endforeach
              </tbody>
      </table>
      @endforeach
</body>
</html>
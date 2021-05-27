<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <title>Paginação</title>

</head>
<body class="">

    <div class="container mt-3">
        <div class="card text-center">
            <div class="card card-header">Tabela de Clientes</div>
            <div class="card card-body ">
                <h6>Exibindo {{$clientes->perPage()}} clientes de {{$clientes->total()}} ({{$clientes->firstItem()}} a {{$clientes->lastItem()}})</h6>
                <table class="table table-hover">
                    <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    </thead>
                    <tbody>
                    @foreach($clientes as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->nome}}</td>
                        <td>{{$c->sobrenome}}</td>
                        <td>{{$c->email}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card card-footer">
                {{$clientes->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
    <script src="{{URL::asset('js/app.js')}}" type="text/javascript"></script>
<?php var_dump($clientes); ?>
</body>
</html>

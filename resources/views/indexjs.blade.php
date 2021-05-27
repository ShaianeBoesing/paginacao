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
                <h6>Exibindo clientes de  ( a )</h6>
                <table class="table table-hover" id="tabelaClientes">
                    <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Marcela</td>
                        <td>Hammes</td>
                        <td>m@email.com</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="card card-footer">
                <nav id="paginator">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <script src="{{URL::asset('js/app.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            carregarClientes();
        });

        function carregarClientes(pagina) {
            console.log(pagina);
            $.get('/index/json', {page: pagina}, function (result) {
                console.log(result);
                montarTabela(result);
                montarPaginator(result);

                $('#paginator>ul>li>a').click(function () {
                    carregarClientes($(this).data('pagina'));
                });
            });
        };

        function montarTabela(data) {
            $('#tabelaClientes>tbody>tr').remove()
            for(i=0; i<data.data.length; i++){
                linha = montarLinha(data.data[i]);
                $('#tabelaClientes>tbody').append(linha)
            }
        };

        function montarLinha(cliente) {
            return "<tr>" +
                "<td>"+ cliente.id +"</td>" +
                "<td>"+ cliente.nome +"</td>" +
                "<td>"+ cliente.sobrenome +"</td>" +
                "<td>"+ cliente.email +"</td>" +
                "</tr>";
        }

        function montarPaginator(data) {
            $('#paginator>ul>li').remove();
            $('#paginator>ul').append(getItemAnterior(data));

            var total = 10;

            if(data.current_page - total/2 <= 1) {
                var min = 1;
                var max = min + total - 1;
            }else if (data.current_page + total/2  > data.last_page){
                max = data.last_page;
                min = max - total+1;
            } else {
                 min = data.current_page - total/2;
                 max = data.current_page + (total/2)-1;
            }
            for(var i=min; i<=max ; i++){
                item = getItem(data, i);
                $('#paginator>ul').append(item);
            }
            $('#paginator>ul').append(getItemPosterior(data))
        }

        function getItem(data, i) {
            indice = i;
            if (i == data.current_page){
                item = '<li class="page-item active" ><a class="page-link" >'+i+'</a></li>';
            } else {
                item = '<li class="page-item" ><a class="page-link"  data-pagina="'+ i +'" href="">'+i+'</a></li>';
            }
            return item;
        }

        function getItemAnterior(data) {
            indice = data.current_page - 1;
            if (data.current_page == 1){
                item = '<li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>';
            } else {
                item = '<li class="page-item" ><a class="page-link" data-pagina="'+ indice +'" href="">Anterior</a></li>';
            }
            return item;
        }

        function getItemPosterior(data) {
            indice = data.current_page+1;
            if (data.current_page == data.last_page){
                item = '<li class="page-item disabled"><a class="page-link" href="#">Próxima</a></li>';
            } else {
                item = '<li class="page-item" ><a class="page-link" data-pagina="'+ indice +'" href="">Próxima</a></li>';
            }
            return item;
        }
    </script>
</body>
</html>

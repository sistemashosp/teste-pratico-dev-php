<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container main-section">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light mt-3">
                <div class="card-header">
                    Importação de arquivo CSV
                </div>
                <div class="card-body">
                    <form action="store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar CSV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="wrapper wrapper-content tooltip-demo">
        <table class="table table-hover" id="index">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Data Nascimento</th>
                <th>Gênero</th>
                <th>Tipo Sanguíneo</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>CPF</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>

    var table = $('#index').DataTable({
        stateSave: true,
        processing: true,
        serverSide: true,
        ajax: '{!! url('dadosindex') !!}',
        columns: [
            {data: 'nome', name: 'nome', "sWidth": "10%"},
            {data: 'sobrenome', name: 'sobrenome', "sWidth": "50%"},
            {data: 'email', name: 'email', "sWidth": "20%"},
            {data: 'datanascimento', name: 'datanascimento', "sWidth": "10%"},
            {data: 'genero', name: 'genero', "sWidth": "10%"},
            {data: 'tiposanguineo', name: 'tiposanguineo', "sWidth": "10%"},
            {data: 'endereco', name: 'endereco', "sWidth": "10%"},
            {data: 'cidade', name: 'cidade', "sWidth": "10%"},
            {data: 'estado', name: 'estado', "sWidth": "10%"},
            {data: 'cep', name: 'cep', "sWidth": "10%"},
            {data: 'cpf', name: 'cpf', "sWidth": "10%"},


        ]/*,
            createdRow: function (row, data, dataIndex) {
                $(row).find('td:eq(4)').addClass('');
                $(row).find('td:eq(3)').addClass('truncate');
                $(row).find('td:eq(2)').addClass('truncate');
                $(row).find('td:eq(1)').addClass('truncate');
            }*/

    });
</script>


</body>
</html>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Pacientes</title>
</head>
<body>
    <div class="mt-5 mx-5 mb-5">
        <h1>Pacientes</h1>

        <table class="table table-striped table-bordered text-center d-none">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>Nascimento</th>
                    <th>Gênero</th>
                    <th>Tipo sanguíneo</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div id="paginacao" class="d-none mb-3">
            <a id="proximo" onclick="incrementar()" href="">Proximo</a>
            <span id="numPage"></span>
            <a id="anterior" href="" onclick="decrementar()">Anterior</a>
        </div>

        <p id="semPacientes" class="d-none">Não existem pacientes cadastrados.</p>
        <p id="carregando">Carregando...</p>
        <p id="erro" class="d-none">Ocorreu erro ao listar os pacientes.</p>
    </div>

    <script src="js/axios.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
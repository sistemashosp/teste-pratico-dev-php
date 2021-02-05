<!DOCTYPE html>
<html>

<head>
    <title>Lista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Email</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Genero</th>
                <th scope="col">Tipo sanguineo</th>
                <th scope="col">Endereço</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">CEP</th>
                <th scope="col">CPF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /**
             * Mostra os dados da tabela que estão inseridos no banco de dados
             *
             * A idéia aqui é mostrar em uma tabela html os dados registrados 
             * no banco de dados envolvendo a tabela paciente e tipo_sanguineo.
             */
            $conn = mysqli_connect("localhost", "root", "root", "teste_pratico_php");
            if ($conn->connect_error) {
                die("Conexão com falha: " . $conn->connect_error);
            }

            $sql = "SELECT nome, sobrenome, email, data_nascimento, genero, id_tipo_sanguineo, endereco, cidade, estado, cep, cpf from paciente INNER JOIN tipo_sanguineo ON paciente.id_tipo_sanguineo = tipo_sanguineo.id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['nome'] . "</td><td>" . $row['sobrenome'] . $row['email'] . "</td><td>" . $row['email'] . "</td><td>" . $row['data_nascimento'] . "</td><td>" . $row['genero'] . "</td><td>" . $row['id_tipo_sanguineo'] . "</td><td>" . $row['endereco'] . "</td><td>" . $row['cidade'] . "</td><td>" . $row['estado'] . "</td><td>" . $row['cep'] . "</td><td>" . $row['cpf'] . "</td><td>" . "</td><tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
<?php

require_once('conexion.php');
$consulta = $conn->query("SELECT *  FROM tb_pacientes INNER JOIN tb_tiposanguineo ON tb_pacientes.id_tipoSanguineo = tb_tiposanguineo.id;");
$consulta2 = $conn->query("SELECT *  FROM tb_tiposanguineo ;");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Lista</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Pacientes</h2>          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>nome</th>
        <th>sobrenome</th>
        <th>cpf</th>
        <th>email</th>
        <th>data de nascimento</th>
        <th>genero</th>
        <th>Id do tipo sanguineo</th>
        <th>Endereço</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>CEP</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <tr>
        <td><?= $linha['nome']; ?></td>
        <td><?= $linha['sobrenome']; ?></td>
        <td><?= $linha['cpf']; ?></td>
        <td><?= $linha['email']; ?></td>
        <td><?= $linha['dataNascimento']; ?></td>
        <td><?= $linha['genero']; ?></td>
        <td><?= $linha['id_tipoSanguineo']; ?></td>
        <td><?= $linha['endereco']; ?></td>
        <td><?= $linha['cidade']; ?></td>
        <td><?= $linha['estado']; ?></td>
        <td><?= $linha['cep']; ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <h2>Tipos sanguineos</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tipo sanguineo</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while ($linha = $consulta2->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <tr>
        <td><?= $linha['id']; ?></td>
        <td><?= $linha['descricao']; ?></td>
        
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

           
  


</body>
</html>
<?php

require 'config.php';

$lista=[];
$sql = $pdo->query("SELECT * FROM pacientes");
if ($sql->rowCount()>0) {
            $lista= $sql->fetchAll(PDO::FETCH_ASSOC);
}




?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Painel de Controle Shosp</title>
</head>

<body>


<div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                    <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>SOBRENOME</th>
                            <th>EMAIL</th>
                            <th>DATA NASCIMENTO</th>
                            <th>GENERO</th>
                            <th>TIPO SANGUINEO</th>
                            <th>ENDEREÇO</th>
                            <th>CIDADE</th>
                            <th>ESTADO</th>
                            <th>CEP</th>
                            <th>CPF</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php  function formataCpf($cpf) {
                         
                        $formatado = substr($cpf, 0, 3) . '.';
                        $formatado .= substr($cpf, 3, 3) . '.';
                        $formatado .= substr($cpf, 6, 3) . '-';
                        $formatado .= substr($cpf, 9, 2) . '';

                        return $formatado;
                            } ?>

                        <?php foreach($lista as $usuario):?>
                        <tr>
                            <td><?=$usuario['id'];?></td>
                            <td><?=$usuario['nome'];?></td>
                            <td><?=$usuario['sobrenome'];?></td>
                            <td><?=$usuario['email'];?></td>
                            <td><?=date("d-m-Y", strtotime($usuario['datanascimento']));?></td>
                            <td><?=($usuario['genero'] == 'M') ? 'Masculino' : 'Feminino';?></td>
                            <td><?=$usuario['tiposanguineo'];?></td>
                            <td><?=$usuario['endereco'];?></td>
                            <td><?=$usuario['cidade'];?></td>
                            <td><?=$usuario['estado'];?></td>
                            <td><?=$usuario['cep'];?></td>


                            <td><?=formataCpf($usuario['cpf']);?></td>
                        </tr>
                        <?php endforeach;?>

                    <tbody>

                </table>
</div>
            </div>
        </div>
    </div>









</body>

</html>
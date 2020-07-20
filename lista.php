<?php

include ("../source/Config.php");

$consulta = "SELECT * FROM paciente";
$con = $pdo->query($consulta) or die($pdo->error);

?>

<html>
<head>
    <meta charset="utf8">
    </head>
<body>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>sobrenome</td>
            <td>cpf</td>
            <td>email</td>
            <td>data_nascimento</td>
            <td>genero</td>
            <td>id_tipo_sanguineo</td>
            <td>endereco</td>
            <td>cidade</td>
            <td>estado</td>
            <td>cep</td>
        </tr>
        <?php while ($consulta = $con->fetch_array()){?>
            <tr>
                <td><?php echo $paciente["id"];?></td>
                <td><?php echo $paciente["nome"];?></td>
                <td><?php echo $paciente["sobrenome"];?></td>
                <td><?php echo $paciente["cpf"];?></td>
                <td><?php echo $paciente["email"];?></td>
                <td><?php echo $paciente["data_nascimento"];?></td>
                <td><?php echo $paciente["id_tipo_sanguineo"];?></td>
                <td><?php echo $paciente["endereco"];?></td>
                <td><?php echo $paciente["cidade"];?></td>
                <td><?php echo $paciente["estado"];?></td>
                <td><?php echo $paciente["cep"];?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

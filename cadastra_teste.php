<?php

//conexao com o banco postgre
include('conexao.php');

//abre csv file
if (($handle = fopen("pacientes_teste.csv", "r")) !== FALSE) {

    $flag = true;
    $id=1;

    //Pegar o dado de cada linha
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        if ($flag) {
            $flag = false;
            continue;
        }

        //retornar data de cada coluna
        $nome      = $data[0];
        $sobrenome = $data[1];
        $cpf   = $data[2];
        $email   = $data[3];
        $dataNascimento   = $data[4];
        $genero   = $data[5];
        $idTipoSanguineo   = $data[6];
        $endereco   = $data[7];
        $cidade   = $data[8];
        $estado   = $data[9];
        $CEP   = $data[10];

        //Consulta de inserção no banco de dados
        $sql = "INSERT INTO 'public'.'pacientes' 
                ('nome','sobrenome', 'cpf', 'email','datanascimento','genero','idtiposanguineo','endereco','cidade','estado','cep')
                VALUES 
                ('$nome','$sobrenome','$cpf','$email','$dataNascimento','$genero','$idTipoSanguineo','$endereco','$cidade','$estado','$CEP')";

        echo $sql;

        //executar a inserção
        $retval = mysql_query($sql, $conn);

        if($retval == false )
        {
          die('Não foi possível cadastrar o dado: ' . mysql_error());
        }

        echo "<p style='color: green;'>Inserido o dado com o nome = " .$nome. " Sucesso.</p><br>";
        $nome++;
    }

    echo "<br><p style='color: orange;'>Parabéns dados inseridos com sucesso.</p>";

    fclose($handle);
}

//Finalizar a conexão
mysql_close($conn);
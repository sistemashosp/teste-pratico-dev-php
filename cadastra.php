<?php
require "config.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importação de dados</title>
</head>

<body>
</body>

</html>

<?php

$sql = $pdo->query("SELECT * FROM pacientes");
if ($sql->rowCount()>0) {
    $sql = $pdo->prepare("TRUNCATE TABLE pacientes");
    $sql->execute();
    echo" base de dados zerada!";

}else {

    


$file_name = "pacientes.csv";

$objeto =fopen($file_name,'r');

while(($dados = fgetcsv($objeto, 1000,",")) !== FALSE)
{
   
   
  
  
  

    $sql = $pdo->prepare("INSERT INTO pacientes (nome,sobrenome,email,datanascimento,genero,tiposanguineo,endereco,cidade,estado,cep,cpf) VALUES (:nome,:sobrenome,:email,:datanascimento,:genero,:tiposanguineo,:endereco,:cidade,:estado,:cep,:cpf)");
    $sql->bindValue(':nome',$dados[0]);
    $sql->bindValue(':sobrenome',$dados[1]);
    $sql->bindValue(':email',$dados[2]);
    $sql->bindValue(':datanascimento', date("Y-m-d", strtotime($dados[3])));
    $sql->bindValue(':genero',$dados[4]);
    $sql->bindValue(':tiposanguineo',$dados[5]);
    $sql->bindValue(':endereco',$dados[6]);
    $sql->bindValue(':cidade',$dados[7]);
    $sql->bindValue(':estado',$dados[8]);
    $sql->bindValue(':cep',$dados[9]);
    $sql->bindValue(':cpf',$dados[10]);
    $sql->execute();
    

    

    
}

fclose($objeto);
echo"enviado com Sucesso";

}

?>
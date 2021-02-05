<?php
require_once("db.php");
require_once("functions.php");

 $handle  = fopen("pacientes.csv", "r");
 $arquivo = Array();
 $campo = Array();
 $count  = 1;
 
 while  ($linha = fgetcsv($handle, 1000, ";"))  {
 
  if  ($count == 1)  {
     
   $campo = $linha;
     
  }  else  {
    
   $arquivo[] = array_combine($campo, $linha);
  
  }
  
  $count++;
 
 }

 $sql2 = "DELETE FROM tb_pacientes ";
    $stmt= $conn->query($sql2);

foreach ($arquivo as $arquivos){
    $nome = $arquivos['nome'];
    $sobrenome = $arquivos['sobrenome'];
    $cpf = $arquivos['cpf'];
    $email = $arquivos['email'];
    $dataNascimento = $arquivos['dataNascimento'];
    $genero = $arquivos['genero'];
    $id_tipoSanguineo = $arquivos['id_tipoSanguineo'];
    $endereco = $arquivos['endereco'];
    $cidade = $arquivos['cidade'];
    $estado = $arquivos['estado'];
    $cep = $arquivos['cep'];

    if(!empty($dataNascimento)){
        echo "Você colocou a data de nascimento corretamente! " . '<br>';
    } else {
        echo "Você não pode enviar uma data de nascimento vazia ou nula! na lista da(o) "  . $nome . '<br>';
        exit;
    }
    if(!empty($cpf)){
        echo "Você colocou o CPF corretamente !<br>";
    } else {
        echo "Você não pode enviar um CPF vazio ou nulo! na lista da(o) " . $nome . '<br>';
        exit;
    }
    if(!empty($email)){
        echo "Você colocou o email corretamente !<br>";
    } else {
        echo "Você não pode enviar um email vazio ou nulo! na lista da(o) " . $nome . '<br>';
        exit;
    }

    $data = [
        'nome' => $nome,
        'sobrenome' => $sobrenome,
        'cpf' => $cpf,
        'email' => $email,
        'dataNascimento' => validaNascimento($dataNascimento),
        'genero' => $genero,
        'id_tipoSanguineo' => $id_tipoSanguineo,
        'endereco' => $endereco,
        'cidade' => $cidade,
        'estado' => $estado,
        'cep' => $cep
    ];
    
    

    $sql = "INSERT INTO tb_pacientes (nome, sobrenome, cpf, email, dataNascimento, genero, id_tipoSanguineo, endereco, cidade, estado, cep) VALUES (:nome, :sobrenome,  :cpf, :email, :dataNascimento, :genero, :id_tipoSanguineo, :endereco, :cidade, :estado, :cep)";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);

}




echo "<pre>";
var_dump($arquivo);
echo "</pre>";
?>
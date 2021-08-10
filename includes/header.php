<?php 
 require 'classes/Conexao.php';
 require 'classes/Pacientes.php';
 require 'helpers/validator.php';
  if(isset($_REQUEST['nome']))
  {
   
     $nome       = trim(strip_tags($_POST['nome']));
     $sobrenome  = trim(strip_tags($_POST['sobrenome']));
     $cpf        = trim(strip_tags($_POST['cpf']));
     $email      = trim(strip_tags($_POST['email']));
     $dataNac    = trim(strip_tags($_POST['datanascimento']));
     $genero     = trim(strip_tags($_POST['genero']));
     $tipo       = trim(strip_tags($_POST['tipo']));
     $endereco   = trim(strip_tags($_POST['endereco']));
     $cidade     = trim(strip_tags($_POST['cidade']));
     $estado     = trim(strip_tags($_POST['estado']));
     $cep        = trim(strip_tags($_POST['cep']));
    
    

    $flag = 1;

    if(strlen($nome) < 3){
        $errors = "Nome Inválido";
        $flag = 0;
     }

     if($cpf && !validaCPF($cpf)){
        $errors = "CPF inválido";
        $flag = 0;
     }
     if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors= "E-MAIL inválido";
      $flag = 0;
     }

    if(!ValidaData($dataNac)) {
      $errors = "Data inválida";
      $flag = 0;
    }

  
    $dataNac = converterData($dataNac);
    $Paciente = new Pacientes();
  
  
 
    $lastId = $Paciente->LastIdPaciente();

 
     $Paciente->addPaciente($nome, $sobrenome , $cpf , $email , $dataNac, $genero ,
     $tipo , $endereco , $cidade , $estado , $cep);
     $errors = "Cadastrado com sucesso";
     
    }

  

  

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHOP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
    $('#datanascimento').mask('00/00/0000');
    $('#cpf').mask('000.000.000-07')
});

</script>
  <link rel="stylesheet" href="assets/style.css">

</head>
<body>

<div class="container">
<?php include('includes/nav.php'); ?>
  <h2>Cadastrar Paciente</h2>

  <a href="index.php" class="btn btn-success">Home</a> 
  <?php 
    if(isset($errors)){
?>
  <div class="alert alert-success">
   <?php 
      echo $errors;
    ?>
  </div>
  <?php 
}
    ?>
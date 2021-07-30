<?php 
    require 'classes/Conexao.php';
    require 'classes/Pacientes.php';    
?>
      

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Teste</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <?php include('includes/nav.php'); ?>

    <form action="index.php" method="POST" enctype="multipart/form-data">
      <input type="submit" name="cadastrar" class="btn btn-success" value="Criar CRV">
    </form>

   
  <table class="table">
    <thead>
      <tr>
         <th>id</th>
        <th>Nome</th>
        <th>SobreNome</th>
        <th>Email</th>
        <th>Data Nascimento</th>
        <th>genero</th>
        <th>Tipo Sabguineo</th>
        <th>Endereço</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Cep</th>
        <th>cpf</th>
      

      </tr>
    </thead>
    <tbody>
        <?php

        $Paciente = new Pacientes();
        $Listarpacientes = $Paciente->Listar();
        
        
          
        foreach($Listarpacientes as $paciente){
            extract($paciente);
            ?>
          
      <tr>
      <td><?php echo $id ?></td>
        <td><?php echo $nome ?></td>
        <td><?php echo $sobrenome ?></td>
        <td><?php echo $CPF ?></td>
        <td><?php echo $email ?></td>
        <td><?php echo $dataNascimento ?></td>
        <td><?php echo $tiposanguineo ?></td>
        <td><?php echo $endereco ?></td>
        <td><?php echo $cidade ?></td>
        <td><?php echo $estado ?></td>
        <td><?php echo $CEP ?></td>
        <td><?php echo $CPF?></td>
      </tr>
   <?php 
  } 

  ?>
    </tbody>
  
  </table>

</div>

</body>
</html>



    
<?php echo "Seu código aqui"; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de Pacientes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<table id="tabelaCliente">
        <tr>
        	<th>Nome</th>
        	<th>Sobrenome</th>
        	<th>CPF</th>
        	<th>E-mail</th>
        	<th>Data de Nascimento</th>
        	<th>Genero</th>
        	<th>Tipo Sanguineo</th>
        	<th>Endereco</th>
        	<th>Cidade</th>
        	<th>Estado</th>
        	<th>CEP</th>
        </tr>
    </table>
	<? include "cadastra_teste.php"; ?>
	
</body>
</html> 

<?php 
require 'config.php';
require 'dao/PacienteDaoMysql.php';
require 'dao/SangueDaoMysql.php';
$pacienteDao = new PacienteDaoMysql($pdo);
$sangueDao = new SangueDaoMysql($pdo);

$lista = $pacienteDao->findAll();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=width-device,initial-scale=1,shrink-to-fit=no" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<title>Pacientes</title>
	</head>

	<body>
	<div class="container-fluid">

		<div class="row">
			
			<a class="col-4 btn btn-primary" href="cadastrar.php">Cadastrar</a>
			
		</div>

		<br />

		<table class="table table-hover">

			<tr>
				<th>NOME</th>
				<th>SOBRENOME</th>
				<th>EMAIL</th>
				<th>DATA NASCIMENTO</th>
				<th>GENERO</th>
				<th>ID TIPO SANGUINEO</th>
				<th>DESCRIÇÃO TIPO SANGUINEO</th>
				<th>ENDEREÇO</th>
				<th>CIDADE</th>
				<th>ESTADO</th>
				<th>CEP</th>
				<th>CPF</th>
			</tr>

			<?php

				
			
				foreach($lista as $paciente): ?>

					<tr>
						<td><?=$paciente->getNome();?></td>
						<td><?=$paciente->getsobrenome();?></td>
						<td><?=$paciente->getEmail();?></td>
						<td><?=$mysqldate = date( 'm/d/Y', strtotime( $paciente->getDataNascimento() ) );?></td>
						<td><?=$paciente->getGenero();?></td>
						<td><?=$paciente->getIdTipoSanguineo();?></td>
						<td>
							<?php 
								$id = $paciente->getIdTipoSanguineo();
								$descricao = $sangueDao->findById($id);							
								echo $descricao->getDescricao();
							?> 
						</td>
						<td><?=$paciente->getEndereco();?></td>
						<td><?=$paciente->getCidade();?></td>
						<td><?=$paciente->getEstado();?></td>
						<td><?=$paciente->getCep();?></td>						
						<td><?=$paciente->getCpf();?></td>
					</tr>

				<?php endforeach; ?>
			
		</table>

	</div>

		<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
	</body>

</html>



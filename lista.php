<!DOCTYPE html>
<html>
<head>
	<title>Listar Pacientes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/mystyle.css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/script.js" charset="utf-8"></script>
</head>
<body>
	<div class="banner">
		<img class="imgBanner" src="src/banner-paciente-1.jpg">
	</div>
	<table id="tableCliente">
        <tr>
        	<th>nome</th>
        	<th>Sobrenome</th>
        	<th>CPF</th>
        	<th>E-mail</th>
        	<th>Data de nascimento</th>
        	<th>Genero</th>
        	<th>Tipo sanguineo</th>
        	<th>Endereco</th>
        	<th>Cidade</th>
        	<th>Estado</th>
        	<th>CEP</th>
        	<tbody class="corpoTabela"></tbody>
        </tr>
    </table>
    <center><img id="btn_anterior" src="src/transferir.png"> <img id="btn_proximo" src="src/transferir_direita.png"></center>
	<div id="LOADINGSAVE">
		<img src="src/load.gif" width="100%">
	</div>
</body>
<footer>
	<img src="src/logo.png" class="logo_img">
	<p>© Copyright - All Rights Reserved</p>
</footer>
</html>
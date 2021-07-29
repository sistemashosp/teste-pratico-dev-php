<?php
// BANCO DE DADOS
// Dados para conexao
$server = "localhost";
$user = "teste";
$password = "teste123";
$dbname = "cadastraPacientes";

// Cria conexao
$conn = new mysqli($server, $user, $password, $dbname);

// Verifica se a conexao foi bem sucedida
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Leitura do arquivo csv para cadastro
$read = fopen("pacientes.csv", "r");

while ($data = fgetcsv($read, ",")) {
	// Tratamento da data - conversao string para date
	$time = strtotime($data[3]);
	$dataFormatada = date('Y-m-d',$time);

	// Identificacao do tipo sanguineo
	$select = "SELECT id FROM tipo_sanguineo WHERE descricao = '$data[5]'";
	$result = mysqli_query($conn, $select);
	$id = mysqli_fetch_assoc($result);
	$id_tipo_sanguineo = $id["id"];

	// Montagem do array com as informacoes extraidas do csv
	$dataInsert = array(
		'nome' => $data[0],
		'sobrenome' => $data[1],
		'email' => $data[2],
		'data_nascimento' => $dataFormatada,
		'genero' => $data[4],
		'id_tipo_sanguineo' => $id_tipo_sanguineo,
		'endereco' => $data[6],
		'cidade' => $data[7],
		'estado' => $data[8],
		'cep' => $data[9],
		'cpf' => $data[10]
	);
	// Montagem da Query de Insercao
	$sql = sprintf("INSERT INTO paciente (%s) VALUES ('%s');",
	implode(',', array_keys($dataInsert)),
	implode("','", array_values($dataInsert))
	);

	// Realiza a Insercao no Banco de Dados, retornando mensagem de erro caso haja algum problema
	if (mysqli_query($conn, $sql)){
		continue;
	} else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

// Fecha a leitura do arquivo CSV
fclose($read);

// Fecha a conexao com o Banco de dados
mysqli_close($conn);
?>

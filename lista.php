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

// Busca Dados dos Pacientes no Banco de Dados
$select = "SELECT * FROM paciente";
$result = mysqli_query($conn, $select);
?>

<!-- Estrutura da tabela -->
<html>
<head>
<meta charset="utf-8">
</head>
<table border="1">
    <thead>
        <tr>
            <th colspan="11" style="background-color: #DCDCDC">
                 <p align="center">PACIENTES</p>
            </th>
        </tr>
        <tr style="background-color: #F0F8FF">
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Data Nascimento</th>
            <th>Genero</th>
            <th>Tipo Sangúineo</th>
            <th>Endereco</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>CEP</th>                                    
        </tr>
    </thead>        
    <?php
        // Inicia o loop para exibicao dos dados
        while($data = mysqli_fetch_assoc($result)){
    ?>
    <tbody>
        <tr> 
            <th scope="row"><?php echo $data['nome'];?></th>
            <td><?php echo $data['sobrenome'];?></td>
            <td><?php echo $data['cpf'];?></td>
            <td><?php echo $data['email'];?></td>
            <td><?php echo $data['data_nascimento'];?></td>
            <td><?php echo $data['genero'];?></td>
            <td><?php echo $data['id_tipo_sanguineo'];?></td>
            <td><?php echo $data['endereco'];?></td>
            <td><?php echo $data['cidade'];?></td>
            <td><?php echo $data['estado'];?></td>
            <td><?php echo $data['cep'];?></td> 
        </tr>
    </tbody>
    <?php 
    }
    ?>
</table>
</html>
<?php
// Fecha a conexao com o Banco de dados
mysqli_close($conn);
?>

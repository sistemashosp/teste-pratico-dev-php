<?php 

require_once('controller/paciente.php');
require_once('classes/connection.php');

use TesteCSV\Connection as Connection;
use TesteCSV\PacienteDB as PacienteDB;

try {
    // Conexao com banco
    $pdo = Connection::get()->connect();
    $pacienteDB = new PacienteDB($pdo);
    $result = $pacienteDB->lista_paciente();
    
    echo "<table>";

    foreach($result as $value){

    echo "<tr style='border: 1px solid black'>";
        echo "<td style='border: 1px solid black'>";
        echo $value['nome'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['sobrenome'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['cpf'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['email'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo date('d/m/Y', strtotime($value['data_nascimento']));
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['descricao'];
        echo "</td>";  
        echo "<td style='border: 1px solid black'>";
        echo $value['genero'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['endereco'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['cidade'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['estado'];
        echo "</td>";
        echo "<td style='border: 1px solid black'>";
        echo $value['cep'];
        echo "</td>";  
    echo "</tr>";

    }

    echo "</table>";

} catch (\PDOException $e) {
    echo $e->getMessage();
}


?>
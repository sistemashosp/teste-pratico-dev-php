<?php

$host = "pgsql03-farm70.uni5.net";  
$port = 5432;  
$bdname = "shosp6";  
$user = "shosp6"; 
$password = "121f3jnytlIvD"; 

$conexao = pg_connect($host, $port, $dbname, $user) or die ("Não foi possível conectar no banco de dados");

echo "Banco conectado com Sucesso";

?>
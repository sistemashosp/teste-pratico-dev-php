<?php

try {
    $Host = 'localhost';
    $Database = 'shosp';
    $User = 'root';
    $Pass = '';

    $Conn = new PDO('mysql:host=' . $Host . ';dbname=' . $Database, $User, $Pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
    $Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro no arquivo: <b>#{$e->getFile()}</b><br />"
    . "Erro na Linha: <b>#{$e->getLine()}</b><br />"
    . "Código do erro: <b>#{$e->getCode()}</b><br />"
    . "Mensagem de erro: <b>#{$e->getMessage()}</b><br />";
    die('<hr><br /> <h3>Erro na conexão com o banco de dados!</h3>');
}

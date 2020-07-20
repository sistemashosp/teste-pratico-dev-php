<?php

require_once('controller/paciente.php');
require_once('controller/tipo_sanguineo.php');
require_once('classes/connection.php');

use TesteCSV\Connection as Connection;
use TesteCSV\PacienteDB as PacienteDB;
use TesteCSV\tipo_sanguineoDB as tipo_sanguineoDB;


try {
    // Conexao com banco
    $pdo = Connection::get()->connect();
    echo 'PostgreSQL database conectado.</br>';
    $pacienteDB = new PacienteDB($pdo);

    // deletando todas as informacoes das tabelas antes da insercao
    $deletedRows = $pacienteDB->deleteAll();
    echo 'O numero de linhas deletadas da Tabela Paciente foi ' . $deletedRows . '<br>';
    
    $Tipo_sanguineoDB = new tipo_sanguineoDB($pdo);
    $deletedRows2 = $Tipo_sanguineoDB->deleteAll();
    echo 'O numero de linhas deletadas da Tabela tipo_sanguineo foi ' . $deletedRows2 . '<br>';

    $fileHandle = fopen("pacientes.csv", "r");
    $i = 0;
    
while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    
    if($i > 0){
        $desc_tipo = $row[5];
        $result = $Tipo_sanguineoDB->Select($desc_tipo);
        $result = $result->fetchAll();
        $nome = $row[0];
        $sobrenome = $row[1];
        $cpf = $row[10];
        $email = filter_var($row[2], FILTER_VALIDATE_EMAIL);
        $data_nascimento = date($row[3]);
        $genero = $row[4];
        $endereco = $row[6];
        $cidade = $row[7];
        $estado = $row[8];
        $cep = $row[9];


        if($result['descricao']){
           $id_tipo_sanguineo = $result['id'];
           $pacienteDB->Insert_Paciente($nome,$sobrenome,$cpf,$email,$data_nascimento,$genero,$id_tipo_sanguineo,$endereco,$cidade,$estado,$cep);
        }else{
           $r_tipo = $Tipo_sanguineoDB->Insert_Tipo($desc_tipo);
           $id_tipo_sanguineo = $r_tipo;
           $pacienteDB->Insert_Paciente($nome,$sobrenome,$cpf,$email,$data_nascimento,$genero,$id_tipo_sanguineo,$endereco,$cidade,$estado,$cep);
        }
    }
        $i++;
}


} catch (\PDOException $e) {
    echo $e->getMessage();
}

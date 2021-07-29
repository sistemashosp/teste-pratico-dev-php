<?php

require 'models/pacientes.php';
require 'models/tipoSanguineo.php';
require 'models/verificaConexao.php';

    function SelecionaPacientes (){

        $conexao = new VerificaConexao;

        $sql_query = "SELECT 'paciente'.*, 'tipo_sanguineo' * FROM paciente";

        $mostra_query = pg_query($conexao, $sql_query); 

    }

    function CadastraPacientes (){

        $conexao = new VerificaConexao;
        $novo_paciente = new Pacientes;

        $sql_query = "INSERT INTO paciente
                    (nome, sobrenome, cpf, email, nascimento, genero, endereco, cidade, estado, cidade, estado, 
                    cep, id, descricao) 
                    VALUES 
                    ($nome, $sobrenome, $cpf, $email, $data_nascimento, $genero, $endereco, $cidade, $cep, $id_tipo_sanguineo, $descricao_tipo_sanguineo)";

        if ($conexao->query($sql_query) === TRUE) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Não foi possível realizar o processdimento. Erro: " . $sql_query . "<br>" . $conexao -> error;
        }

        $conexao->close();

    }

?>

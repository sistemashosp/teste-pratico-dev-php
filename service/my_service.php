<?php

    require_once 'connection.php';

    class MyService {

        //Paciente
        //Busca e exibe todos os livros de determinado usuário
        public function listaPacientes() {
            $c = Connection::getConnection();
            $result = $c->query("SELECT * FROM pacientes")->fetchAll(); 
            return $result;
        }

        //Cria novo paciente
        public function criarPaciente($nome, $sobrenome, $cpf, $datanascimento, $genero, $endereco, $cidade, $estado, $cep, $idTipoSanguineo) {
            $c->exec("INSERT INTO pacientes (nome, sobrenome, cpf, email, datanascimento, genero, endereco, cidade, estado, cep, idTipoSanguineo) values ('$nome', '$sobrenome', '$cpf', '$datanascimento', '$genero', '$endereco', '$cidade', '$estado', '$cep', '$idTipoSanguineo')");
            try {
                $c = Connection::getConnection();
                $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $c->prepare('INSERT INTO pacientes (nome, sobrenome, cpf, datanascimento, genero, endereco, cidade, estado, cep, idTipoSanguineo) VALUES (:nome, :sobrenome, :cpf, :datanascimento, :genero, :endereco, :cidade, :estado, :cep, :idTipoSanguineo)');
                $stmt->execute([
                    ':nome' => $nome,
                    ':sobrenome' => $sobrenome,
                    ':cpf' => $cpf,
                    ':datanascimento' => $datanascimento,
                    ':genero' => $genero,
                    ':endereco' => $endereco,
                    ':cidade' => $cidade,
                    ':estado' => $estado,
                    ':cep' => $cep,
                    ':idTipoSanguineo' => $idTipoSanguineo
                ]);
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        //Tipo Sanguíneo
        //Cria novo tipo sanguíneo
        public function criarTipoSanguineo($descricao) {
            try {
                $c = Connection::getConnection();
                $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $c->prepare('INSERT INTO tipos (id, descricao) VALUES (:id, :descricao)');
                $stmt->execute([
                    ':id' => $id,
                    ':descricao' => $descricao
                ]);
                //echo $stmt->rowCount();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

?>
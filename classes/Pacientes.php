<?php

class Pacientes
{

    public function Listar()
    {
        $array = array();
        global $pdo;

        $sql = $pdo->query("SELECT *,
        (select tiposanguineo.descricao from tiposanguineo where tiposanguineo.id = paciente.idTipoSanguineo
                ) as tiposanguineo
                FROM paciente");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function ListarTipoSanguineo()
    {
        $array = array();
        global $pdo;

        $sql = $pdo->query("SELECT * FROM tiposanguineo");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function LastIdPaciente()
    {
        $array = array();
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM paciente order by id desc");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array['id'];
    }

    public function LastIdTipoSanquineo()
    {
        $array = array();
        global $pdo;


        $sql = $pdo->prepare("SELECT id FROM tiposanguineo order by id desc");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array['id'];
    }

    public function addPacienteECSV(
        $nome,
        $sobrenome,
        $cpf,
        $email,
        $dataNascimento,
        $genero,
        $idTiposanguineo,
        $endereco,
        $cidade,
        $estado,
        $cep
    ) {


        try {
            global $pdo;
            global $conn;

            $sql = $pdo->prepare(
                "INSERT INTO paciente  set
                            nome         = :nome , 
                            sobrenome   = :sobrenome ,
                            cpf         = :cpf ,
                            email       = :email ,        
                            dataNascimento        = :dataNascimento , 
                            genero       = :genero,
                            idTipoSanguineo       = :idTipoSanguineo,
                            endereco     = :endereco,
                            cidade       = :cidade,
                            estado       = :estado,
                            cep          = :cep"
            );


            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":sobrenome", $sobrenome);
            $sql->bindValue(":cpf", $cpf);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":dataNascimento", $dataNascimento);
            $sql->bindValue(":genero", $genero);

            $sql->bindValue(":idTipoSanguineo", $idTiposanguineo);
            $sql->bindValue(":endereco", $endereco);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":estado", $estado);
            $sql->bindValue(":cep", $cep);
            $sql->execute();
            $filename = 'pacientes.csv';
            $this->CriarCsv('paciente', 'pacientes.csv');
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function addPaciente(
        $nome,
        $sobrenome,
        $cpf,
        $email,
        $dataNascimento,
        $genero,
        $idTiposanguineo,
        $endereco,
        $cidade,
        $estado,
        $cep
    ) {


        try {
            global $pdo;
            global $conn;

            $sql = $pdo->prepare(
                "INSERT INTO paciente  set
                            nome         = :nome , 
                            sobrenome   = :sobrenome ,
                            cpf         = :cpf ,
                            email       = :email ,        
                            dataNascimento        = :dataNascimento , 
                            genero       = :genero,
                            idTipoSanguineo       = :idTipoSanguineo,
                            endereco     = :endereco,
                            cidade       = :cidade,
                            estado       = :estado,
                            cep          = :cep"
            );

            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":sobrenome", $sobrenome);
            $sql->bindValue(":cpf", $cpf);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":dataNascimento", $dataNascimento);
            $sql->bindValue(":genero", $genero);

            $sql->bindValue(":idTipoSanguineo", $idTiposanguineo);
            $sql->bindValue(":endereco", $endereco);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":estado", $estado);
            $sql->bindValue(":cep", $cep);
            $sql->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function CriarCsv($tabela, $file)
    {
        global $pdo;
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=file.csv');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: no-cache');


        $stmt = $pdo->prepare("SELECT * FROM {$tabela}");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        unlink($file);
        $out = fopen($file, 'w');

        foreach ($results as $result) {
            fputcsv($out, $result);
        }
        fclose($out);
    }

    public function LerCsv()
    {
        $arquivo = 'pacientes2.csv';
        $objeto  = fopen($arquivo, 'r');
        $content = fgetcsv($objeto);
        $count   = count($content);

        while (list(
            $nome, $sobrenome, $cpf, $email, $dataNascimento, $genero, $idTiposanguineo, $endereco, $cidade, $estado, $cep, $cpf
        ) = fgetcsv($objeto, 1024, ',')) {

            $this->addPacienteECSV(
                $nome,
                $sobrenome,
                $cpf,
                $email,
                $dataNascimento,
                $genero,
                $idTiposanguineo,
                $endereco,
                $cidade,
                $estado,
                $cep
            );

            $lastId =   $this->LastIdPaciente();


            header('location:index.php');
        }
    }

    public function AddTipoSanguineo($descricao)
    {
        try {
            global $pdo;
            $sql = $pdo->prepare(
                "INSERT INTO tiposanguineo  set                      
                            descricao  = :descricao "
            );

            $sql->bindValue(":descricao", $descricao);
            $sql->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function excluiPaciente($id)
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM paciente  WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function excluiPacienteSemWhere()
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM paciente ");
        $sql->execute();
    }

 
}

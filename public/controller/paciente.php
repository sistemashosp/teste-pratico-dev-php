<?php
namespace TesteCSV;

class PacienteDB {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;


    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function deleteAll() {

        $test = $this->pdo->prepare('SELECT * FROM paciente');
        $test->execute();
        if($test->rowCount() > 0){
            $stmt = $this->pdo->prepare('DELETE FROM paciente');
            $stmt->execute();
        }else{
            return false;
        }
        return $stmt->rowCount();
    }

    public function lista_paciente(){

        $stmt = $this->pdo->prepare('SELECT * FROM paciente INNER JOIN tipo_sanguineo on paciente.id_tipo_sanguineo = tipo_sanguineo.id');
        $stmt->execute();
        return $stmt;
    }

    public function Insert_Paciente($nome,$sobrenome,$cpf,$email,$data_nascimento,$genero,$id_tipo_sanguineo,$endereco,$cidade,$estado,$cep) {

        $stmt = $this->pdo->prepare(utf8_encode("INSERT INTO paciente (nome, sobrenome, cpf, email, data_nascimento, 
        genero, id_tipo_sanguineo, endereco, cidade, estado, cep) values ('$nome','$sobrenome','$cpf','$email','$data_nascimento','$genero',$id_tipo_sanguineo,'$endereco','$cidade','$estado','$cep')"));
        $stmt->execute();
        return $this->pdo->lastInsertId();

    }


}
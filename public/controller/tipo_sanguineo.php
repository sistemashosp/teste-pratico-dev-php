<?php
namespace TesteCSV;

class tipo_sanguineoDB {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function deleteAll() {

        $test = $this->pdo->prepare('SELECT * FROM tipo_sanguineo');
        $test->execute();

        if($test->rowCount() > 0){
            $stmt = $this->pdo->prepare('DELETE FROM tipo_sanguineo');
            $stmt->execute();
        }else{
            return false;
        }

        return $stmt->rowCount();
    }

    public function Select($param) {

    $stmt = $this->pdo->prepare("SELECT * FROM tipo_sanguineo WHERE descricao = '$param'");
        if(!empty($stmt)){
            $stmt->execute();
            return $stmt;
        }else{
            return false;
        }
    }


    public function Insert_Tipo($descricao) {
        
        $stmt = $this->pdo->prepare("INSERT INTO tipo_sanguineo (descricao) values ('$descricao')");
        $stmt->execute();
        return $this->pdo->lastInsertId();

    }

}
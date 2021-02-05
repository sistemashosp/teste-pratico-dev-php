<?php
require_once 'models/Sangue.php';

class SangueDaoMysql implements SangueDAO{

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }    

    public function findById($id){

        $sql = $this->pdo->prepare("SELECT * FROM tipo_sanguineo WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){

            $data = $sql->fetch();

            $f = new Sangue();
            $f->setId($data['id']);
            $f->setDescricao($data['descricao']);            

            return $f;

        } else {
            
            return false;
        }

    }   
    
}

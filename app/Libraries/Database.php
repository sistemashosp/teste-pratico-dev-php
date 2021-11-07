<?php
class Database {
    private $host = 'localhost';
    private $user = 'postgres';
    private $password = 'bi9jn5uy';
    private $database = 'tecnico';
    private $port = '5432';
    private $dbh;
    private $stat;

    public function __construct(){
        $db = 'pgsql:host='.$this->host.';port='.$this->port.';dbname='.$this->database;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($db, $this->user, $this->password, $option);
        } catch (PDOException $e) {
            print "Erro ao conectar no banco de dados".$e->getMessage();
            die();
        }
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null){
        if(is_null($type)){

            switch (true){

                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function result(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function allResults(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        $this->execute();
        return $this->stmt->lastInsertId();
    }
}
?>
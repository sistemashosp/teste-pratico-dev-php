<?php
class Database {
    private $host = ''; //Insira o host 
    private $user = ''; //Insira o usuário do banco
    private $password = ''; //Insira a senha do banco;
    private $database = ''; //Insira o nome do banco
    private $port = ''; // Insira a porta do banco
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

    //Executar a query
    public function execute(){
        return $this->stmt->execute();
    }

    //Criar objeto de resultado
    public function result(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Criar objeto de todos os resultados
    public function allResults(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    
   //Número de tuplas no resultado 
    public function rowCount(){
        $this->execute();
        return $this->stmt->rowCount();
    }

}
?>
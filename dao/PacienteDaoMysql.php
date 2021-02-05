<?php
require_once 'models/Paciente.php';

class PacienteDaoMysql implements PacienteDAO{

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }


    public function add(Paciente $c){

        $sql = $this->pdo->prepare("INSERT INTO paciente (id_tipo_sanguineo, nome, sobrenome, cpf, email, data_nascimento, genero, endereco, cidade, estado, cep) VALUES (:id_tipo_sanguineo, :nome, :sobrenome, :cpf, :email, :datanascimento, :genero, :endereco, :cidade, :estado, :cep)");
        $sql->bindValue(":id_tipo_sanguineo", $c->getIdTipoSanguineo());
        $sql->bindValue(":nome", $c->getNome());
        $sql->bindValue(":sobrenome", $c->getSobrenome());
        $sql->bindValue(":cpf", $c->getCpf());
        $sql->bindValue(":email", $c->getEmail());
        $sql->bindValue(":datanascimento", $c->getDataNascimento());
        $sql->bindValue(":genero", $c->getGenero());
        $sql->bindValue(":endereco", $c->getEndereco());
        $sql->bindValue(":cidade", $c->getCidade());
        $sql->bindValue(":estado", $c->getEstado());
        $sql->bindValue(":cep", $c->getCep());
        $sql->execute();

        $c->setId( $this->pdo->lastInsertId() );
        return $c;

    }

    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM paciente");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();            

            foreach($data as $item){
                
                $cad = new Paciente();
                $cad->setId($item['id']);
                $cad->setIdTipoSanguineo($item['id_tipo_sanguineo']);
                $cad->setNome($item['nome']);
                $cad->setSobrenome($item['sobrenome']);
                $cad->setCpf($item['cpf']);
                $cad->setEmail($item['email']);
                $cad->setDataNascimento($item['data_nascimento']);
                $cad->setGenero($item['genero']);
                $cad->setEndereco($item['endereco']);
                $cad->setCidade($item['cidade']);
                $cad->setEstado($item['estado']);
                $cad->setCep($item['cep']);

                $array[] = $cad;
            }

        }

        return $array;

    }

    public function delete(){

        $sql = $this->pdo->prepare("DELETE FROM paciente");        
        $sql->execute();


        
    }
    
}

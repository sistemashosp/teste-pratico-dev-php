<?php 

namespace App\Models;

use MF\Model\Model;

class Paciente extends Model{
    private $nome;
    private $sobrenome;
    private $CPF;
    private $email;
    private $data_nascimento;
    private $genero;
    private $tipo_sanguineo;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;

    public function __get($att){
        return $this->$att;
    }

    public function __set($att, $val){
        $this->$att = $val;
    }


    public function truncate(){
        $query = 'TRUNCATE TABLE PACIENTE';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    public function inserirPaciente(){
        $query = 'INSERT INTO PACIENTE(nome, sobrenome, CPF, email, data_nascimento, genero, tipo_sanguineo, endereco, cidade, estado, cep)VALUES(
            :nome, :sobrenome, :CPF, :email, :data_nascimento, :genero, :tipo_sanguineo, :endereco, :cidade, :estado, :cep)';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':sobrenome', $this->__get('sobrenome'));
        $stmt->bindValue(':CPF', $this->__get('CPF'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':data_nascimento', $this->__get('data_nascimento'));
        $stmt->bindValue(':genero', $this->__get('genero'));
        $stmt->bindValue(':tipo_sanguineo', $this->__get('tipo_sanguineo'));
        $stmt->bindValue(':endereco', $this->__get('endereco'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':estado', $this->__get('estado'));
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->execute();
        return $this;
    }

    public function getAll(){
        $query = 'SELECT * FROM PACIENTE';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC); 
    }



}

?>
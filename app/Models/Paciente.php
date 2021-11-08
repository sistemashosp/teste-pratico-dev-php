<?php
    class Paciente {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function insert($params) {
            $this->db->query("INSERT INTO paciente(id, nome, sobrenome, cpf, email, data_nascimento, genero, id_tipo_sanguineo, endereco, cidade, estado, cep) VALUES (nextval('paciente_id_seq'), :nome, :sobrenome, :cpf, :email, :data_nascimento, :genero, :id_tipo_sanguineo, :endereco, :cidade, :estado, :cep)");

            $bloodId = $this->getBloodTypeId($params['tiposanguineo']);

            $this->db->bind('nome', $params['nome']);
            $this->db->bind('sobrenome', $params['sobrenome']);
            $this->db->bind('cpf', $params['cpf']);
            $this->db->bind('email', $params['email']);
            $this->db->bind('data_nascimento', $params['datanascimento'], PDO::PARAM_STR);
            $this->db->bind('genero', $params['genero']);
            $this->db->bind('id_tipo_sanguineo', $bloodId );
            $this->db->bind('endereco', $params['endereco']);
            $this->db->bind('cidade', $params['cidade']);
            $this->db->bind('estado', $params['estado']);
            $this->db->bind('cep', $params['cep']);

            $insert = $this->db->execute();

        }

        public function getBloodTypeId($type){
            $bloodType = new Database();

            $bloodType->query("SELECT id FROM tipo_sanguineo where descricao = :descricao");
            $bloodType->bind('descricao', $type);
            
            $blood = $bloodType->result();

            return $blood->id;
        }

        public function deleteRows(){
            $delete = new Database();
            $delete->query("DELETE FROM paciente");
            $delete->execute();
        }

        public function listPatients(){
            $this->db->query("select paciente.*, tipo_sanguineo.descricao AS tipo_sanguineo from paciente, tipo_sanguineo where paciente.id_tipo_sanguineo = tipo_sanguineo.id");
            return $this->db->allResults();
        }
    }
?>
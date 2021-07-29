<?php

require '/models/tipoSanguineo.php';

    class Pacientes extends TipoSanguineo {

        private string $id;
        private string $nome;
        private string $sobrenome;
        protected int $cpf;
        private string $email;
        private string $data_nascimento;
        private string $genero;
        protected string $endereco;
        public string $cidade;
        public string $estado;
        private int $cep;

        public function getId (){
            return $this->id;
        }

        public function setId (){
            return $this->id;
        }

        public function getNome (){
            return $this->nome;
        }

        public function setNome (){
            return $this->nome;
        }
    
        public function getSobreNome (){
            return $this->sobrenome;
        }

        public function setSobreNome (){
            return $this->sobrenome;
        }

        function getCpf (){
            return $this->cpf;
        }

        function setCpf (){
            return $this->cpf;
        }
        
        function getEmail (){
            return $this->email;
        }

        function setEmail (){
            return $this->email;
        }

        function getDataNascimento (){
            return $this->data_nascimento;
        }

        function setDataNascimento (){
            return $this->data_nascimento;
        }

        function getGenero (){
            return $this->genero;
        }

        function setGenero (){
            return $this->genero;
        }

        function getEndereco (){
            return $this->endereco;
        }

        function setEndereco (){
            return $this->endereco;
        }

        function getCidade (){
            return $this->cidade;
        }

        function setCidade (){
            return $this->cidade;
        }
    
        function getEstado (){
            return $this -> estado;
        }

        function setEstado (){
            return $this -> estado;
        }

        function getCep (){
            return $this -> cep;
        }

        function setCep (){
            return $this -> cep;
        }

        function Pacientes (){
            $this -> preparaPaciente ();
        }
    
        private function preparaPaciente (){
            $this -> id = "";
            $this -> nome = "";
            $this -> sobrenome = "";
            $this -> cpf = "";
            $this -> email= "";
            $this -> data_nascimento= "";
            $this -> genero= "";
            $this -> endereco= "";
            $this -> cidade= "";
            $this -> estado= "";
            $this -> cep= "";
        }

    }

?>
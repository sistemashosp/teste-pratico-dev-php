<?php

class Paciente{
    private $id;
    private $id_tipo_sanguineo;
    private $nome;
    private $sobrenome;
    private $cpf;
    private $email;
    private $datanascimento;
    private $genero;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;

    public function getId(){
        return $this->id;
    }

    public function setId($i){
        $this->id = trim($i);
    }

    public function getIdTipoSanguineo(){
        return $this->id_Tipo_Sanguineo;
    }

    public function setIdTipoSanguineo($b){
        $this->id_Tipo_Sanguineo = trim($b);
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($n){
        $this->nome = ucwords(trim($n));
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($s){
        $this->sobrenome = ucwords(trim($s));
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($c){
        $this->cpf = trim($c);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($e){
        $this->email = $e;
    }

    public function getDataNascimento(){
        return $this->datanascimento;
    }

    public function setDataNascimento($d){
        $this->datanascimento = $d;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function setGenero($g){
        $this->genero = $g;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($a){
        $this->endereco = $a;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($ci){
        $this->cidade = $ci;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($es){
        $this->estado = $es;
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep($ce){
        $this->cep = $ce;
    }

}

interface PacienteDAO{
    public function add(Paciente $cad);
    public function findAll();    
    public function delete();
}

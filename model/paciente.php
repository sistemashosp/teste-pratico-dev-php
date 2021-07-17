<?php

  class Paciente {

    protected $nome;
    protected $sobrenome;
    protected $cpf;
    protected $email;
    protected $datanascimento;
    protected $genero;
    protected $idTipoSanguineo;
    protected $endereco;
    protected $cidade;
    protected $estado;
    protected $cep;

    public function __construct($nome, $sobrenome, $cpf, $datanascimento, $genero, $idTipoSanguineo, $endereco, $cidade, $estado, $cep) {
      $this->nome = $nome;
      $this->sobrenome = $sobrenome;
      $this->cpf = $cpf;
      $this->datanascimento = $datanascimento;
      $this->genero = $genero;
      $this->idTipoSanguineo = $idTipoSanguineo;
      $this->endereco = $endereco;
      $this->cidade = $cidade;
      $this->estado = $estado;
      $this->cep = $cep;
    }


    public function getNome() {
      return $this->nome;
    }
  
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSobrenome() {
      return $this->sobrenome;
    }
  
    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getCpf() {
      return $this->cpf;
    }
  
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getEmail() {
      return $this->email;
    }
  
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDatanascimento() {
      return $this->datanascimento;
    }
  
    public function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }

    public function getGenero() {
      return $this->genero;
    }
  
    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function getIdTipoSanguineo() {
      return $this->idTipoSanguineo;
    }
  
    public function setIdTipoSanguineo($idTipoSanguineo) {
        $this->idTipoSanguineo = $idTipoSanguineo;
    }

    public function getEndereco() {
      return $this->endereco;
    }
  
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getCidade() {
      return $this->cidade;
    }
  
    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    public function getEstado() {
      return $this->estado;
    }
  
    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCep() {
      return $this->cep;
    }
  
    public function setCep($cep) {
        $this->cep = $cep;
    }

  }

?>
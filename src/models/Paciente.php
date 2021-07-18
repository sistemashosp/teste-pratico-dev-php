<?php

class Paciente
{
    private $id;
    private $tipoSanguineo;
    private $nome;
    private $sobrenome;
    private $cpf;
    private $email;
    private $dataNasc;
    private $genero;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;

    public function __construct($tipoSanguineo, $nome, $sobrenome, $cpf, $email, $dataNasc, $genero, $endereco, $cidade, $estado, $cep)
    {
        $this->tipoSanguineo = $tipoSanguineo;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->dataNasc = $dataNasc;
        $this->genero = $genero;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTipoSanguineo()
    {
        return $this->tipoSanguineo;
    }

    public function setTipoSanguineo($tipoSanguineo)
    {
        $this->tipoSanguineo = $tipoSanguineo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }
}

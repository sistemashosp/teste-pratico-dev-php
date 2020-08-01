<?php

require_once "PacienteDAO.php";
require_once "TipoSanguineo.php";

class Paciente extends PacienteDAO
{
    protected $id;
    protected $nome;
    protected $sobrenome;
    protected $cpf;
    protected $email;
    protected $nascimento;
    protected $genero;
    protected $tipoSanguineo;
    protected $endereco;
    protected $cidade;
    protected $estado;
    protected $cep;

    public function __construct()
    {
        $this->tipoSanguineo = new TipoSanguineo();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getTipoSanguineo()
    {
        return $this->tipoSanguineo;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function setCpf($cpf)
    {
        if (Util::validarCPF($cpf))
        {
            $this->cpf = $cpf;
        } else {
            $this->cpf = "";
        }
    }

    public function setEmail($email)
    {
        if (Util::validarEmail($email))
        {
            $this->email = $email;
        } else {
            $this->email = "";
        }
    }

    public function setNascimento($nascimento)
    {
        if (Util::validarDataNascimento($nascimento))
        {
            $this->nascimento = date("Y-m-d", strtotime($nascimento));
        } else {
            $this->nascimento = "";
        }
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function setTipoSanguineo($tipoSanguineo)
    {
        $this->tipoSanguineo = $tipoSanguineo;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setEstado($estado)
    {
        if (strlen($estado) == 2)
        {
            $this->estado = $estado;
        } else {
            $this->estado = "";
        }
    }

    public function setCep($cep)
    {
        if (strlen($cep) == 9)
        {
            $this->cep = $cep;
        } else {
            $this->cep = "";
        }
    }
}
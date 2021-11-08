<?php

namespace Source\Models;

use Illuminate\Database\Eloquent\Model;
use \Source\Models\TipoSanguineo;
use \Source\Services\ValidaCpf;
use \Source\Services\ValidaData;
use \Source\Services\ValidaEmail;
use Source\Services\ValidaEstado;
use function Composer\Autoload\includeFile;

class Paciente extends Model
{
    protected $table = 'paciente';

    public $timestamps = false;

    protected $fillable = [
        'id_tipo_sanguineo',
        'nome',
        'sobrenome',
        'cpf',
        'email',
        'data_nascimento',
        'genero',
        'endereco',
        'cidade',
        'estado',
        'cep'
    ];

    public function tipoSanguineoID()
    {
        return $this->hasOne(TipoSanguineo::class,'id','id_tipo_sanguineo');
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getTipoSanguineo()
    {
        return $this->id_tipo_sanguineo;
    }

    public function setTipoSanguineo($id_tipo_sanguineo)
    {
        $this->attributes['id_tipo_sanguineo'] = $id_tipo_sanguineo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->attributes['nome'] = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->attributes['sobrenome'] = $sobrenome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $val = new ValidaCpf();
        $this->attributes['cpf'] = $val->validate($cpf);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $var = new ValidaEmail();
        $this->attributes['email'] = $var->validate($email);
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento)
    {
        $var = new ValidaData();

        $this->attributes['data_nascimento'] =  $var->validate($data_nascimento); ;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->attributes['genero'] = $genero;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->attributes['endereco'] = $endereco;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->attributes['cidade'] = $cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $var = new ValidaEstado();

        $this->attributes['estado'] = $var->validate($estado);
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->attributes['cep'] = $cep;
    }
}

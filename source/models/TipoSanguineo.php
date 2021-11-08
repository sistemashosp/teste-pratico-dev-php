<?php
namespace Source\Models;


use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{
    protected $table = 'tipo_sanguineo';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'descricao'
    ];



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setgetDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
}
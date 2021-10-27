<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\tipoSanguineo;

class Paciente extends Model
{
    protected $table = "paciente";
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'sobrenome',
        'id_tipo_sanguineo',
        'cpf',
        'email',
        'genero',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'data_nascimento',
        'frkPlanoSaude'
    ];
    protected $hidden = [];

    public function tipoSanguineo()
    {
        return $this->hasOne('App\tipoSanguineo', 'id', 'id_tipo_sanguineo');
    }
}

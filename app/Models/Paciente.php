<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';

    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'datanascimento',
        'genero',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'cpf',
        'frkPlanoSaude'
    ];
    public $timestamps = false;

    public function tipoSanguineo()
    {
        return $this->belongsTo(Paciente::class);
    }

}

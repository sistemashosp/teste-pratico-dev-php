<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{

    protected $table = 'tipo_sanguineo';

    protected $fillable = [
        'descricao'
    ];
    public $timestamps = false;

    public $incrementing = false;

    public function paciente()
    {
        return $this->hasMany(Paciente::class);
    }


}

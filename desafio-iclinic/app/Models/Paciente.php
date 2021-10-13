<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [ 'nome', 'sobrenome', 'cpf', 'email', 'dataNascimento',  'genero', 'idTipoSanquineo', 'endereco', 'cidade', 'estado', 'cep', 'cpf' ];
}

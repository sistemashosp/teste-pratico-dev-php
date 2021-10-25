<?php

namespace App\Imports;

use App\Helpers\Funcoes;
use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\ToModel;

class PacienteImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $flight = new Paciente;

        $flight->nome = $row[0];
        $flight->sobrenome = $row[1];
        $flight->email = Funcoes::validaEmail($row[2]);
        $flight->datanascimento = $row[3];
        $flight->genero = $row[4];
        $flight->tiposanguineo = $row[5];
        $flight->endereco = $row[6];
        $flight->cidade = $row[7];
        $flight->estado = $row[8];
        $flight->cep = $row[9];
        $flight->cpf = Funcoes::validaCPF($row[10]);
        $flight->tipo_sanguineo_id = $row[11];

        $flight->save();

    }
}

<?php

namespace Source\Controller;

require __DIR__.'/../../vendor/autoload.php';

use League\Csv\Reader;
use League\Csv\Statement;
use Source\Models\Paciente;
use Source\Services\TipoSanguineoService;
use Source\Models\TipoSanguineo;
class PacienteController
{
    public function importDataCsv($fileName)
    {
        if ($fileName){

            $checkTs = TipoSanguineo::first();
            if (empty($checkTs)){
                $tipoSanguineo = new TipoSanguineoService();
                $tipoSanguineo->insertData();
            }

            $checkP = Paciente::first();
            if (!empty($checkP)){
                Paciente::truncate();
            }


            $stream = fopen($fileName, "r");
            $csv = Reader::createFromStream($stream);
            $csv->setDelimiter(",");
            $csv->setHeaderOffset(0);

            $stmt = (new Statement());
            $pacientes = $stmt->process($csv);

            foreach($pacientes as $paciente){
                $newPaciente = new Paciente();
                $tp = TipoSanguineo::where('descricao', $paciente['tiposanguineo'])->first();

                $newPaciente->setTipoSanguineo($tp->id);
                $newPaciente->setNome($paciente['nome']);
                $newPaciente->setSobrenome($paciente['sobrenome']);
                $newPaciente->setGenero($paciente['genero']);
                $newPaciente->setEndereco($paciente['endereco']);
                $newPaciente->setCidade($paciente['cidade']);
                $newPaciente->setEstado($paciente['estado']);
                $newPaciente->setCep($paciente['cep']);

                $newPaciente->setEmail($paciente['email']);
                $newPaciente->setDataNascimento($paciente['datanascimento']);
                $newPaciente->setCpf($paciente['cpf']);
                $newPaciente->save();
            }
            return true;
        }
    }

    public function listarPacientes()
    {
        $lista = Paciente::all();
        return $lista;
    }
}
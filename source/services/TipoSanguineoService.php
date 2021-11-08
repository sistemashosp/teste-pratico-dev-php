<?php

namespace Source\Services;

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../db_config.php';
use Source\Models\TipoSanguineo;

class TipoSanguineoService
{
    public function deleteData()
    {
        return TipoSanguineo::truncate();

    }

    public function insertData()
    {
        $tipos = [
            1 => 'A+',
            2 => 'A-',
            3 => 'B+',
            4 => 'B-',
            5 => 'AB+',
            6 => 'AB-',
            7 => 'O+',
            8 => 'O-',
        ];

        foreach ($tipos as $id => $tipo){

            $tp = new TipoSanguineo();
            $tp->id = $id;
            $tp->descricao = $tipo;
            $tp->save();

        }


    }


}
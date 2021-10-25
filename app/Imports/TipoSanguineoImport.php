<?php

namespace App\Imports;

use App\Models\TipoSanguineo;
use Maatwebsite\Excel\Concerns\ToModel;

class TipoSanguineoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $flight = new TipoSanguineo;

        $flight->id =  $row[11];
        $flight->descricao =  'importado via CSV';

        $flight->save();

    }
}

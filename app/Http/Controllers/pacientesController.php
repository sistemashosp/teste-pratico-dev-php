<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Imports\PacienteImport;
use App\Imports\TipoSanguineoImport;
use App\Models\TipoSanguineo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Paciente;
use Yajra\Datatables\Datatables;

class pacientesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dadosIndex()
    {
        ini_set('memory_limit', '-1');

        $pacientes = Paciente::with('tipoSanguineo')->get();

        return Datatables::of($pacientes)
            ->addColumn('cpf', function ($paciente) {
                if ($paciente->cpf == 0) {
                    return 'CPF incorreto ou inexistente';
                } else {
                    return $paciente->cpf;
                }
            })
            ->make(true);
    }

    public function store(Request $request)
    {

        $this->destroyPaciente();
        $this->destroyTipoSanguineo();

        \Excel::import(new PacienteImport, $request->file);
        \Excel::import(new TipoSanguineoImport(), $request->file);


        return back();
    }

    public static function destroyPaciente()
    {
        return Paciente::query()->delete();
    }

    public static function destroyTipoSanguineo()
    {
        return TipoSanguineo::query()->delete();
    }

}

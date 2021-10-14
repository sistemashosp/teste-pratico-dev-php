<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PacientesImport;
use App\Imports\TransactionImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Http\Requests\ImportRequest;

class CadastraController extends Controller
{
    public function index()
    {

        return view('home');  // Index para a view home 
    }

    public function store(Request $request)  // Function se encarrega de importar e cadastrar dados no banco 
    {

        Paciente::truncate(); // limpa registros anteriores no banco 

        try {
            Excel::import(new PacientesImport(), $request->file('import_file')); // instancia nova importação definida no arquivo de imports 'PacientesImport'
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return view('home', compact('failures')); //retorna falhas de validação para view 
        }


        return redirect()->back()->with('success', 'csv cadastrado com sucesso !');
    }


    public function lista() // função para listar dados do banco na home 
    {
        $pacientes = Paciente::all(); 
        return view("home", compact('pacientes'));
    }
}

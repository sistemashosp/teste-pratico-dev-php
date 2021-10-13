<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PacientesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Http\Requests\ImportRequest;

class CadastraController extends Controller
{
    public function index(){

        return view('home');
    }

    public function store(Request $request){

        Paciente::truncate();

        $file = $request->file('import_file');
        //Excel::import(new PacientesImport(), $request->file('import_file'));
        $import = new PacientesImport();
        $import->import($file); 
        if($import->failures()->isNotEmpty()){
            return 'sucesso ao importar, duplicidades e erros de validações skipados ';
        }  
        
        

        return redirect()->back()->with('success', 'csv cadastrado com sucesso !');
    }

}

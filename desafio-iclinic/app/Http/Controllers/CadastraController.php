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
    public function index(){

        return view('home');
    }

    public function store(Request $request){

        Paciente::truncate();

        /* try {
        Excel::import(new PacientesImport(), $request->file('import_file'));
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        return view('home', compact('failures'));
        } */
        $filesize = filesize($request->file('import_file'));
        $file = $request->file('import_file')->store('import');

        if($filesize >= 500000){
        $import = new PacientesImport();
        }else{
        $import = new TransactionImport(); 
        }
        $import->import($file);
        
         /* if($import->failures()->isNotEmpty()){
            
            return redirect()->back()->with('success', 'csv cadastrado com sucesso campos com erros foram pulados !');
            
        }     
         */
        

        return redirect()->back()->with('success', 'csv cadastrado com sucesso !');
    }


    public function lista(){
        $pacientes = Paciente::all();
        return view("home", compact('pacientes'));
    }

}

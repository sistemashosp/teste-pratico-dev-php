<?php

namespace App\Imports;

use App\Models\Paciente;
use App\Models\TipoSanguineo;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
//use Maatwebsite\Excel\Concerns\SkipsOnError;
//use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Rules\ValidateCpfRule;

class PacientesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts,  WithChunkReading, ShouldQueue/* , SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts,  WithChunkReading, ShouldQueue */
{
    use Importable, SkipsFailures; 
    private $tipo; 

    public function __construct(){

        $this->tipo = TipoSanguineo::select('id', 'descricao')->get(); 
    }
    

    /*  public function rules(): array
    {
        return [
            '*.nome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            '*.sobrenome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            '*.email' => ['email','unique:pacientes,email'],
            '*.cpf'   => ['required','numeric',new ValidateCpfRule],
            //'*.datanascimento' => ['required', 'date_format:Y-m-d'],
            '*.endereco' => ['required','regex:/(^[A-Za-z0-9 ]+$)+/'],
            '*.cidade' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],

             
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'Correo ya esta en uso.',
        ];
    }    */
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        $datanascimento = date('Y-m-d',preg_replace('/\D/','',strtotime($row['datanascimento']))); 
        //dd($datanascimento);
        $tipoSanguineo = $this->tipo->where('descricao', $row['tiposanguineo'])->first();
       
        return new Paciente([
            'nome' => $row['nome'],
            'sobrenome' => $row['sobrenome'],
            'email' => $row['email'],
            'dataNascimento' => $datanascimento,
            'genero' => $row['genero'],
            'idTipoSanquineo' => $tipoSanguineo->id ?? NULL,
            'endereco' => $row['endereco'],
            'cidade' => $row['cidade'],
            'estado' => $row['estado'],
            'cep' => $row['cep'],
            'cpf' => $row['cpf']
        ]);
    }



     public function rules(): array
    {
        return [
           // '*.nome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            //'*.sobrenome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            '*.email' => ['email','unique:pacientes,email'],
            '*.cpf'   => ['required','numeric', new ValidateCpfRule],
            '*.datanascimento' => ['required', 'date_format:Y-m-d'],
           // '*.endereco' => ['required','regex:/(^[A-Za-z0-9 ]+$)+/'],
           // '*.cidade' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],

             
        ];
    }


     public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }  

    

    
}

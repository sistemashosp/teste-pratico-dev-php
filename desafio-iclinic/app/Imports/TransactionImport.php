<?php

namespace App\Imports;

//use App\Models\Transaction;
use App\Models\Paciente;
use App\Models\TipoSanguineo;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use App\Rules\ValidateCpfRule;

class TransactionImport implements   
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading
{


    use Importable, SkipsErrors, SkipsFailures; // traits 
    private $tipo;

    public function __construct()
    {

        $this->tipo = TipoSanguineo::select('id', 'descricao')->get(); // collection para tipo sanguineo, evitando múltiplas queries para cada linha processada
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)  
    {

        $datanascimento = date('Y-m-d', preg_replace('/\D/', '', strtotime($row['datanascimento'])));
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


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'enclosure' => '',
            'input_encoding' => 'UTF-8'
        ];
    }

    public function rules(): array // validation rules 
    {
        return [
            //'*.nome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            //'*.sobrenome' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            //'*.email' => ['email', 'unique:pacientes,email'],
            '*.cpf'   => ['required', 'numeric', new ValidateCpfRule],
            //'*.datanascimento' => ['required', 'numeric']


        ];
    }


    public function batchSize(): int  // Limita a quantidade de queries por lote de processamento
    {
        return 1000;
    }

    public function chunkSize(): int // Faz a leitura da planilha/csv em partes e mantém um uso de memória controlável 
    {
        return 5000;
    }


    public static function afterImport(AfterImport $event)  // trata possíveis falhar registradas em failed_jobs
    {
        //dd($event);
    }
}

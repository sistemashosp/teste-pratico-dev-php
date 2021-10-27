<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\TipoSanguineo;
use Carbon\Carbon;
use Dotenv\Validator;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Input;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Reader;

class PacientesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $cont = 0;
    private $arrayPaciente = array();

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pacientes = Paciente::paginate(10);
        return view('pacientes.listar', ['dados' => $pacientes]);
    }

    public function importar()
    {
        return view('pacientes.cadastro');
    }

    public function cadastro(Request $request)
    {

        // $validatedData = $request->validate([
        //     'arquivo' => ['required', 'mimes:csv', 'size:20000'],
        // ]);

        TipoSanguineo::truncate();
        Paciente::truncate();

        $file = public_path('file/pacientes.csv');



        $isImport = $this->csvToArray($file);

        if (!$isImport) {
            TipoSanguineo::truncate();
            Paciente::truncate();

            return redirect('/')->with('error', 'Erro ao importar CSV!');
        }

        return redirect('/')->with('status', 'CSV importado com sucesso!');


        $this->importaCsv($file);
    }

    function csvToArray($filename = '', $delimiter = ',')
    {

        try {
            if (!file_exists($filename) || !is_readable($filename))
                return false;

            $header = null;

            if (($handle = fopen($filename, 'r')) !== false) {

                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                    if (!$header) {
                        $row[5] = 'id_tipo_sanguineo';
                        $row[3] = 'data_nascimento';
                        $header = $row;
                    } else {
                        $this->cont++;

                        $tiposanguineo = TipoSanguineo::firstOrCreate(['descricao' => $row[5]]);
                        if (!$tiposanguineo->id) {
                            $idtipoSanguineo = TipoSanguineo::where('descricao', '=', $row[5])->first();
                            $row[5] = $idtipoSanguineo->id;
                        } else {
                            $row[5] = $tiposanguineo->id;
                        }
                        //valida os dados 
                        $row = $this->validaDados($row);

                        //Insere os dados na tabela retorna true se deu certo
                        if (!$this->inseriDadosPaciente($row)) {
                            return false;
                        }
                    }
                }
                fclose($handle);
            }

            if ($this->cont > 0 && $this->cont < 5000) {
                Paciente::insert($this->arrayPaciente);
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function inseriDadosPaciente($data)
    {
        try {
            array_push($this->arrayPaciente, [
                // 'nome' => $data[0],
                // 'sobrenome' => $data[1],
                // 'email' => $data[2],
                // 'data_nascimento' => $data[3],
                // 'genero' => $data[4],
                // 'id_tipo_sanguineo' => $data[5],
                // 'endereco' => $data[6],
                // 'cidade' => $data[7],
                // 'estado' => $data[8],
                // 'cep' => $data[9],
                // 'cpf' => $data[10],
                // 'frkPlanoSaude' => $data[11]

                'nome' => utf8_decode($data[0]),
                'sobrenome' => utf8_decode($data[1]),
                'email' => utf8_decode($data[2]),
                'data_nascimento' => utf8_decode($data[3]),
                'genero' => utf8_decode($data[4]),
                'id_tipo_sanguineo' => utf8_decode($data[5]),
                'endereco' => utf8_decode($data[6]),
                'cidade' => utf8_decode($data[7]),
                'estado' => utf8_decode($data[8]),
                'cep' => utf8_decode($data[9]),
                'cpf' => utf8_decode($data[10]),
                'frkPlanoSaude' => utf8_decode($data[11])
            ]);

            if ($this->cont == 5000) {
                Paciente::insert($this->arrayPaciente);
                $this->cont = 0;
                $this->arrayPaciente = [];
            }
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }


    public function validaDados($dados)
    {

        $data  = explode('/', $dados[3]);
        if ($dados[2] == "" || !filter_var($dados[2], FILTER_VALIDATE_EMAIL))
            $dados[2] = "";

        if (!checkdate($data[0], $data[1], $data[2])) {
            $dados[3] = "";
        } else {
            $dados[3] =  Carbon::createFromFormat('m/d/Y',  $dados[3])->format('Y-m-d');
        }

        if (!$this->validaCpf($dados[10])) {
            $dados[10] = "";
        }

        return $dados;
    }

    public function validaCpf($cpf)
    {
        $c = preg_replace('/\D/', '', $cpf);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    public function importaCsv($dados)
    {





        // TipoSanguineo::truncate();
        // Paciente::truncate();

        // $isImport = $this->csvToArray($dados);

        // if (!$isImport) {
        //     TipoSanguineo::truncate();
        //     Paciente::truncate();
        // }

        // return redirect('pacientes');

    }
}

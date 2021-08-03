<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\TipoSanguineo;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index() {
        
        //Página inicial onde usuário irá escolher se quer cadastrar ou listar
        
        return view('home');
    }

    public function cadastro(Request $request) {
        
        //Página onde usuário irá fazer o envio do CSV para cadastro de pacientes
        
        return view('cadastro', [
            'error' => $request->session()->get('error')
        ]);
    }

    public function cadastroAction(Request $request) {

        //Ação após formulário for submetido

        //recebendo o arquivo CSV enviado
        $dados = $_FILES['insertPacientes'];

        //print_r($dados);exit;
        
        //Forçando o sistema a aceitar somente arquivos .CSV
        if($dados['type'] !== 'application/vnd.ms-excel') {
            
            $request->session()->flash('error', 'Importe um arquivo CSV.');
            return redirect('/cadastro');
        }        
        
        //Se a validação passou vamos apagar os itens das 2 tabelas e inserir novamente
        Paciente::select()->delete();
        TipoSanguineo::select()->delete();           

        $row = 1;
        if (($handle = fopen($dados['tmp_name'], "r")) !== FALSE) {
            while ((($data = fgetcsv($handle, 1000, ",")) !== FALSE) and ($row<=1000)) {                
                
                if($row !== 1) {
                    
                    //pegando primeiro o tipo sanguineo
                    $tipoSanguineo = utf8_encode($data[5]);

                    //verificando se este tipo sanguíneo já tem no banco, se não tiver cadastra
                    $cont = TipoSanguineo::where('descricao', $tipoSanguineo)->count();

                    if($cont === 0) {
                        $ts = new TipoSanguineo();
                        $ts->descricao = $tipoSanguineo;
                        $ts->save();
                    }
                    
                    //validando data de nascimento (mm/dd/aaaa)
                    $dn = explode('/', $data[3]);                    
                    $dn = $dn[2].'-'.$dn[0].'-'.$dn[1];
                    if(strtotime($dn) === false) {
                        $dn = '';
                    }

                    //inserindo o paciente
                    $paciente = new Paciente();
                    $paciente->nome = utf8_encode($data[0]);
                    $paciente->sobrenome = utf8_encode($data[1]);
                    $paciente->email = filter_var($data[2], FILTER_VALIDATE_EMAIL) ? strtolower($data[2]) : '';
                    $paciente->data_nascimento = $dn;
                    $paciente->genero = utf8_encode($data[4]);
                    $paciente->id_tipo_sanguineo = TipoSanguineo::where('descricao', $tipoSanguineo)->first()->id;
                    $paciente->endereco = utf8_encode($data[6]);
                    $paciente->cidade = utf8_encode($data[7]);
                    $paciente->estado = strlen($data[8]) <= 2 ? $data[8] : '';
                    $paciente->cep = utf8_encode($data[9]);
                    $paciente->cpf = $this->validaCPF($data[10]) ? $data[10] : '';
                    $paciente->save();
                    
                }                
                
                $row++;
            }
            fclose($handle);
        }              
        return redirect('/lista'); 

    }

    protected function validaCPF($cpf) {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function lista() {

        //Listagem de pacientes
        $pacientes = Paciente::join('tipo_sanguineo','paciente.id_tipo_sanguineo','=', 'tipo_sanguineo.id')->orderBy('nome', 'asc')->paginate(20);
        
        return view('lista', [
            'pacientes' => $pacientes
        ]);

    }
}

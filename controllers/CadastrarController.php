<?php



class Cadastrar
{

    private $Conn;

    //Assim que instancia a classe Listar, automaticamente  armazena a conexao
    public function __construct()
    {
        if (file_exists('./config/config.php')) {
            require_once('./config/config.php');
            $this->Conn = $Conn;
        }
    }


    //Este metodo realiza a validação dos dados vindo do CSV, deleta tudo do banco antes de criar novos registos.
    public function create()
    {

        $file = 'pacientes.csv';
        if (file_exists($file)) {

            $data =  fopen('pacientes.csv', 'r');
            $del = $this->Conn->prepare("DELETE FROM tipo_sanguineo");
            $del = $this->Conn->prepare("DELETE FROM paciente");
            $del->execute();

            while (!feof($data)) {
                $line = (explode(',', fgets($data, 1024)));
                $line = array_filter($line);
                
                $line = array_map(function ($q) {
                    return strip_tags(trim($q));
                }, $line);

                $line = array_map(function ($q) {
                    $string = explode('"', $q);
                    return str_replace($q, '""', utf8_encode($string[1]));
                }, $line);

                //Valid Headers and condition date,email,cpf
                if ($line[0] != 'nome' && $line[1] != 'sobrenome' && $line[2] != 'email' && $line[3] != 'datanascimento' && $line[4] != 'genero' && $line[5] != 'tiposanguineo' && $line[6] != 'endereco' && $line[7] != 'cidade' && $line[8] != 'estado' && $line[9] != 'cep' && $line[10] != 'cpf' && $line[11] != 'frkPlanoSaude' && $this->validDate($line[3]) && $this->validEmail($line[2]) && $this->validaCPF($line[10])) {
                    //ValidTypeSanguineo
                    $line[5] = $this->createOrFirstTypeSanguineo($line[5]);

                    //Type Date
                    $line[3] =  $this->formatDate($line[3]);

                    if ($line[0] != '' && $line[1] != '' && $line[2] != '' && $line[3] != '' && $line[4] != '' && $line[5] != '' && $line[6] != '' && $line[7] != '' && $line[8] != '' && $line[9] != '' && $line[10] != '' && $line[11] != '') {
                        $exe = $this->Conn->prepare("INSERT INTO paciente (id_tipo_sanguineo,nome,sobrenome,cpf,email,data_nascimento,genero,endereco,cidade,estado,cep) VALUES (:id_tipo_sanguineo, :nome, :sobrenome, :cpf, :email, :data_nascimento, :genero, :endereco, :cidade, :estado, :cep)");
                        $exe->bindParam(':id_tipo_sanguineo', $line[5]);
                        $exe->bindParam(':nome', $line[0]);
                        $exe->bindParam(':sobrenome', $line[1]);
                        $exe->bindParam(':cpf', $line[10]);
                        $exe->bindParam(':email', $line[2]);
                        $exe->bindParam(':data_nascimento', $line[3]);
                        $exe->bindParam(':genero', $line[4]);
                        $exe->bindParam(':endereco', $line[6]);
                        $exe->bindParam(':cidade', $line[7]);
                        $exe->bindParam(':estado', $line[8]);
                        $exe->bindParam(':cep', $line[9]);
                        $exe->execute();
                    }
                }
            }

            fclose($data);
        }

        return json_encode(['data' => true]);
    }

    //Este metodo é responsável por verificar se o tipo sanguineo ja existe no banco, caso exista ele retorna o id, caso não exista, ele cria o tipo sanguineo e retorna o id.
    private function createOrFirstTypeSanguineo($type)
    {
        $exe = $this->Conn->prepare("SELECT * FROM tipo_sanguineo WHERE descricao = :descricao");
        $exe->bindParam(':descricao', $type);
        $exe->execute();
        $result = $exe->fetch(PDO::FETCH_ASSOC);

        if (!empty($result) && array_count_values($result) > 0) {
            return $result['id'];
        } else {
            $exe = $this->Conn->prepare("INSERT INTO tipo_sanguineo (descricao) VALUES (:descricao)");
            $exe->bindParam(':descricao', $type);
            $exe->execute();
            $this->createOrFirstTypeSanguineo($type);
        }
    }

    //Methodo responsável por formatar a data em timestamp
    private function formatDate($date)
    {
        $dateTimeStamp = explode('/', $date);
        $dateTimeStamp = $dateTimeStamp[2] . '-' . $dateTimeStamp[1] . '-' . $dateTimeStamp[0];
        return $dateTimeStamp;
    }

    //Methodo responsável por fazer a validacao da data atraves de uma expressão regular 
    private function validDate($date)
    {
        $dateTimeStamp = $this->formatDate($date);
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateTimeStamp)) {
            return true;
        } else {
            return false;
        }
    }

    //MEthodo responsável por validacao de e-mail atraves do filter validate email
    private function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    //Methodo responsável por fazer validacao de CPF atraves de uma expressão regular
    function validaCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
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
}

<?php



class Listar
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

    //Methodos responsável por retornar todos os registros do banco juntamente com o relacionamento tipo sanguineo
    public function get()
    {
        $exe = $this->Conn->prepare("SELECT * FROM paciente INNER JOIN tipo_sanguineo ON paciente.id_tipo_sanguineo = tipo_sanguineo.id");
        $exe->execute();
        $result = $exe->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(['data' => $result]);
    }
}

<?php

require_once(dirname(__FILE__) . '/../SQLConnection.php');
require_once(dirname(__FILE__) . '/../../helpers/FilterData.php');
require_once(dirname(__FILE__) . '/../../models/Paciente.php');

class PacienteDAO
{

    private $db;
    private const insertQuery = 'INSERT INTO paciente (id_tipo_sanguineo, nome, sobrenome, email, cpf, data_nascimento, genero, endereco, cidade, estado, cep) values (:id_tipo_sanguineo, :nome, :sobrenome, :email, :cpf, :data_nascimento, :genero, :endereco, :cidade, :estado, :cep)';
    private const deleteAllQuery = 'DELETE FROM paciente';
    private const itemsPerPage = 10;

    public function __construct()
    {
        $this->db = SQLConnection::getInstance();
    }

    public function getAllPacientes($page = false)
    {
        $prevPage = 0;
        $nextPage = 0;
        $pageFrom = 0;
        $pageTo = 0;
        if ($page) {
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        } else {
            $page = 1;
        }
        $queryCount = 'SELECT * FROM paciente';
        $stmCount = $this->db->prepare($queryCount);
        $stmCount->execute();
        $totalPages = ceil($stmCount->rowCount() / self::itemsPerPage);
        if ($page > $totalPages) $page = (int)$totalPages - 1;
        if ($page <= 0) $page = 1;
        $offset = ($page - 1) * self::itemsPerPage;
        $query = 'SELECT p.id, p.nome, p.sobrenome, p.cpf, p.email, p.data_nascimento, p.genero, p.endereco, p.cidade, p.estado, p.cep, tp.descricao AS tipo_sanguineo FROM shosp.paciente p left join shosp.tipo_sanguineo tp on p.id_tipo_sanguineo = tp.id LIMIT ' . $offset . "," . self::itemsPerPage;
        $pacientes = [];
        $stm = $this->db->query($query);
        while ($row = $stm->fetch()) {
            array_push($pacientes, $row);
        }
        if ($page > 1) $prevPage = $page - 1;
        if ($totalPages > $page) $nextPage = $page + 1;
        if ($totalPages > 5) {
            if (($page - 2) > 1) $pageFrom = $page - 2;
            if (($page + 2) < $totalPages) $pageTo = $page + 2;
        }
        return ['pacientes' => $pacientes, 'totalPages' => $totalPages, 'prevPage' => $prevPage, 'nextPage' => $nextPage, 'pageFrom' => $pageFrom, 'pageTo' => $pageTo, 'page' => $page];
    }

    public function insertPaciente(Paciente $p)
    {
        $errors = FilterData::fieldsValidation($p);
        if ($errors) {
            return $errors;
        }
        try {
            $idTipoSanguineo = $this->getTipoSanguineoByName($p->getTipoSanguineo());
            $stm = $this->db->prepare(self::insertQuery);
            $stm->execute([
                'id_tipo_sanguineo' => $idTipoSanguineo,
                ':nome' => utf8_encode($p->getNome()),
                ':sobrenome' => utf8_encode($p->getSobrenome()),
                ':email' => $p->getEmail(),
                ':cpf' => $p->getCpf(),
                ':data_nascimento' => FilterData::formatDate($p->getDataNasc()),
                ':genero' => $p->getGenero(),
                ':endereco' => utf8_encode($p->getEndereco()),
                ':cidade' => utf8_encode($p->getCidade()),
                ':estado' => substr($p->getEstado(), 0, 2),
                ':cep' => $p->getCep(),
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteAll()
    {
        $stm = $this->db->prepare(self::deleteAllQuery);
        $stm->execute();
    }

    public function getTipoSanguineoByName($tipoSanguineo): int
    {
        switch ($tipoSanguineo) {
            case 'A+':
                return 1;
            case 'A-':
                return 2;
            case 'B+':
                return 3;
            case 'B-':
                return 4;
            case 'AB+':
                return 5;
            case 'AB-':
                return 6;
            case 'O+':
                return 7;
            case 'O-':
                return 8;
            default:
                return 9;
        }
    }
}

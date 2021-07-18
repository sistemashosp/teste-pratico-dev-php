<?php

require_once(dirname(__FILE__) . '/../../models/TipoSanguineo.php');
require_once(dirname(__FILE__) . '/../SQLConnection.php');

class TipoSanguineoDAO
{

    private $db;
    private const insertQuery = 'INSERT INTO tipo_sanguineo (id, descricao) values (:id, :descricao)';
    private const deleteAllQuery = 'DELETE FROM tipo_sanguineo';

    public function __construct()
    {
        $this->db = SQLConnection::getInstance();
    }

    public function insertAll()
    {
        $tiposSanguineos = [
            1 => 'A+',
            2 => 'A-',
            3 => 'B+',
            4 => 'B-',
            5 => 'AB+',
            6 => 'AB-',
            7 => 'O+',
            8 => 'O-',
        ];

        try {
            foreach ($tiposSanguineos as $id => $tipoSanguineo) {
                $stm = $this->db->prepare(self::insertQuery);
                $stm->execute([
                    ':id' => $id,
                    ':descricao' => $tipoSanguineo
                ]);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteAll()
    {
        try {
            $stm = $this->db->prepare(self::deleteAllQuery);
            $stm->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

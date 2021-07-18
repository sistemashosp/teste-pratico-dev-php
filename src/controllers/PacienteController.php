<?php
require_once(dirname(__FILE__) . '/../database/dao/PacienteDAO.php');
require_once(dirname(__FILE__) . '/../database/dao/TipoSanguineoDAO.php');
class PacienteController
{
    public function importFromCsv($fileName = null)
    {
        if ($fileName == null) {
            $fileName = 'pacientes.csv';
        }
        $pacienteDao = new PacienteDAO();
        $pacienteDao->deleteAll();
        $tipoSanguineoDao = new TipoSanguineoDAO();
        $tipoSanguineoDao->deleteAll();
        $tipoSanguineoDao->insertAll();
        $count = 0;
        $errors = [];
        if (($csv = fopen($fileName, "r")) !== false) {
            while (($data = fgetcsv($csv, 0, ",")) !== false) {
                $count++;
                if ($count == 1) continue;
                $paciente = new Paciente($data[5], $data[0], $data[1], $data[10], $data[2], $data[3], $data[4], $data[6], $data[7], $data[8], $data[9]);
                $result = $pacienteDao->insertPaciente($paciente);
                if (is_array($result)) {
                    $errors[] = ['CPF' => $paciente->getCpf() . ' com dados incorretos!', 'errors' => $result];
                }
            }
            fclose($csv);
        }
        if (count($errors) > 0) {
            echo json_encode(['success' => 'partially', 'msg' => 'Existem erros!', 'errors' => $errors]);
            echo '<br>';
        } else {
            echo json_encode(['success' => 'true', 'msg' => 'Pacientes importados com successo!']);
        }
    }
}

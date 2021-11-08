<?php

class Listar extends Controller {

    public function __construct(){
        $this->patientModel = $this->model('Paciente');
    }

    public function getPatients($page = 1){
        $patients = $this->patientModel->listPatients();

        if(empty($patients)){
            echo "Não foi encontrado registros no banco de dados";
            die;
        }

        $totalPages = count((array) $patients);
        $from = ($page - 1) * 30;
        $offset = 30;

        $sliced = array_slice($patients, $from, $offset);
        $sliced[0]->totalPages = ceil($totalPages/30);

        $this->view('list/patients', $sliced);
    }

}
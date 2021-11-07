<?php

class Cadastrar extends Controller {

    public function __construct(){
        $this->patientModel = $this->model('Paciente');
    }
    
    public function insertView(){
        $this->view('insert/form');
    }

    public function insertSuccess(){
        $this->view('insert/success');
    }

    public function failedFile(){
        $this->view('insert/fail');
    }


    public function pushCsv(){

        //Caso não exista o arquivo CSV, redirecionar para a página inicial.
        if (!($_FILES)){
            header("Location: ".URL);
        }

        //Carregando arquivo CSV
        $csv = $this->parseCsv($_FILES['csv']['tmp_name']);
        
        //Validando e inserindo valores na tabela
        foreach ($csv as $patient){
            $validatedData = $this->validateCsv($patient);
            $this->patientModel->insert($validatedData);
        }
    }

    public function validateCsv($patient){

        //Validando campo CPF
        if(array_key_exists('cpf', $patient)){
            $validateCpf = $this->isCpfCorrect($patient['cpf']);

            if($validateCpf == false){
               $patient['cpf'] = " ";
            }
        }

        else {
            $patient['cpf'] = " ";
        }

        //Validando campo data de nascimento
        if(array_key_exists('datanascimento', $patient)){
            $validateBirthday = $this->isBirthdayCorrect($patient['datanascimento']);

            if($validateCpf == false){
               $patient['datanascimento'] = " ";
            }   
            $patient['datanascimento'] = $validateBirthday;
        }

        else {
            $patient['datanascimento'] = " ";
        }

        //Validando campo email
        if(array_key_exists('email', $patient)){
            $validateEmail = $this->isEmailCorrect($patient['email']);
            if($validateEmail == false){
               $patient['email'] = " ";
            }
        }

        else {
            $patient['email'] = " ";
        }

        return $patient;
    }

    public function insertValues($params){
        //
    }

    public function isCpfCorrect($cpf){
 
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

    public function isEmailCorrect($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        else {
            return true;
        }
    }

    public function isBirthdayCorrect($birthday){
        $date = explode('/', $birthday);
        $day = 0;
        $month = 0;
        $year = 0;

        //Validando a existencia dos campos e garantindo apenas o formato int
        if (array_key_exists(1, $date)){
            $day = (int) filter_var($date[1], FILTER_SANITIZE_NUMBER_INT);
        }

        if (array_key_exists(0, $date)){
            $month = (int) filter_var($date[0], FILTER_SANITIZE_NUMBER_INT);
        }

        if (array_key_exists(2, $date)){
            $year = (int) filter_var($date[2], FILTER_SANITIZE_NUMBER_INT);
        }

        $check = checkdate($month, $day, $year);

        if ($check == true){
            return $year.'-'.$month.'-'.$day;
        }

        else {
            return false;
        }
    }

    
    public function parseCsv($file){
        $lines = explode( "\n", file_get_contents($file) );
        $headers = str_getcsv( array_shift( $lines ) );
        $data = array();
        foreach ( $lines as $line ) {

            $row = array();

            foreach (str_getcsv( $line ) as $key => $field)
                $row[ $headers[ $key ] ] = $field;

            $row = array_filter( $row );

            $data[] = $row;
        }

        return $data;
    }
}
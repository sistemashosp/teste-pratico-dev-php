<?php

require 'config.php';
require 'dao/PacienteDaoMysql.php';
$pacienteDao = new PacienteDaoMysql($pdo);
$pacienteDao->delete();

$delimitador = ',';
$cerca = '"';

$f = fopen('pacientes.csv', 'r');
if ($f) { 
    
    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);

    while (!feof($f)) { 

        $linha = fgetcsv($f, 0, $delimitador, $cerca);
        if (!$linha) {
            continue;
        }

        $registro = array_combine($cabecalho, $linha);        

        switch ($registro['tiposanguineo']) {
		    case 'A+':
		        $id_tipo_sanguineo = '1';
		        break;
		    case 'A-':
		        $id_tipo_sanguineo = '2';
		        break;
		    case 'B+':
		        $id_tipo_sanguineo = '3';
		        break;
		    case 'B-':
		        $id_tipo_sanguineo = '4';
		        break;
		    case 'AB+':
		        $id_tipo_sanguineo = '5';
		        break;
		    case 'AB-':
		        $id_tipo_sanguineo = '6';
		        break;
		    case 'O+':
		        $id_tipo_sanguineo = '7';
		        break;
		    case 'O-':
		        $id_tipo_sanguineo = '8';
		        break;
		}
        
        $nome = $registro['nome'];
        $sobrenome = $registro['sobrenome'];
        $cpf = $registro['cpf'];        
        $email = filter_var($registro['email'], FILTER_VALIDATE_EMAIL);
        $dataNascimento = $registro['datanascimento'];
        $genero = $registro['genero'];
        $endereco = $registro['endereco'];
        $cidade = $registro['cidade'];
        $estado = $registro['estado'];
        $cep = $registro['cep'];

        if(!$email){
        	$email = '';
        }
       
        if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) {
        	$cep = '';
        }

        $arraydata = explode('/', $registro['datanascimento']);
       
        if(count($arraydata) == 3 && checkdate($arraydata['0'], $arraydata['1'], $arraydata['2'])){

        	$date = $arraydata['2'].$arraydata['0'].$arraydata['1'];

        	$date=date("Y-m-d",strtotime($date));

        } else{
        	$date = null;

        }    

        $novoPaciente = new Paciente();

        $novoPaciente->setIdTipoSanguineo($id_tipo_sanguineo);
        $novoPaciente->setNome($nome);
        $novoPaciente->setSobrenome($sobrenome);
        $novoPaciente->setCpf($cpf);
        $novoPaciente->setEmail($email);
        $novoPaciente->setDataNascimento($date);
        $novoPaciente->setGenero($genero);
        $novoPaciente->setEndereco($endereco);
        $novoPaciente->setCidade($cidade);
        $novoPaciente->setEstado($estado);
        $novoPaciente->setCep($cep);

        $pacienteDao->add($novoPaciente); 

        

    }
    fclose($f);
}

header("Location: lista.php");

?>

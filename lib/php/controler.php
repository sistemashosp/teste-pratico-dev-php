<?php

if(isset($_GET['func'])){
    $function = $_GET['func'];
    if(function_exists($function)){
        call_user_func($function);
        exit();
    }
}

//Pegando pacientes do CSV
function listPatients(){
	$aRetornodados = array();
	if(is_file("../../pacientes.csv")){
		$verifications = new verifications;
		$delimitador = ',';
		$cerca = '"';
		$f = fopen('../../pacientes.csv', 'r');
		if ($f) { 
    		$cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
    		while (!feof($f)) { 
        		$linha = fgetcsv($f, 0, $delimitador, $cerca);
        		if (!$linha) {
            		continue;
        		}
        		$registro = array_combine($cabecalho, $linha);
        		$cpf = $verifications->checkCpf($registro['cpf']);
        		$email = $verifications->checkEmail($registro['email']);
        		$nascimento = $verifications->checkNascimento($registro['datanascimento']);
        		$aRetornodados[] = array("nome" =>$registro['nome'], "sobrenome"=>$registro['sobrenome'],"cpf" =>$registro['cpf'],"email" => $email, "datanascimento"=>$nascimento, "genero" =>$registro['genero'], "tiposanguineo"=>$registro['tiposanguineo'], "endereco"=>$registro['endereco'], "cidade"=>$registro['cidade'], "estado"=>$registro['estado'], "cep"=>$registro['estado']);
    		}
    		fclose($f);
		}
		return $aRetornodados;
	}else{
		echo"Arquivo Não localizado, Favor inserir o arquivlo Pacientes.csv na raiz do projeto.";
	}
}

class verifications{

	public function checkCpf($cpf){
    	// Extrai somente os números
   	 	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    	if (strlen($cpf) != 11) {
        	return "";
    	}
    	// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    	if (preg_match('/(\d)\1{10}/', $cpf)) {
        	return "";
   		}
    	// Faz o calculo para validar o CPF
    	for ($t = 9; $t < 11; $t++) {
        	for ($d = 0, $c = 0; $c < $t; $c++) {
            	$d += $cpf{$c} * (($t + 1) - $c);
        	}
        	$d = ((10 * $d) % 11) % 10;
        	if ($cpf{$c} != $d) {
            	return "";
        	}
    	}
    	return $this->mask("###.###.###-##",$cpf);
	}

	public function mask($mask,$str){
    	$str = str_replace(' ','',$str);
    	for($i=0;$i<strlen($str);$i++){
        	$mask[strpos($mask,"#")] = $str[$i];
    	}
    	return $mask;
    }
	public function checkEmail($email){
		if(!preg_replace('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', " ", $email)){
        	return "";   
    	}else{
        	$dominio = explode('@',$email);
        	if(!checkdnsrr($dominio[1],'A')){
				return "";
			}else{
            	return $email;
        	}
    	}
	}
	function checkNascimento($nascimento){
		$data = explode("/",$nascimento); 
		$d = $data[1];
		$m = $data[0];
		$y = $data[2];
		$res = checkdate($m,$d,$y);
		if ($res == 1){
	   		return $d."/".$m."/".$y;
		}else{
	   		return "";
		}
	}

}

?>
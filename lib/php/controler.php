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
		$handle = fopen("../../pacientes.csv", "r");
        $linha = 0;
        $n = 0;
        while ($line = fgetcsv($handle, 1000, ",")) {
            if ($linha++ == 0) {
                continue;
            }
            $cpf = $verifications->checkCpf(utf8_encode($line[10]));
            $email = $verifications->checkEmail(utf8_encode($line[2]));
            $nascimento = $verifications->checkNascimento(utf8_encode($line[3]));
            $aRetornodados[] = array("nome" =>utf8_encode($line[0]), "sobrenome"=>utf8_encode($line[1]),"cpf" =>$cpf,"email" => $email, "datanascimento"=>$nascimento, "genero" =>utf8_encode($line[4]), "tiposanguineo"=>utf8_encode($line[5]), "endereco"=>utf8_encode($line[6]), "cidade"=>utf8_encode($line[7]), "estado"=>utf8_encode($line[8]), "cep"=>$line[9]);
        }
        fclose($handle);
		die(json_encode($aRetornodados));
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
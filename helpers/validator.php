<?php 
function validaCPF($cpf) {
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

function ValidaData($dat){

	$data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
	@$d = $data[0];
	@$m = $data[1];
	@$y = $data[2];

	@$res = checkdate($m,$d,$y);
	if ($res == 1){
	  return true;
	} else {
	  return false;
	}
}


function converterData($data){

    $data = explode("/","$data"); // fatia a string $dat em pedados, usando / como referência
	@$d = $data[0];
	@$m = $data[1];
	@$y = $data[2];
   return  $formAmer = $y."-".$m."-".$d;

}
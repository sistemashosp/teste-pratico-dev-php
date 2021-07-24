<?php
define("DB_HOST", 'localhost');
define('DB_DATABASE', 'db_shosp');
define('DB_U', '');
define('DB_P', '');

function conexao(){
        $retorno = new mysqli(DB_HOST, DB_U, DB_P, DB_DATABASE);
        return $retorno;
}

function transacao($con, $tipo){
    switch($tipo){
        case 'i':
            $con->begin_transaction();
            break;
        case 'c':
            $con->commit();
            break;
        case 'r':
            $con->rollback();
            break;
        default:
            $errors[] = 666;
    }

}

function sqlSelect($con, $query, $format = false, ...$vars){
    $stmt = $con->prepare($query);
    if($format){
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()){
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    }
    $stmt->close();
    return false;
}

function sqlInsert($con, $query, $format = false, ...$vars){
    $stmt = $con->prepare($query);
    if($format){
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()){
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
    $stmt->close();
    return -1;
}

function sqlUpdate($C, $query, $format = false, ...$vars) {
    $stmt = $C->prepare($query);
    if($format) {
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()) {
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;
}


function criarToken(){
    $seed = urlSafeEncode(random_bytes(13));
    $t = time();
    $hash = urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, "SEC__TKN", true));
    return urlSafeEncode($hash . '|' . $seed . '|' . $t);
}

function validarToken($token){
    $parts = explode('|', urlSafeDecode($token));
		if(count($parts) === 3) {
            $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], "SEC__TKN", true);
			if(hash_equals($hash, urlSafeDecode($parts[0]))) {
				return true;
			}
		}
		return false;
}

function urlSafeEncode($m) {
    return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
}
function urlSafeDecode($m) {
    return base64_decode(strtr($m, '-_', '+/'));
}

?>
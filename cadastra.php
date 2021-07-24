<?php
require_once "config.php";

if(!empty($_POST['csrf_tkn'])){
    if(validarToken($_POST['csrf_tkn'])){
        if(empty($_FILES['fileCSV']['error'])){
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if(!in_array($_FILES['fileCSV']['type'], array('text/plain','text/csv'))){
                // FORMATO DO ARQUIVO INVÁLIDO
                $resposta['erro'][] = 1;
            }else{
                $arquivo = fopen($_FILES['fileCSV']['tmp_name'], 'r');
                if ($arquivo){
                    $inicio = fgetcsv($arquivo, 0, ",", "\"");
                    $con = conexao();
                    transacao($con, 'i');
                    sqlUpdate($con, "TRUNCATE TABLE paciente");
                    sqlUpdate($con, "DELETE FROM tipo_sanguineo");
                    while (!feof($arquivo)){
                        $linha = fgetcsv($arquivo, 0, ",", "\"");
                        if(!$linha){
                            break;
                        }
                        $imp = implode(",", $linha);
                        if(mb_detect_encoding($imp) !== "ASCII"){
                            $linha = explode(",", mb_convert_encoding($imp, "ASCII", mb_detect_encoding($imp)));
                        }

                        $inicioLinha = array_combine($inicio, $linha);
                        
                        switch($inicioLinha['tiposanguineo']){
                            case "O+":
                                $tiposanguineo = 1;
                                break;
                            case "O-":
                                $tiposanguineo = 2;
                                break;
                            case "A+":
                                $tiposanguineo = 3;
                                break;
                            case "A-":
                                $tiposanguineo = 4;
                                break;
                            case "B+":
                                $tiposanguineo = 5;
                                break;
                            case "B-":
                                $tiposanguineo = 6;
                                break;
                            case "AB+":
                                $tiposanguineo = 7;
                                break;
                            case "AB-":
                                $tiposanguineo = 8;
                                break;
                            default:
                                $inicioLinha['tiposanguineo'] = "NA";
                                $tiposanguineo = 9;
                        }
                    
                        //CHECAGEM DO FORMATO DO CPF
                        if(!$inicioLinha['cpf']){
                            $inicioLinha['cpf'] = "";
                        }else if(strlen($inicioLinha['cpf']) !== 11){
                            $inicioLinha['cpf'] = "";
                        }

                        //CHECAGEM DO FORMATO DO EMAIL
                        if(!$inicioLinha['email']){
                            $inicioLinha['email'] = "";
                        }else if(!mb_strpos($inicioLinha['email'],"@") || !mb_strpos($inicioLinha['email'],".") || strlen($inicioLinha['email']) > 150){
                            $inicioLinha['email'] = "";
                        }

                        if($inicioLinha['datanascimento']){
                            $inicioLinha['datanascimento'] = explode('/', $inicioLinha['datanascimento']);
                            $inicioLinha['datanascimento'] = date("Y-m-d",strtotime($inicioLinha['datanascimento'][2].$inicioLinha['datanascimento'][0].$inicioLinha['datanascimento'][1]));                        
                        } else{
                            $inicioLinha['datanascimento'] = null;
                        }  


                        $check = sqlInsert($con, "INSERT INTO tipo_sanguineo VALUES(?,?) ON DUPLICATE KEY UPDATE descricao = ?", 'iss', $tiposanguineo, $inicioLinha['tiposanguineo'], $inicioLinha['tiposanguineo']);
                        if($check === -1){
                            // ERRO AO INSERIR TIPO SANGUINEO
                            transacao($con, 'r');
                            $resposta['erro'][] = 2;
                            break;
                        }

                        $check = sqlInsert($con, "INSERT INTO paciente VALUES(NULL, ?,?,?,?,?,?,?,?,?,?,?)", 'issssssssss',
                        $tiposanguineo, $inicioLinha['nome'], $inicioLinha['sobrenome'], $inicioLinha['cpf'], $inicioLinha['email'], $inicioLinha['datanascimento'], $inicioLinha['genero'],
                        $inicioLinha['endereco'], $inicioLinha['cidade'], $inicioLinha['estado'], $inicioLinha['cep']);
                        if($check === -1){
                            transacao($con, 'r');
                            // ERRO AO INSERIR PACIENTE
                            $resposta['erro'][] = 3;
                            
                           
                        }

                    }
                    if(!isset($resposta['erro'])){
                        transacao($con,'c');
                        $resposta[] = 0;
                    }
                }    
            }        

        }else{
            // ERRO AO CARREGAR ARQUIVO
            $resposta['erro'][] = 4;
        }
    }else{
        // CSRF TOKEN INVÁLIDO
        $resposta['erro'][] = 5;
    }
}else{
    // CSRF TOKEN INVÁLIDO
    $resposta['erro'][] = 5;
}

    echo json_encode($resposta);
?>
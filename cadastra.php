<!DOCTYPE html>
<html>

<head>
    <title> Cadastrar Arquivos CSV</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <form class="form-horizontal" action="#" method="post">
        <div class="form-group">
            <label for="mysql" class="control-label col-xs-2">Nome do Servidor ou Endereço MYSQL</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="mysql" id="mysql" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="control-label col-xs-2">Usuário</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-xs-2">Senha</label>
            <div class="col-xs-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="db" class="control-label col-xs-2">Nome do Banco de Dados</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="db" id="db" placeholder="">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="button-submit" id="button-submit">Enviar</button>
    </form>
    </div>
</body>

</html>

<?php
/**
 * Função para validar CPF
 *
 * Essa função tem como objetivo validar cpfs, primeiro extrai os números e logo verifica
 * se foi informado todos os dígitos corretamente, após há uma condição para
 * validar seqûencia de números repetidos e por último faz o cálculo para validar
 * o cpf de acordo com suas regras.
 */

function validarCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

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

/**
 * Função para validar E-mail
 *
 * Essa função tem como objetivo validar e-mails, verifica se a escrita
 * do e-mail está correta e também faz uma verificação se o dominio
 * utilizado no endereço realmente existe.
 */
function validarEmail($email)
{
    if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})', $email)) {
        $mensagem = 'E-mail Inv&aacute;lido!';
        return $mensagem;
    } else {
        $dominio = explode('@', $email);
        if (!checkdnsrr($dominio[1], 'A')) {
            $mensagem = 'E-mail Inv&aacute;lido!';
            return $mensagem;
        } else {
            return true;
        }
    }
}

/**
 * Função para validar datas
 *
 * Essa função tem como objetivo validar datas, após comparar
 * o seu tamanho, usa-se o checkdate aonde passamos o mes, 
 * dia, ano, retornando true se data é valida. 
 */
function validarData($data)
{
    if (strlen($data) < 8) {
        return false;
    } else {
        if (strpos($data, "/") !== FALSE) {
            $partes = explode("/", $data);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = isset($partes[2]) ? $partes[2] : 0;

            if (strlen($ano) < 4) {
                return false;
            } else {
                if (checkdate($mes, $dia, $ano)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}

/**
 * Leitura do Arquivo Pacientes em csv e Gravação no Banco de dados (MYSQL)
 *
 * Aqui estamos percorrendo o arquivo pacientes
 * Após a leitura do arquivo a idéia é gravar todos os dados inseridos no banco de dados.
 */
ini_set('max_execution_time', 0);

//Partição do arquivo pacientes
$arrayFilesCsv = ['pacientes_0.csv', 'pacientes_1.csv', 'pacientes_2.csv', 'pacientes_3.csv', 'pacientes_4.csv', 'pacientes_5.csv'];

//Após o botão enviar envia os dados via POST 
if (isset($_POST["button-submit"])) {
    $sqlname = $_POST['mysql'];
    $username = $_POST['username'];
    $db = $_POST['db'];
    $password = $_POST['password'];
}

//Validação nos dados entrada
if (isset($_POST['username']) && isset($_POST['mysql']) && isset($_POST['db']) && isset($_POST['username'])) {

    //Abre conexão com o banco de dados
    $connection = mysqli_connect("$sqlname", "$username", "$password", "$db") or die(mysql_error());

    if ($connection) {
        //Verifica se tem dados no banco de dados, se tiver... faz a remoção das informações
        $patientsInTheDatabase = mysqli_query($connection, "SELECT * from paciente");
        $bloodTypeInTheDatabase = mysqli_query($connection, "SELECT * from tipo_sanguineo");
        if ($patientsInTheDatabase) {
            if (mysqli_num_rows($patientsInTheDatabase) > 0)
                mysqli_query($connection, "DELETE FROM paciente");
        }
        if ($bloodTypeInTheDatabase) {
            if (mysqli_num_rows($bloodTypeInTheDatabase) > 0)
                mysqli_query($connection, "DELETE FROM tipo_sanguineo");
        }

        //Percorre ao arquivo CSV
        foreach ($arrayFilesCsv as $key => $value) {
            $csvFile = fopen("$value", "r");
            $count = 0;
            while (($line = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
                if ($count == 0) {
                    $name = $line[0];
                    $lastName = $line[1];
                    $email = $line[2];
                    $dateOfBirth = date('Y-m-d', strtotime(str_replace("/", "-", $line[3])));
                    $gender = $line[4];
                    $bloodType = $line[5];
                    $address = $line[6];
                    $city = $line[7];
                    $state =  $line[8];
                    $zipCode = $line[9];
                    $cpf = $line[10];
                    $frkHealthPlan = $line[11];
                } else {
                    $insertBloodTypeData = "INSERT INTO tipo_sanguineo (id, descricao) VALUES(NULL,'$line[5]');";
                    mysqli_query($connection, $insertBloodTypeData);

                    $insertPatientData = "INSERT INTO paciente (id, id_tipo_sanguineo, nome, sobrenome, cpf, email, data_nascimento, genero, endereco, cidade, estado, cep) VALUES(NULL, $count+1,'$line[0]', '$line[1]','$line[10]','$line[2]', '$dateOfBirth','$line[4]', '$line[6]', '$line[7]', '$line[8]','$line[9]')";
                    mysqli_query($connection, $insertPatientData);
                }
                $count++;
            }
            fclose($csvFile);
        }
    } else {
        echo "Conexão com falha!";
    }
}

<?php
require 'Sql.php';

// your code here
    $nome = $post['nome'];
    $sobrenome = $post['sobrenome'];
    $cpf = (int)$post['cpf'];
    $email = $post['email'];
    $nascimento = $post['data_nascimento'];
    $genero = $post['genero'];
    $endereco = $post['endereco'];
    $cidade = $post['cidade'];
    $estado = $post['estado'];
    $cep = (int)$post['cep'];
    $descricao = $post['descricao'];

     function  Insert()
    {
        $sql = "INSERT INTO paciente
        ($nome, $sobrenome, $cpf, $email, $nascimento, $genero, $endereco, $cidade, $estado, $cidade, $estado, $cep, $descricao)
        VALUES
        (nome, sobrenome, cpf, email, data_nascimento, genero, endereco, cidade, cep, descricao)";
    } 

         function Delete()
    {
        $conn = new Sql;
        $conn = $conn->getConn();

        $sql = "DELETE FROM paciente 
                WHERE nome = :nome,
                      sobrenome = :sobrenome,
                      cpf = :cpf,
                      email = :email,
                      nascimento = :data_nascimento,
                      genero = :genero,
                      endereco = :endereco,
                      cidade = :cidade,
                      cep = :cep,
                      descricao , :descricao
                      ";

        $stmt = $conn->prepare($sql);

        $result = $stmt->execute();

        return $result;
    }

     function Select()
    {

        $result = "SELECT 'paciente'.*, 'tipo_sanguineo' * FROM paciente
                        INNER JOIN 'paciente' AS 'tipo_sanguineo' ON 'paciente'. id_tipo_sanguineo
                        ORDER BY ASC";

         $result_dados = pg_query($conn, $result); 
    }

    function validateCPF($cpf) 
    {

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

    function validateEmail($email)
    {
        //verifica se e-mail esta no formato correto de escrita
        if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email))
        {
            $mensagem='E-mail Inv&aacute;lido!';
            return $mensagem;
        }
        else
        {
            //Valida o dominio
            $dominio=explode('@',$email);
            if(!checkdnsrr($dominio[1],'A'))
            {
                $mensagem='E-mail Inv&aacute;lido!';
                return $mensagem;
            }
            else{return true;} // Retorno true para indicar que o e-mail é valido
        }
    }
    ?>
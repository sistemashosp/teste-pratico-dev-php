<?php

    class VerificaConexao {

        function ConectaBancoDados (){
            
            $servername = "localhost";
            $username = "username";
            $password = "password";
    
            $conexao = new mysqli ($servername, $username, $password);
    
            if ($conexao -> connect_error) {
                die("Falha na Conexão! Confira as credenciais..." . $conexao -> connect_error);
            }
            echo "Conexão realizada!";

        }

    }

?>
<?php

require_once "config.php";

class Conexao
{
    public static function get()
    {
        $conexao = new PDO(DB_DRIVE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }
}
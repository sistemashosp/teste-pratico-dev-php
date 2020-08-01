<?php

require_once "config.php";

class Erro
{
    public static function trataErro(Exception $e)
    {
        if (DEBUG)
        {
            echo "<pre>";
            print_r($e->getMessage());
            echo "</pre>";
            exit;
        } else {
            echo $e->getMessage();
        }
    }
}
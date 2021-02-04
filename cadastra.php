<?php

if (file_exists('./controllers/CadastrarController.php')) {
    require_once('./controllers/CadastrarController.php');
}

$data = new Cadastrar();
$create = $data->create();

echo $create;


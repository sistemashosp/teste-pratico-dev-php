<?php

if (file_exists('./controllers/ListarController.php')) {
    require_once('./controllers/ListarController.php');
}

$data = new Listar();
$list = $data->get();

echo $list;


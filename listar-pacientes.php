<?php

require_once "global.php";

try {
    if (isset($_GET["page"]) && $_GET["page"] >= 1)
    {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $paciente = new Paciente();
    $pacientes = $paciente->listar($page);   
    echo json_encode($pacientes);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode($e->getMessage());
}
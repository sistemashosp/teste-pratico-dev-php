<?php

namespace Source\Services;

class ValidaEstado {

    function validate($estado){
        if (strlen($estado) > 2){
            return substr($estado, 0,2);
        } else {
            return $estado;
        }
    }
}
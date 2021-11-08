<?php

namespace Source\Services;

class ValidaData {

    function validate($data_nascimento)
    {
        $test_arr = explode('/', $data_nascimento);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
                return date('Y-m-d', strtotime($data_nascimento));
            } else {
                return null;
            }
        }

    }
}
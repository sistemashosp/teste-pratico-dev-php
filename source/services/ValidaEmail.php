<?php

namespace Source\Services;

class ValidaEmail {
    function validate($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }else {
            return null;
        }
    }
}
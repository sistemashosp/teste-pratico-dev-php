<?php

class FilterData
{
    public static function formatDate($date)
    {
        $date = strtotime($date);
        $formattedDate = date("Y-m-d", $date);
        return $formattedDate;
    }

    public static function fieldsValidation(Paciente $p)
    {
        $errors = [];
        if (!preg_match('/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/', $p->getCpf()) || strlen($p->getCpf()) != 11) {
            $errors[] = 'CPF inválido!';
        }
        if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $p->getEmail())) {
            $errors[] = 'Email inválido!';
        }
        if (!preg_match('/[0-9]{5}-[\d]{3}/', $p->getCep())) {
            $errors[] = 'CEP inválido!';
        }
        if (!preg_match('/(\d{1,2})[-.\/](\d{1,2})[-.\/](\d{4})/', $p->getDataNasc())) {
            $errors[] = 'Data de nascimento inválida!';
        }

        if (count($errors) > 0) {
            return $errors;
        } else {
            return false;
        }
    }
}

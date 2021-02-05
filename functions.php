<?php  
    function validaNascimento($dataNasc){ 
        $convertData  = str_replace('/','-', $dataNasc);  
        $newDate = date("Y-m-d", strtotime($convertData));  
        return $newDate; 
    }
?>

     
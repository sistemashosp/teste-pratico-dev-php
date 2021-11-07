<?php
    spl_autoload_register(function ($class){

        $path = [
            'Libraries',
            'Helpers'
        ];

        foreach($path as $p){
            $file = (__DIR__.DIRECTORY_SEPARATOR.$p.DIRECTORY_SEPARATOR.$class.'.php');
            if(file_exists($file)){
                require_once $file;
            }
        }
    });
?>

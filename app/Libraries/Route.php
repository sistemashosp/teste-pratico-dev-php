<?php

class Route {

    private $controller = 'Home';
    private $method = 'index';
    private $params = [];

    public function __construct() {
        $url = $this->url() ? $this->url() : [0];

        //Verificando se o controllador existe. Se não existir, utilizar o controlador padrão
        if(file_exists('../app/Controllers/'.ucwords($url[0]).'.php')){
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/Controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        //Validações do método
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //Validação de parâmetros 
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function url(){
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        if(isset($url)){
            $url = trim(rtrim($url,'/'));
            $url = explode('/', $url);
            return $url;
        }
    }
}
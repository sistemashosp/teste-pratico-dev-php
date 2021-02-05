<?php

class Sangue{
    private $id;
    private $descricao;
    
    public function getId(){
        return $this->id;
    }

    public function setId($i){
        $this->id = trim($i);
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($d){
        $this->descricao = $d;
    }

}

interface SangueDAO{
    
    public function findById($id);
    
}

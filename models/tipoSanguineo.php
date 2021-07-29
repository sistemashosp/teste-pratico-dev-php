<?php

class TipoSanguineo {

    private $id_tipo_sanguineo;
    protected $descricao_tipo_sanguineo;

    public function getTipoSanguineo (){
        return $this -> id_tipo_sanguineo;
    }

    public function setTipoSanguineo (){
        return $this -> id_tipo_sanguineo;
    }

    public function getDescricaoTipoSanguineo (){
        return $this -> descricao_tipo_sanguineo;
    }

    public function setDescricaoTipoSanguineo (){
        return $this -> id_tipo_sanguineo;
    }

    function TipoSanguineo (){
        $this -> sangueDoPaciente ();
    }

    private function sangueDoPaciente (){

        $this -> id_tipo_sanguineo = "";
        $this -> descricao_tipo_sanguineo = "";
    }
    

}

?>
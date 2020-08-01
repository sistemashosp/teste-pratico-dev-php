<?php

require_once "TipoSanguineoDAO.php";

class TipoSanguineo extends TipoSanguineoDAO
{
    protected $id;
    protected $descricao;
    public static $tiposSanguineos;

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function buscarTipoSanguineo()
    {
        $this->buscarTipoSanguineoLocal();
        $this->buscarTipoSanguineoNoBanco();
        return self::$tiposSanguineos;
    }

    private function buscarTipoSanguineoLocal()
    {
        $tipoSanguineoId = array_search($this->descricao, self::$tiposSanguineos);

        if ($tipoSanguineoId)
        {
            $this->id = $tipoSanguineoId;
        }
    }

    private function buscarTipoSanguineoNoBanco()
    {
        if ($this->id == null)
        {
            $tipoSanguineo = $this->buscarPorDescricao();
    
            if ($tipoSanguineo)
            {
                $this->id = $tipoSanguineo->id;
            } else {
                $tipoSanguineoId = $this->cadastrar();
                self::$tiposSanguineos[$tipoSanguineoId] = $this->descricao;
                $this->id = $tipoSanguineoId;
            }
        }
    }
}
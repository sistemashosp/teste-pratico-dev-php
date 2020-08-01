<?php

class LimparTable 
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::get();
    }

    public function iniciar()
    {
        $this->limparTablePacientes();
        $this->limparTiposSanguineos();
    }

    protected function limparTablePacientes()
    {
        $sql = "DELETE FROM paciente";
        $this->conexao->query($sql);
    }

    protected function limparTiposSanguineos()
    {
        $sql = "DELETE FROM tipo_sanguineo";
        $this->conexao->query($sql);
    }
}
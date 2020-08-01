<?php

class TipoSanguineoDAO
{
    public function buscarPorId()
    {
        $sql = "SELECT id, descrico FROM tipo_sanguineo where id = :id";
        $conexao = Conexao::get();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorDescricao()
    {
        $sql = "SELECT id, descricao FROM tipo_sanguineo where descricao = :descricao";
        $conexao = Conexao::get();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":descricao", $this->descricao);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrar()
    {
        $sql = "INSERT into tipo_sanguineo (descricao) VALUES (:descricao)";
        $conexao = Conexao::get();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":descricao", $this->descricao);
        $stmt->execute();
        return $conexao->lastInsertId();
    }
}
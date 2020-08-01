<?php

class PacienteDAO
{
    public function cadastrar()
    {
        $sql = "INSERT into paciente (nome, sobrenome, email, data_nascimento, genero, id_tipo_sanguineo, endereco, 
            cidade, estado, cep, cpf) VALUES (:nome, :sobrenome, :email, :data_nascimento, :genero,
            :id_tipo_sanguineo, :endereco, :cidade, :estado, :cep, :cpf)";
        $conexao = Conexao::get();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":sobrenome", $this->sobrenome);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":data_nascimento", $this->nascimento);
        $stmt->bindValue(":genero", $this->genero);
        $stmt->bindValue(":id_tipo_sanguineo", $this->tipoSanguineo->getId());
        $stmt->bindValue(":endereco", $this->endereco);
        $stmt->bindValue(":cidade", $this->cidade);
        $stmt->bindValue(":estado", $this->estado);
        $stmt->bindValue(":cep", $this->cep);
        $stmt->bindValue(":cpf", $this->cpf);
        $stmt->execute();
    }

    public function listar($page)
    {
        $limite = 10;
        $offset = ($page - 1) * $limite;

        $sql = "SELECT p.id, p.nome, p.sobrenome, p.cpf, p.email, p.data_nascimento, p.genero, p.endereco, p.cidade, p.estado,
            p.id_tipo_sanguineo, p.cep, ts.descricao as tipo_sanguineo from paciente as p
            INNER JOIN tipo_sanguineo as ts on ts.id = p.id_tipo_sanguineo
            limit {$limite} 
            OFFSET {$offset}";
        $conexao = Conexao::get();
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
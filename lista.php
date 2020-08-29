<?php echo  require_once 'cadastra.php';

$dados = new Dados();

$select = new Select();

echo 'Nome ($select->$nome)';
echo 'sobrenome ($select->$sobrenome)';
echo 'cpf ($select->$cpf)';
echo 'email ($select->$email)';
echo 'nascimento ($select->$nascimento)';
echo 'genero ($select->$genero)';
echo 'endereco ($select->$endereco)';
echo 'cidade ($select->$cidade)';
echo 'estado ($select->$estado)';
echo 'cep ($select->$cep)';
echo 'descricao ($select->$descricao)';
}; ?>
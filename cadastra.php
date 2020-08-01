<?php

/**
 * A execução do PHP foi setada para 0 devido não sabermos o tempo de execução do arquivo CSV;
 * O ideal é criar uma tabela no banco que recebe a importação do arquivo e coloca em uma fila tratado por algum script agendado no cron;
 * Outra possibilidade é criar query strings para realizar somente um insert;
 * Optei em realizar o loop diretamente no arquivo CSV devido o tempo do teste;
 */

set_time_limit(0);

require_once "global.php";

try {
    // Limpa as tabelas
    $limparTable = new LimparTable();
    $limparTable->iniciar();

    // Inicia as variáveis
    TipoSanguineo::$tiposSanguineos = [];
    $pularPrimeiraLinha = true;
    $arquivo = fopen('pacientes.csv', 'r');

    // Realiza a iteração dos pacientes no arquivo CSV
    while (($data = fgetcsv($arquivo)) !== FALSE)
    {
        // Pula o cabeçalho do CSV
        if ($pularPrimeiraLinha)
        {
            $pularPrimeiraLinha = false;
            continue;
        }

        // Cadastra o paciente
        $paciente = new Paciente();
        $paciente->setNome(utf8_encode($data[0]));
        $paciente->setSobrenome(utf8_encode($data[1]));
        $paciente->setEmail(utf8_encode($data[2]));
        $paciente->setNascimento(utf8_encode($data[3]));
        $paciente->setGenero(utf8_encode($data[4]));
        $paciente->setEndereco(utf8_encode($data[6]));
        $paciente->setCidade(utf8_encode($data[7]));
        $paciente->setEstado(utf8_encode($data[8]));
        $paciente->setCep(utf8_encode($data[9]));
        $paciente->setCpf(utf8_encode($data[10]));

        $descricaoTipoSanguineo = utf8_encode($data[5]);
        $paciente->getTipoSanguineo()->setDescricao($descricaoTipoSanguineo);
        $paciente->getTipoSanguineo()->buscarTipoSanguineo();

        $paciente->cadastrar();
    }
} catch (Exception $e) {
    Erro::trataErro($e);
}


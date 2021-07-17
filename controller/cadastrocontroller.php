<?php

  require_once '../service/my_service.php';

  class CadastroController {

    public function novoPaciente() {

      $fileName = $_FILES['file']['tmp_name'];
      fopen($fileName, "r");

      $m = new MyService();
      while(($column = fgetcsv($fileName, 10000, ",")) !== FALSE) {
        $nome = $column[0];
        $sobrenome = $column[1];
        $email = $column[2];
        $datanascimento = $column[3];
        $genero = $column[4];
        $tipoSanguineo = $column[5];
        $endereco = $column[6];
        $cidade = $column[7];
        $estado = $column[8];
        $cep = $column[9];
        $cpf = $column[10];
        $idTipoSanguineo = $column[11];

        $m->criarTipoSanguineo($idTipoSanguineo, $tipoSanguineo);
        $m->criarPaciente($nome, $sobrenome, $cpf, $datanascimento, $genero, $tipoSanguineo, $endereco, $cidade, $estado, $cep, $idTipoSanguineo);

        header('Location: ../view/paciente/lista.php');
      }
      
      fclose($file);
    }
  }
  $tipo = new CadastroController();
  $tipo->novoPaciente(); 

?>
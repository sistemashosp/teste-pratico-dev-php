<?php
require __DIR__ . '/vendor/autoload.php';

use \Source\Models\Upload;

if (isset($_FILES['arquivo'])){
    $nome = $_FILES['arquivo']['name'];
    $ext = explode(".", $nome);
    $extensao = end($ext);
    if ($extensao != "csv"){
        die("extensão inválida");
    }

    $obUpload = new Upload($_FILES['arquivo']);
    $sucesso = $obUpload->upload(__DIR__ . '/source/files');
    if ($sucesso){
        echo 'Arquivo enviado com sucesso';
        exit;
    }
    die('Problemas ao enviar o arquivo');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cadastrar Pacientes</title>
</head>

<body>
<?php include_once('./source/views/header.php') ?>
<div class="container">
    <?php include_once('./source/views/form.php') ?>
</div>

</body>

</html>

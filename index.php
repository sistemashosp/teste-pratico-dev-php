<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Teste SHOSP</title>
        <meta name="csrf_tkn" content="<?php echo criarToken() ?>" />
        <link rel='stylesheet' type='text/css' href='style.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="blur"></div>
        <div class="sucesso" >
            <p style="color: green">Arquivo carregado com sucuesso!</p><br>
            <div class="btn-enviar" onclick="window.location = '/teste-pratico-dev-php/lista.php';">Ver lista</div>
        </div>
        <hr>
            <div id="errs" class="errcontainer"></div>
        <hr>
        <form id="arquivoCSV" method="POST">
        <div class="container">
            <input type="file" name="fileCSV" /><br>
            <div onclick="enviarFile()" class="btn-enviar">Enviar</div>
        </div>
        </form>
        <script src="js.js"></script>
    </body>
</html>
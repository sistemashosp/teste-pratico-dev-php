<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../../resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js" type="text/javascript"></script>
    <title>Teste</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>sobrenome</th>
                    <th>CPF</th>
                    <th>e-mail</th>
                    <th>data de nascimento</th>
                    <th>gênero</th>
                    <th>endereço</th>
                    <th>cidade</th>
                    <th>estado</th>
                    <th>CEP</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once '../../service/my_service.php';
                    $s = new MyService();
                    $result = $s->listaPacientes();
                ?>
                <?php foreach($result as $line) { ?>
                    <tr>
                        <th> <?php echo $line['id']; ?> </th>
                        <th> <?php echo $line['nome']; ?> </th>
                        <th> <?php echo $line['sobrenome']; ?> </th>
                        <th> <?php echo $line['cpf']; ?> </th>
                        <th> <?php echo $line['email']; ?> </th>
                        <th> <?php echo $line['datanascimento']; ?> </th>
                        <th> <?php echo $line['genero']; ?> </th>
                        <th> <?php echo $line['endereco']; ?> </th>
                        <th> <?php echo $line['cidade']; ?> </th>
                        <th> <?php echo $line['estado']; ?> </th>
                        <th> <?php echo $line['cep']; ?> </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="btn-group">
            <div class="border">
                <button class="btn btn-danger raised" onClick="JavaScript: window.history.back();">Voltar</button>
            </div>
        </div>
    </div>
</body>
</html>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../../resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js" type="text/javascript"></script>
    <title>Formulário</title>
</head>
<body>
    <div class="container">
        <div class="card border">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="../../controller/cadastrocontroller.php">
                    <div class="form-group">
                        <label>File:</label>
                        <input class="form-control" type="file" placeholder="arquivo CSV" name="file" accept=".csv">
                    </div>

                    <div class="btn-group">
                        <div class="border">
                            <button class="btn btn-primary raised" type="submit" name="sub">enviar</button>
                        </div>   
                        <div class="border">
                            <a class="btn btn-danger raised" onClick="JavaScript: window.history.back();">Voltar</a>
                        </div>                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
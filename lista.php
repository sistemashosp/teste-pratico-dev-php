<?php
header('Content-Type: text/html; charset=latin1');
require __DIR__.'/vendor/autoload.php';
use Source\Models\Paciente;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cadastrar Pacientes</title>
</head>

<body>
<?php include_once('./source/views/header.php') ?>
<div class="container">
    <table id="lista" class="table table-sm table-responsive-md display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Tipo Sang.</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Cpf</th>
            <th>Email</th>
            <th>Data Nasc.</th>
            <th>Genero</th>
            <th>Endereco</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Cep</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $count = Paciente::all()->count();
                echo "Registros: ".'<span class="badge rounded-pill bg-danger">'.$count.'</span>';
                $lista = Paciente::chunk(500, function ($pacientes){
                    foreach ($pacientes as $l){
                        echo '<tr>';
                        echo '<td>'.$l->tipoSanguineoID->descricao.'</td>';
                        echo '<td>'.$l->nome.'</td>';
                        echo '<td>'.$l->sobrenome.'</td>';
                        echo '<td>'.$l->cpf.'</td>';
                        echo '<td>'.$l->email.'</td>';
                        echo '<td>'.$l->getDataNascimento().'</td>';
                        echo '<td>'.$l->genero.'</td>';
                        echo '<td>'.$l->endereco.'</td>';
                        echo '<td>'.$l->cidade.'</td>';
                        echo '<td>'.$l->estado.'</td>';
                        echo '<td>'.$l->cep.'</td>';
                        echo '</tr>';
                    }
                });



            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#lista').DataTable( {

        } );
    });
</script>

</body>

</html>

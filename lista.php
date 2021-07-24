<?php 
    require_once 'config.php';

    $con = conexao();

    $resultado = sqlSelect($con, "select * from paciente LEFT JOIN tipo_sanguineo ON id_tipo_sanguineo = tipo_sanguineo.id");
    if($resultado && $resultado->num_rows === 0){
        $error[] = 1;
        $resultado->free_result();
    }else{
        while($var = $resultado->fetch_assoc()){
            $res[] = $var;
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Teste SHOSP</title>
        <meta name="csrf_tkn" content="<?php echo criarToken() ?>" />
    </head>
    <body>

        <div style=" box-shadow: 2px 2px 2px 2px black; border-radius: 5px; display: inline-block">
        <table>
            <thead>
                <tr id="tituloTabela">
                    <th>NOME</th>
                    <th>SOBRENOME</th>
                    <th>EMAIL</th>
                    <th>DATA NASCIMENTO</th>
                    <th>GENERO</th>
                    <th>TIPO SANGUINEO</th>
                    <th>ENDEREÇO</th>
                    <th>CIDADE</th>
                    <th>ESTADO</th>
                    <th>CEP</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody style="text-align: center">
                <?php
                    foreach($res as $conteudo){
                        $data = date( 'm/d/Y', strtotime( $conteudo['data_nascimento']));
                        $exibir = <<< EXIBIR
                        <tr>
                            <td> {$conteudo['nome']}</td>
                            <td> {$conteudo['sobrenome']}</td>
                            <td> {$conteudo['email']}</td>
                            <td> $data</td>
                            <td> {$conteudo['genero']}</td>
                            <td> {$conteudo['descricao']}</td>
                            <td> {$conteudo['endereco']}</td>
                            <td> {$conteudo['cidade']}</td>
                            <td> {$conteudo['estado']}</td>
                            <td> {$conteudo['cep']}</td>						
                            <td> {$conteudo['cpf']}</td>
                        </tr>
                    EXIBIR;
                    echo $exibir;
                    }
                ?>
            </tbody>
        </table>
        </div>
        <script src="js.js"></script>
    </body>
</html>
<?php
    //Adicionando o atributo da quantidade de páginas localizado apenas no index 0;
    $totalPages = $data[0]->totalPages;
?>

<html>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Sobrenome</th>
        <th scope="col">CPF</th>
        <th scope="col">Email</th>
        <th scope="col">Data de Nascimento</th>
        <th scope="col">Genero</th>
        <th scope="col">Tipo Sanguíneo</th>
        <th scope="col">Endereço</th>
        <th scope="col">Cidade</th>
        <th scope="col">Estado</th>
        <th scope="col">CEP</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $patient) {?>
        <tr>
        <th scope="row"><?=$patient->id?></th>
        <td><?=$patient->nome?></td>
        <td><?=$patient->sobrenome?></td>
        <td><?=$patient->cpf?></td>
        <td><?=$patient->email?></td>
        <td><?=$patient->data_nascimento?></td>
        <td><?=$patient->genero?></td>
        <td><?=$patient->tipo_sanguineo?></td>
        <td><?=$patient->endereco?></td>
        <td><?=$patient->cidade?></td>
        <td><?=$patient->estado?></td>
        <td><?=$patient->cep?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <div class = "form-control">
        <label for="page">Selecione a página</label>
        <select id="paginate" onchange="paginate()">
            <?php for ($i = 1; $i <= $totalPages; $i++) {?>
            <option value="<?=$i?>"><?=$i?>
            <?php } ?>
        </select>
    </div>
</html>

<script>
    function paginate() {
        var page = document.getElementById("paginate").value;
        var ref = window.location.href;
        var splited_ref = ref.split("/");
        window.location.replace(splited_ref[0] + '/' + splited_ref[1] + '/' + splited_ref[2] + '/' + splited_ref[3] + '/' + splited_ref[4] + '/' + splited_ref[5] + '/' + page);
    }
</script>
<html>
    <div class="alert alert-success" role="alert">
        Insira no campo abaixo o arquivo pacientes.csv. 
    </div>
    <div class = "form-control">
        <form enctype="multipart/form-data" action="<?=URL?>/Cadastrar/pushCsv" method = "POST">
            <input name = "csv" type="file" required>
            <button type="submit" class="btn btn-success">Enviar arquivo CSV</button>
        </form>
    </div>
</html>
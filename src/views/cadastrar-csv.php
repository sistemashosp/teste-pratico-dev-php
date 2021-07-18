<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Cadastrar Pacientes</h3>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <label style="font-size: 15px;">Enviar arquivo CSV</label>
                <input type="file" accept=".csv" name="csv" class="form-control" />
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar do CSV local ou remoto</button>
            </div>
        </form>
    </div>
</div>
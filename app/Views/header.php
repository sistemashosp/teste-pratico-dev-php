<html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Teste Prático PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=URL?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=URL?>Cadastrar/insertView">Inserir CSV</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=URL?>Listar/getPatients/1">Visualizar CSV</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</html>
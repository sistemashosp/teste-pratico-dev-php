<?php
require_once(dirname(__FILE__) . '/../database/dao/PacienteDAO.php');
$pacienteDao = new PacienteDAO();
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    $pacientes = $pacienteDao->getAllPacientes($_GET['page']);
} else {
    $page = 1;
    $pacientes = $pacienteDao->getAllPacientes();
}
$totalPages = $pacientes['totalPages'];
$prevPage = $pacientes['prevPage'];
$nextPage = $pacientes['nextPage'];
$pageFrom = $pacientes['pageFrom'];
$pageTo = $pacientes['pageTo'];
$page = $pacientes['page'];
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Pacientes</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
                            <th>Gênero</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>CEP</th>
                            <th>Tipo Sanguíneo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientes['pacientes'] as $paciente) : ?>
                            <tr>
                                <td><?= $paciente['nome']; ?></td>
                                <td><?= $paciente['sobrenome']; ?></td>
                                <td><?= $paciente['cpf']; ?></td>
                                <td><?= $paciente['email']; ?></td>
                                <td><?= $paciente['data_nascimento']; ?></td>
                                <td><?= $paciente['genero']; ?></td>
                                <td><?= $paciente['endereco']; ?></td>
                                <td><?= $paciente['cidade']; ?></td>
                                <td><?= $paciente['estado']; ?></td>
                                <td><?= $paciente['cep']; ?></td>
                                <td><?= $paciente['tipo_sanguineo']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example mt-5">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($totalPages > 0) {
                        if ($prevPage > 0) {
                            echo '<li class="page-item">
                                <a class="page-link" href="?page=' . $prevPage . '">Anterior</a>
                              </li>';
                        }
                        if ($nextPage > 0) {
                            echo '<li class="page-item">
                                <a class="page-link" href="?page=' . $nextPage . '">Próxima</a>
                              </li>';
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

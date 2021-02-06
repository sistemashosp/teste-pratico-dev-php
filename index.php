<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <title>App - Shops</title>

    <style type="text/css">
        body {
            background-color: #E3E3E3E3;
        }

        .fade-enter-active,
        .fade-leave-active {
            transition: opacity 1.5s;
        }

        .fade-enter,
        .fade-leave-to

        /* .fade-leave-active em versões anteriores a 2.1.8 */
            {
            opacity: 0;
        }
    </style>
</head>

<body>

    <div id="app">
        <transition name="fade">
            <div class="container-fluid text-center" style="margin-top:80px;" v-show="dados.length <= 0">
                <button @click="register" class="btn btn-sm btn-primary" v-if="!loading">
                    <i class="fas fa-check-double"></i> Comece agora
                </button>
                <small class="d-block mt-3" v-if="!loading">Uma coisa incrível está para acontecer...</small>
            </div>
        </transition>

        <transition name="fade">
            <div class="container-fluid text-center mt-5" v-show="loading">
                <div class="row">
                    <div class="col-12">
                        <small class="text-secondary">
                            Calma, só mais um minutinho...
                        </small>
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <img src="./assets/images/icon.svg" width="280" alt="Icon Cante uma musica">
                        <h2 class="mt-4">Enquanto isso, cante uma música...</h2>

                        <div class="spinner-grow mt-5" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

        <transition name="fade">
            <div class="container-fluid mt-5" v-if="dados.length > 0">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <b>Listagem de Pacientes</b>
                            <button @click="register" class="btn btn-sm btn-warning" v-if="!loading">
                                <i class="fas fa-check-double"></i> Refazer
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Sobrenome</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Data Nascimento</th>
                                            <th scope="col">Gênero</th>
                                            <th scope="col">Tipo Sanguineo</th>
                                            <th scope="col">Endereço</th>
                                            <th scope="col">Cidade</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">CEP</th>
                                            <th scope="col">CPF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(dado, index) in dados" :key="index">
                                            <th scope="row"># {{ index +1 }}</th>
                                            <td>{{ dado.nome }}</td>
                                            <td>{{ dado.sobrenome }}</td>
                                            <td>{{ dado.email }}</td>
                                            <td>{{ dado.data_nascimento }}</td>
                                            <td>{{ dado.genero }}</td>
                                            <td>{{ dado.descricao }}</td>
                                            <td>{{ dado.endereco }}</td>
                                            <td>{{ dado.cidade }}</td>
                                            <td>{{ dado.estado }}</td>
                                            <td>{{ dado.cep }}</td>
                                            <td>{{ dado.cpf }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small>Registros {{ dados.length }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="./assets/app.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>





</body>

</html>
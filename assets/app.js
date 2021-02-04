var app = new Vue({
    el: '#app',
    data: {
        loading: false,
        dados: [],
        frase: 'Enquanto isso, cante uma música...',
    },

    methods: {

        register() {
            this.loading = true;
            this.dados = [];
            fetch('cadastra.php').then(() => {
                this.get();
            }).then(() => {
                this.dataTable();
                this.loading = false;
            });
        },

        get() {
            fetch('listar.php').then(res => {
                res.json().then(data => {
                    this.dados = data.data;
                }).then( () => {
                    this.dataTable();
                } )
            })
        },

        dataTable() {
            $('#dataTable').dataTable({
                "iDisplayLength": 30,
                "ordering": false,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ Registros por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                }
            });
        }

    }
});
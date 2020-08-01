const tbody = document.getElementsByTagName('tbody')[0];
const table = document.getElementsByTagName('table')[0];
const carregando = document.getElementById('carregando');
const semPacientes = document.getElementById('semPacientes');
const erro = document.getElementById('erro');
const paginacao = document.getElementById('paginacao');
const numPage = document.getElementById('numPage');
const proximo = document.getElementById('proximo');
const anterior = document.getElementById('anterior');
let page = 1;

const listarPacientes = async () => {
    try {
        console.log(page)
        const res = await axios.get(`http://127.0.0.1/teste-pratico-dev-php/listar-pacientes.php?page=${page}`);
        carregando.classList.add('d-none');
        return res.data;
    } catch (err) {
        carregando.classList.add('d-none');
        erro.classList.remove('d-none');
    }
}

const createTr = (pacientes) => {
    if (Array.isArray(pacientes) && pacientes.length > 0) {
        pacientes.map((paciente) => {
            const tr = document.createElement('tr');
            tr.setAttribute('id', paciente.id);

            const nomeTd = document.createElement('td');
            const sobrenomeTd = document.createElement('td');
            const emailTd = document.createElement('td');
            const nascimentoTd = document.createElement('td');
            const generoTd = document.createElement('td');
            const tipoSanguineoTd = document.createElement('td');
            const enderecoTd = document.createElement('td');
            const cidadeTd = document.createElement('td');
            const estadoTd = document.createElement('td');
            const cepTd = document.createElement('td');
            const cpfTd = document.createElement('td');

            nomeTd.textContent = paciente.nome;
            sobrenomeTd.textContent = paciente.sobrenome;
            emailTd.textContent = paciente.email;
            nascimentoTd.textContent = formatarDate(paciente.data_nascimento);
            generoTd.textContent = paciente.genero;
            tipoSanguineoTd.textContent = paciente.tipo_sanguineo;
            enderecoTd.textContent = paciente.endereco;
            cidadeTd.textContent = paciente.cidade;
            estadoTd.textContent = paciente.estado;
            cepTd.textContent = paciente.cep;
            cpfTd.textContent = paciente.cpf;

            tr.appendChild(nomeTd);
            tr.appendChild(sobrenomeTd);
            tr.appendChild(emailTd);
            tr.appendChild(nascimentoTd);
            tr.appendChild(generoTd);
            tr.appendChild(tipoSanguineoTd);
            tr.appendChild(enderecoTd);
            tr.appendChild(cidadeTd);
            tr.appendChild(estadoTd);
            tr.appendChild(cepTd);
            tr.appendChild(cpfTd);

            tbody.appendChild(tr);
        });
    }
};

const formatarDate = (dataNascimento) => {
    let date = new Date(dataNascimento);
    let month = parseInt(date.getMonth(), 10) + 1;
    let dateStr = date.getDate() + "/" + month + "/" + date.getFullYear();
    return dateStr;
}

const exibirTable = () => {
    const trs = document.querySelectorAll('table tbody tr');
    
    if (trs.length == 0)
    {
        table.classList.add('d-none');
        paginacao.classList.add('d-none');
        semPacientes.classList.remove('d-none');
    } else {
        semPacientes.classList.add('d-none');
        table.classList.remove('d-none');
        paginacao.classList.remove('d-none');
    }
};

const incrementar = () => {
    page += 1; 
    numPage.textContent = page;
}

const decrementar = () => {
    if (page > 1) {
        page -= 1; 
    }
    numPage.textContent = page;
}

proximo.addEventListener('click', (event) => {
    event.preventDefault();
    tbody.innerHTML = "";
    table.classList.add('d-none');
    paginacao.classList.add('d-none');
    carregando.classList.remove('d-none');
    main();
});

anterior.addEventListener('click', (event) => {
    event.preventDefault();
    tbody.innerHTML = "";
    table.classList.add('d-none');
    paginacao.classList.add('d-none');
    carregando.classList.remove('d-none');
    main();
});

const main = async () => {
    numPage.textContent = page;
    const pacientes = await listarPacientes();

    if (Array.isArray(pacientes)) {
        createTr(pacientes);
        exibirTable();
    }
};

main();
create table pacientes (
    id serial primary key,
    nome varchar(255) not null,
    sobrenome varchar(255) not null,
    email varchar(255),
    data_nascimento varchar(255),
    genero varchar(255) not null,
    tipo_sanguineo_id integer not null,
    endereco varchar(255),
    cidade varchar(255),
    estado varchar(255),
    cep varchar(255),
    cpf varchar(255),
    plano_de_saude varchar(255),
);

create table tipo_sanguineo (
    id serial primary key,
    descricao varchar(255) not null,
);

alter table pacientes add constraint fk_paciente_tipo_sanguineo foreign key (tipo_sanguineo_id) references tipo_sanguineo (id);
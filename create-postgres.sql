
CREATE TABLE public.tipo_sanguineo (
    id serial NOT NULL,
    descricao text NOT NULL
)
WITH (oids = false);
--
-- Structure for table paciente (OID = 1185375) :
--
CREATE TABLE public.paciente (
    id serial NOT NULL,
    nome varchar(50) NOT NULL,
    sobrenome varchar(50) NOT NULL,
    cpf varchar(11),
    email varchar(150),
    data_nascimento date,
    genero varchar(1),
    id_tipo_sanguineo integer NOT NULL,
    endereco varchar(200),
    cidade varchar(50),
    estado char(2),
    cep varchar(9)
)
WITH (oids = false);
--
-- Definition for index tipoSanguineo_pkey (OID = 1185371) :
--
ALTER TABLE ONLY tipo_sanguineo
    ADD CONSTRAINT "tipoSanguineo_pkey"
    PRIMARY KEY (id);
--
-- Definition for index paciente_pkey (OID = 1185382) :
--
ALTER TABLE ONLY paciente
    ADD CONSTRAINT paciente_pkey
    PRIMARY KEY (id);
--
-- Definition for index paciente_tiposanguineo_fk (OID = 1185384) :
--
ALTER TABLE ONLY paciente
    ADD CONSTRAINT paciente_tiposanguineo_fk
    FOREIGN KEY (id_tipo_sanguineo) REFERENCES tipo_sanguineo(id) ON UPDATE CASCADE ON DELETE SET NULL;

INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'A+');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'A-');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'B+');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'B-');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'O+');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'O-');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'AB+');
INSERT INTO tipo_sanguineo(id, descricao) VALUES (NEXTVAL('tipo_sanguineo_id_seq'), 'AB-');




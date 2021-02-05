<?php
  
  require_once('conexion.php');
    
        $query = "
            create table tb_tipoSanguineo(
                id int not null primary key auto_increment, 
                descricao varchar(255) not null);

                INSERT INTO `tb_tiposanguineo` (`id`, `descricao`) VALUES (NULL, 'A+'), (NULL, 'A-'),(NULL, 'B+'),(NULL, 'B-'),(NULL, 'AB+'),(NULL, 'AB-'),(NULL, 'O+'),(NULL, 'O-');

            create table 
            tb_pacientes(
                id int not null primary key auto_increment, 
                nome varchar(50) not null, 
                sobrenome varchar(50), 
                cpf int(11) NOT NULL,
                email varchar(100) NOT NULL, 
                dataNascimento date NOT NULL, 
                genero varchar(50), 
                id_tipoSanguineo int,
                CONSTRAINT FK_idTipoSanguineo FOREIGN KEY (id_tipoSanguineo)
                REFERENCES tb_tipoSanguineo(id),
                endereco varchar(100), 
                cidade varchar(100), 
                estado varchar(100), 
                cep varchar(100)
                );
                
        ";


        $conn->exec($query);
            
 
?>
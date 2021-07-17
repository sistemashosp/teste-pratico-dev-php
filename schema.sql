-- --------------------------------------------------------
--
-- Estrutura para tabela `Tipo Sanguíneo`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(3) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estrutura para tabela `Pacientes`
--
CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `datanascimento` varchar(10) NOT NULL,
  `genero` enum('F', 'M') NOT NULL,
  `tipoSanguineo` varchar(3) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `idTipoSanguineo` int(11) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (idTipoSanguineo) REFERENCES tipos(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
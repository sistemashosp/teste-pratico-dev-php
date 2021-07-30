-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.19-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para shop
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `shop`;

-- Copiando estrutura para tabela shop.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `CPF` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `genero` enum('M','F') DEFAULT NULL,
  `idTipoSanguineo` int(11) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1901 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela shop.paciente: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` (`id`, `nome`, `sobrenome`, `CPF`, `email`, `dataNascimento`, `genero`, `idTipoSanguineo`, `endereco`, `cidade`, `estado`, `CEP`) VALUES
	(1898, 'roger', 'neves', '967.356.440-00', 'rg@123.com', '1988-12-21', 'M', 405, 'Ender', 'RJ', 'Estado', 'cep'),
	(1899, 'roger', 'neves', '967.356.440-00', 'rg@123.com', '1988-12-21', 'M', 405, 'Ender', 'RJ', 'Estado', 'cep'),
	(1900, 'roger', 'neves', '967.356.440-00', 'rg@123.com', '1988-12-21', 'M', 407, 'Ender', 'RJ', 'Estado', 'cep');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;

-- Copiando estrutura para tabela shop.tiposanguineo
CREATE TABLE IF NOT EXISTS `tiposanguineo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela shop.tiposanguineo: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tiposanguineo` DISABLE KEYS */;
INSERT INTO `tiposanguineo` (`id`, `descricao`) VALUES
	(405, '+A'),
	(406, '+B'),
	(407, '+C'),
	(408, '+D');
/*!40000 ALTER TABLE `tiposanguineo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

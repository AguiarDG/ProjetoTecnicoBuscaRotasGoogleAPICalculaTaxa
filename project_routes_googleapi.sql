-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para project_routes_googleapi
CREATE DATABASE IF NOT EXISTS `project_routes_googleapi` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `project_routes_googleapi`;

-- Copiando estrutura para tabela project_routes_googleapi.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(256) NOT NULL,
  `tarifa_fixa` float NOT NULL DEFAULT 0,
  `tarifa_quilometro` float NOT NULL DEFAULT 0,
  `tarifa_minuto` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela project_routes_googleapi.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id_categoria`, `categoria`, `tarifa_fixa`, `tarifa_quilometro`, `tarifa_minuto`) VALUES
	(1, 'Categoria 1', 10, 2, 0.6),
	(2, 'Categoria 2', 5, 3.5, 0.03),
	(3, 'Categoria 3', 20, 1, 0.07),
	(4, 'Categoria 4', 6, 7, 0.01);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela project_routes_googleapi.cidades
CREATE TABLE IF NOT EXISTS `cidades` (
  `id_cidade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cidade` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela project_routes_googleapi.cidades: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cidades` DISABLE KEYS */;
REPLACE INTO `cidades` (`id_cidade`, `cidade`) VALUES
	(1, 'Campinas'),
	(2, 'São Paulo'),
	(3, 'Sumaré'),
	(4, 'Americana');
/*!40000 ALTER TABLE `cidades` ENABLE KEYS */;

-- Copiando estrutura para tabela project_routes_googleapi.cidade_has_categoria
CREATE TABLE IF NOT EXISTS `cidade_has_categoria` (
  `id_cidade_has_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cidade` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_cidade_has_categoria`),
  KEY `id_cidade` (`id_cidade`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `FK_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `FK_id_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `cidades` (`id_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela project_routes_googleapi.cidade_has_categoria: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cidade_has_categoria` DISABLE KEYS */;
REPLACE INTO `cidade_has_categoria` (`id_cidade_has_categoria`, `id_cidade`, `id_categoria`) VALUES
	(1, 1, 2),
	(3, 2, 1),
	(4, 3, 1),
	(6, 4, 3),
	(8, 1, 1),
	(9, 2, 2),
	(10, 3, 4);
/*!40000 ALTER TABLE `cidade_has_categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela project_routes_googleapi.historico_calculos
CREATE TABLE IF NOT EXISTS `historico_calculos` (
  `id_historico_calculo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cidade` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `endereco_origem` varchar(256) NOT NULL,
  `endereco_destino` varchar(256) NOT NULL,
  `distancia` varchar(256) NOT NULL,
  `duracao` varchar(256) NOT NULL,
  `valor_tarifa` float NOT NULL,
  `data_historico` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_historico_calculo`),
  KEY `id_cidade` (`id_cidade`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `FK_historico_calculos_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `FK_historico_calculos_id_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `cidades` (`id_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela project_routes_googleapi.historico_calculos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historico_calculos` DISABLE KEYS */;
REPLACE INTO `historico_calculos` (`id_historico_calculo`, `id_cidade`, `id_categoria`, `endereco_origem`, `endereco_destino`, `distancia`, `duracao`, `valor_tarifa`, `data_historico`) VALUES
	(1, 1, 1, '1', '1', '66', '9', 147.4, '2024-06-25 19:09:51'),
	(2, 1, 1, '1', '1', '82', '12', 181.2, '2024-06-25 19:10:09'),
	(3, 1, 1, '1', '1', '92', '42', 219.2, '2024-06-25 19:13:14'),
	(4, 1, 1, '1', '1', '34', '5', 81, '2024-06-25 20:33:28'),
	(5, 1, 1, '1', '1', '91', '5', 195, '2024-06-25 20:40:27'),
	(6, 1, 1, '1', '1', '61', '40', 156, '2024-06-25 20:41:14'),
	(7, 1, 1, '1', '1', '4', '54', 50.4, '2024-06-25 20:42:15'),
	(8, 1, 1, '1', '1', '90', '49', 219.4, '2024-06-25 20:42:28'),
	(9, 1, 1, '1', '1', '41', '13', 99.8, '2024-06-25 20:42:46'),
	(10, 1, 1, '1', '1', '82', '52', 205.2, '2024-06-25 20:43:04'),
	(11, 1, 1, '1', '1', '10', '18', 40.8, '2024-06-25 20:43:33'),
	(12, 1, 1, '1', '1', '44', '37', 120.2, '2024-06-25 20:44:06'),
	(13, 1, 1, '1', '1', '29', '45', 95, '2024-06-25 20:44:11'),
	(14, 1, 1, '1', '1', '70', '36', 171.6, '2024-06-25 20:46:46'),
	(15, 1, 1, '1', '1', '79', '28', 184.8, '2024-06-25 20:46:56'),
	(16, 1, 1, '1', '1', '1', '10', 18, '2024-06-25 20:47:33'),
	(17, 1, 1, '1', '1', '70', '30', 168, '2024-06-25 20:47:47'),
	(18, 1, 1, '1', '1', '77', '29', 181.4, '2024-06-25 20:48:16'),
	(19, 1, 1, '1', '1', '43', '59', 131.4, '2024-06-25 20:48:48'),
	(20, 1, 1, '1', '1', '94', '40', 222, '2024-06-25 20:48:59'),
	(21, 1, 1, '1', '1', '13', '57', 70.2, '2024-06-25 20:50:48'),
	(22, 1, 1, '1', '1', '50', '39', 133.4, '2024-06-25 20:51:49'),
	(23, 1, 1, '1', '1', '72', '29', 171.4, '2024-06-25 20:56:16');
/*!40000 ALTER TABLE `historico_calculos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

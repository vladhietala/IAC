-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2013 at 03:30 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lojavirtual`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `CatCodigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CatNome` varchar(20) NOT NULL,
  PRIMARY KEY (`CatCodigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`CatCodigo`, `CatNome`) VALUES
(1, 'Nokia'),
(2, 'Apple'),
(3, 'Samsung'),
(4, 'Motorola');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CliCodigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Estado_EstCodigo` varchar(2) NOT NULL,
  `Sexo_Sexo` char(1) NOT NULL,
  `CliNome` varchar(50) NOT NULL,
  `CliEndereco` varchar(50) NOT NULL,
  `CliBairro` varchar(20) NOT NULL,
  `CliCidade` varchar(20) NOT NULL,
  `CliFoneRes` varchar(14) NOT NULL,
  `CliFoneCel` varchar(14) DEFAULT NULL,
  `CliCPF` varchar(14) NOT NULL,
  `CliEmail` varchar(50) NOT NULL,
  `CliSenha` varchar(128) NOT NULL,
  `CliCEP` varchar(9) NOT NULL,
  `CliLembrete` varchar(128) NOT NULL,
  `CliAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CliCodigo`),
  KEY `Cliente_FKIndex1` (`Sexo_Sexo`),
  KEY `Cliente_FKIndex2` (`Estado_EstCodigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`CliCodigo`, `Estado_EstCodigo`, `Sexo_Sexo`, `CliNome`, `CliEndereco`, `CliBairro`, `CliCidade`, `CliFoneRes`, `CliFoneCel`, `CliCPF`, `CliEmail`, `CliSenha`, `CliCEP`, `CliLembrete`, `CliAdmin`) VALUES
(1, 'PR', 'M', 'admin', 'xxx', 'xxxxxxxx', 'xxxxx', '2222222222', '2222222233', '12345678912', 'admin@cellnet.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '11111-112', '', 1),
(2, 'PR', 'M', 'fernando', 'rua x', 'bairro x', 'curitiba', '4444444444', '6666666666', '333.333.333-33', 'fernando@fernando.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '88888888', '', 0),
(3, 'PR', 'M', 'teste', 'teste', 'teste', 'teste', '(44)4444-4444', '(44)4444-4444', '999.999.999-99', 'teste@teste.com', 'e10adc3949ba59abbe56e057f20f883e', '54545-454', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `EstCodigo` varchar(2) NOT NULL,
  `EstNome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`codigo`, `EstCodigo`, `EstNome`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AP', 'Amapá'),
(4, 'AM', 'Amazonas'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MT', 'Mato Grosso'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MG', 'Minas Gerais'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PR', 'Paraná'),
(17, 'PE', 'Pernambuco'),
(18, 'PI', 'Piauí'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RS', 'Rio Grande do Sul'),
(22, 'RO', 'Rondônia'),
(23, 'RR', 'Roraima'),
(24, 'SC', 'Santa Catarina'),
(25, 'SP', 'São Paulo'),
(26, 'SE', 'Sergipe'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Table structure for table `itenspedido`
--

CREATE TABLE IF NOT EXISTS `itenspedido` (
  `Produto_ProdCodigo` int(10) unsigned NOT NULL,
  `Pedido_PedNum` int(10) unsigned NOT NULL,
  `Quantidade` int(10) unsigned NOT NULL,
  `ValorUnit` double NOT NULL,
  PRIMARY KEY (`Produto_ProdCodigo`,`Pedido_PedNum`),
  KEY `Produto_has_Pedido_FKIndex1` (`Produto_ProdCodigo`),
  KEY `ItensPedido_FKIndex2` (`Pedido_PedNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itenspedido`
--

INSERT INTO `itenspedido` (`Produto_ProdCodigo`, `Pedido_PedNum`, `Quantidade`, `ValorUnit`) VALUES
(2, 2, 1, 999),
(2, 5, 4, 999),
(4, 1, 1, 1399),
(4, 4, 1, 1399),
(5, 3, 1, 799),
(5, 6, 1, 799);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `PedNum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Cliente_CliCodigo` int(10) unsigned NOT NULL,
  `PedData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PedStatus` char(1) NOT NULL,
  `PedFrete` double DEFAULT NULL,
  PRIMARY KEY (`PedNum`),
  KEY `Pedido_FKIndex1` (`Cliente_CliCodigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`PedNum`, `Cliente_CliCodigo`, `PedData`, `PedStatus`, `PedFrete`) VALUES
(1, 1, '2013-03-23 01:42:41', 'E', 0),
(2, 3, '2013-03-23 01:42:37', 'E', 20),
(3, 3, '2013-03-23 01:42:36', 'E', 20),
(4, 3, '2013-03-23 01:42:36', 'E', 0),
(5, 1, '2013-03-23 01:43:16', 'E', 0),
(6, 2, '2013-03-23 02:30:41', 'E', 20);

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `ProdCodigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Categoria_CatCodigo` int(10) unsigned NOT NULL,
  `ProdNome` varchar(45) NOT NULL,
  `ProdDesc` text,
  `ProdValorVenda` double DEFAULT NULL,
  `ProdQuantidade` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ProdCodigo`),
  KEY `Produto_FKIndex1` (`Categoria_CatCodigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`ProdCodigo`, `Categoria_CatCodigo`, `ProdNome`, `ProdDesc`, `ProdValorVenda`, `ProdQuantidade`) VALUES
(2, 2, 'iPhone 4S', 'Apple iPhone 4S \r\n16GB', 999, 10),
(3, 4, 'Motorola Razor', 'novo Motorola Razor', 899, 10),
(4, 2, 'iPhone 5', 'novo Iphone 5 \r\n16GB', 1399, 10),
(5, 1, 'Nokia Lumia 900', 'Nokia Lumia 900\r\n8GB', 799, 15);

-- --------------------------------------------------------

--
-- Table structure for table `sexo`
--

CREATE TABLE IF NOT EXISTS `sexo` (
  `Sexo` char(1) NOT NULL,
  PRIMARY KEY (`Sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

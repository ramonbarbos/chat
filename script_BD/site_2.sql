-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Abr-2023 às 00:04
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site_2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque`
--

DROP TABLE IF EXISTS `tb_admin.estoque`;
CREATE TABLE IF NOT EXISTS `tb_admin.estoque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `largura` int NOT NULL,
  `altura` int NOT NULL,
  `comprimento` int NOT NULL,
  `peso` int NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_admin.estoque`
--

INSERT INTO `tb_admin.estoque` (`id`, `nome`, `descricao`, `largura`, `altura`, `comprimento`, `peso`, `quantidade`) VALUES
(13, 'Camisa Brasil', 'Camisa do Brasil-Usada', 12, 12, 12, 12, 0),
(14, 'Carro Sport', 'Audi', 12, 12, 12, 12, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque_imagens`
--

DROP TABLE IF EXISTS `tb_admin.estoque_imagens`;
CREATE TABLE IF NOT EXISTS `tb_admin.estoque_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produto_id` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_admin.estoque_imagens`
--

INSERT INTO `tb_admin.estoque_imagens` (`id`, `produto_id`, `imagem`) VALUES
(38, 13, '641f829116237.png'),
(39, 14, '641f9670735a8.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

DROP TABLE IF EXISTS `tb_admin.usuarios`;
CREATE TABLE IF NOT EXISTS `tb_admin.usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cargo` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `capa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `nome`, `sobrenome`, `password`, `cargo`, `img`, `capa`) VALUES
(1, 'admin', 'Administrador', '', 'admin', 2, '63ed44f5c5986.jpg', '640610c815d8b.jpg'),
(39, 'himym', 'How I Met', 'Your Mother', '123', 0, '641a370d212fa.jpg', '641a3718e1b3d.jpeg'),
(40, 'tec', 'Olhos', 'Tech', '123', 0, '641a393a9b327.jpg', '641a392fe062f.jpg'),
(41, 'mark', 'Mark', 'Zuckerberg', '123', 0, '641a3c2e6fa12.png', '641a3cf9cbd37.png'),
(42, 'ramon', 'Ramon', 'Teste', '123', 0, '641a3e9be7570.jpg', '641a3ea284f42.jpg'),
(43, 'mon', 'Ramon', 'Barbosa', '123', 0, '641a4d2b44b9f.jpg', '641a4d342b76c.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

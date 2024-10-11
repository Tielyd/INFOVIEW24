-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Set-2024 às 20:26
-- Versão do servidor: 8.0.26
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infoview`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorioinfoiii`
--

CREATE TABLE `relatorioinfoiii` (
  `idRelatorio` int NOT NULL,
  `bancoDeDados` varchar(300) NOT NULL,
  `filosofia1` varchar(300) NOT NULL,
  `geografia1` varchar(300) NOT NULL,
  `gestaoDeWebSites` varchar(300) NOT NULL,
  `historia` varchar(300) NOT NULL,
  `linguaEspanhola1` varchar(300) NOT NULL,
  `linguaPortuguesa` varchar(300) NOT NULL,
  `matematica3` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `progWeb` varchar(300) NOT NULL,
  `sociologia1` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `relatorioinfoiii`
--
ALTER TABLE `relatorioinfoiii`
  ADD PRIMARY KEY (`idRelatorio`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `relatorioinfoiii`
--
ALTER TABLE `relatorioinfoiii`
  MODIFY `idRelatorio` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

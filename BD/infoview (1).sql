-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2024 às 19:45
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.1.6

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
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int NOT NULL,
  `nomeCurso` varchar(100) NOT NULL,
  `urlCurso` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nomeCurso`, `urlCurso`) VALUES
(1, 'Técnico de Informática para Internet', 'img/informatica.jpg'),
(4, 'Técnico em Jogos Digitais', 'img/Jogos-Digitaisv1.jpg'),
(6, 'Técnico em Automação Industrial', 'img/automacao-industrial.png'),
(21, 'Técnico em Mecânica', 'img/mecanica-2.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int NOT NULL,
  `nomeDisciplina` varchar(100) NOT NULL,
  `idCurso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `nomeDisciplina`, `idCurso`) VALUES
(1, 'Banco de Dados', 1),
(4, 'Matemática 3', 1),
(5, 'História', 1),
(12, 'Português', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `idRelatorio` int NOT NULL,
  `idCurso` int NOT NULL,
  `idDisciplina` int NOT NULL,
  `ano` varchar(50) NOT NULL,
  `semana` int NOT NULL,
  `mes` varchar(122) NOT NULL,
  `dia` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `idUsuario` int NOT NULL,
  `anoCurso` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `relatorio`
--

INSERT INTO `relatorio` (`idRelatorio`, `idCurso`, `idDisciplina`, `ano`, `semana`, `mes`, `dia`, `descricao`, `idUsuario`, `anoCurso`) VALUES
(1, 1, 1, '2024', 1, 'Janeiro', 'segunda', 'Conteúdo: Desenvolvimento do Projeto IFTECH', 1, 1),
(4, 1, 1, '2024', 1, 'Fevereiro', 'quarta', 'Desenvolvimento de Projeto IFTECH', 1, 1),
(7, 1, 4, '2024', 1, 'Fevereiro', 'segunda', 'Em matemática, um polinômio é uma expressão matemática composta por indeterminados e coeficientes, que envolve apenas as operações de adição, subtração, multiplicação e exponenciação para potências inteiras não negativas, e possui um número finito de termos', 1, 1),
(8, 1, 5, '2024', 1, 'Fevereiro', 'segunda', 'Egito Antigo', 1, 1),
(10, 1, 12, '2024', 1, 'Janeiro', 'segunda', 'Um diagrama de banco de dados mostra a estrutura lógica de um banco de dados, incluindo as relações e restrições que determinam como os dados podem ser armazenados e acessados.', 1, 3),
(11, 1, 1, '2024', 1, 'Janeiro', 'terca', 'Desenvolvimento de Projeto IFTECH', 1, 3),
(12, 1, 4, '2024', 1, 'Janeiro', 'quarta', 'Exercícios sobre Polinômios', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL,
  `fotoUsuario` varchar(200) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fotoUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`) VALUES
(1, 'img/190409-lil-nas-x-mn-1310_011f346519297b6bb6e95c5a5856293a.fit-760w-1-e1556652989188_widelg.jpg', 'Eu', 'j@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'img/747f03c43f2e5bf7553547e601843efe.jpg', 'Eu', 'j@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'img/coracao rox.png', 'llllll', 'gsgdgda@nbnblknbknbl', '698d51a19d8a121ce581499d7b701668');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Índices para tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`idRelatorio`),
  ADD KEY `idCurso` (`idCurso`),
  ADD KEY `idDisciplina` (`idDisciplina`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `idRelatorio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD CONSTRAINT `relatorio_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE,
  ADD CONSTRAINT `relatorio_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

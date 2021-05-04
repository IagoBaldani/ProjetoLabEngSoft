-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Maio-2021 às 03:36
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sgac`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigos`
--

CREATE TABLE `artigos` (
  `cod_artigos` smallint(4) NOT NULL,
  `autores` varchar(50) COLLATE utf8_bin NOT NULL,
  `orientador` varchar(50) COLLATE utf8_bin NOT NULL,
  `avaliadores` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `statusartigo` int(11) NOT NULL DEFAULT 0,
  `titulo` varchar(50) COLLATE utf8_bin NOT NULL,
  `curso` int(11) NOT NULL DEFAULT 0,
  `diretorio_artigo` varchar(80) COLLATE utf8_bin NOT NULL,
  `datacadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `artigos`
--

INSERT INTO `artigos` (`cod_artigos`, `autores`, `orientador`, `avaliadores`, `statusartigo`, `titulo`, `curso`, `diretorio_artigo`, `datacadastro`) VALUES
(9, '0210481913009, 0210481913025, 0210481913011', 'Sergio Roberto Delfino', 'Elaine', 1, 'Teste Cadastro Artigo 1', 3, 'c8f16f7a16bd50fe575622e7b726feb7.pdf', '2021-05-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `cod_cursos` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`cod_cursos`, `nome`) VALUES
(1, 'Nenhum'),
(2, 'Agronegócio'),
(3, 'Análise e Desenvolvimento de Sistemas'),
(4, 'Jogos Digitais'),
(5, 'Segurança da Informação'),
(6, 'Ciência de Dados'),
(7, 'Gestão Empresarial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `statusartigo`
--

CREATE TABLE `statusartigo` (
  `cod_status` int(11) NOT NULL,
  `statusartigo` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `statusartigo`
--

INSERT INTO `statusartigo` (`cod_status`, `statusartigo`) VALUES
(1, 'Cadastrado'),
(2, 'Em Avaliação'),
(3, 'Aprovado'),
(4, 'Não Aprovado'),
(5, 'Publicado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE `tipousuario` (
  `cod_tipo` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`cod_tipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Autor (Aluno)'),
(3, 'Avaliador'),
(4, 'Secretaria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` smallint(4) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `matricula` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `tipo` int(11) NOT NULL DEFAULT 0,
  `curso` int(11) NOT NULL,
  `datacadastro` date DEFAULT NULL,
  `diretorio_imagem` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `senha`, `cpf`, `email`, `matricula`, `tipo`, `curso`, `datacadastro`, `diretorio_imagem`) VALUES
(18, 'Admin 1', '5d80253b1cd5e5d4ca5ed539f4d72052', '25444566658', 'admin1@gmail.com', '458854556998', 1, 1, '2021-03-26', '2a8901545ef2347a8dc56c8518649e04.png'),
(27, 'secretaria2', '70873e8580c9900986939611618d7b1e', '1214132455143', 'secretaria2@gmail.com', '13124123124123', 4, 1, '2021-04-06', ''),
(28, 'avaliador1', '70873e8580c9900986939611618d7b1e', '124214134513123', 'avaliador1@gmail.com', '131234214314123', 3, 1, '2021-04-06', 'd753f2bc5d0bbe2f939f0c8121b83f14.png'),
(29, 'admin2', '5d80253b1cd5e5d4ca5ed539f4d72052', '124761278772387', 'admin2@gmail.com', '1827873188738787', 1, 1, '2021-04-06', ''),
(30, 'admin3', '5d80253b1cd5e5d4ca5ed539f4d72052', '123451351231434', 'admin3@gmail.com', '123412321421314', 1, 1, '2021-04-06', ''),
(31, 'admin4', '5d80253b1cd5e5d4ca5ed539f4d72052', '1290138918398938', 'admin4@gmail.com', '912891898198282918', 1, 1, '2021-04-06', ''),
(34, 'teste imagem 2', '70873e8580c9900986939611618d7b1e', '321424142143123', 'testeimagem2@gmail.com', '213412312412313', 4, 1, '2021-04-07', '84a7d8d0858069b5849dd21464c7c06a.jpg'),
(36, 'Elaine', '70873e8580c9900986939611618d7b1e', '73619891623912', 'elaine@gmail.com', '7887378329899', 3, 1, '2021-04-13', 'eecad5996b79de249a68d57f3b2a5175.jpg'),
(37, 'Filipe Antunes', '70873e8580c9900986939611618d7b1e', '856.544.588-55', 'filipeantunes@gmail.com', '0210481913009', 2, 3, '2021-05-03', '51f799c2a8504ecffb190b029cfe73a8.jpg'),
(38, 'Iago Baldani', '70873e8580c9900986939611618d7b1e', '548.885.552-22', 'iagobaldani@gmail.com', '0210481913025', 2, 3, '2021-05-03', 'a466168a0af673480e4fb8fbcd8e79b3.webp'),
(39, 'Igor Santander', '70873e8580c9900986939611618d7b1e', '254.488.885-52', 'igorsantander@gmail.com', '0210481913011', 2, 3, '2021-05-03', '28c5a2909f81dc94c8f5bf5f03fd7324.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artigos`
--
ALTER TABLE `artigos`
  ADD PRIMARY KEY (`cod_artigos`),
  ADD KEY `status` (`statusartigo`) USING BTREE;

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`cod_cursos`);

--
-- Índices para tabela `statusartigo`
--
ALTER TABLE `statusartigo`
  ADD PRIMARY KEY (`cod_status`);

--
-- Índices para tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`cod_tipo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD KEY `tipo` (`tipo`),
  ADD KEY `curso` (`curso`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artigos`
--
ALTER TABLE `artigos`
  MODIFY `cod_artigos` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cod_cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `statusartigo`
--
ALTER TABLE `statusartigo`
  MODIFY `cod_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `cod_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `artigos`
--
ALTER TABLE `artigos`
  ADD CONSTRAINT `fkstatus` FOREIGN KEY (`statusartigo`) REFERENCES `statusartigo` (`cod_status`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkcurso` FOREIGN KEY (`curso`) REFERENCES `cursos` (`cod_cursos`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fktipo` FOREIGN KEY (`tipo`) REFERENCES `tipousuario` (`cod_tipo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

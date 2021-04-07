-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Abr-2021 às 02:54
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
  `autor` varchar(50) COLLATE utf8_bin NOT NULL,
  `orientador` varchar(50) COLLATE utf8_bin NOT NULL,
  `avaliador` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `data` date NOT NULL,
  `titulo` varchar(50) COLLATE utf8_bin NOT NULL,
  `curso` int(11) NOT NULL DEFAULT 0,
  `diretorio_artigo` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `artigos`
--

INSERT INTO `artigos` (`cod_artigos`, `autor`, `orientador`, `avaliador`, `status`, `data`, `titulo`, `curso`, `diretorio_artigo`) VALUES
(1, 'Marcelo Bolfarini', 'Iago Baldani', 'Igor Santander', 1, '2021-03-16', 'Sistema Gerenciador de Artigos Cientificos', 2, ''),
(2, 'Filipe Antunes', 'Gustavo Juliano', 'Marcelo Bolfarini', 2, '2021-03-16', 'Teste do Banco', 3, ''),
(3, 'Iago Baldani', 'Igor Santander', 'Filipe Antunes', 3, '2021-03-16', 'Teste do Banco 2', 5, '');

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
  `status` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `statusartigo`
--

INSERT INTO `statusartigo` (`cod_status`, `status`) VALUES
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
(16, 'Igor Santander', '70873e8580c9900986939611618d7b1e', '333333333', 'igorsantander@gmail.com', '4444444444', 4, 1, '2021-03-25', ''),
(18, 'Admin 1', '5d80253b1cd5e5d4ca5ed539f4d72052', '25444566658', 'admin1@gmail.com', '458854556998', 1, 1, '2021-03-26', ''),
(19, 'Filipe Antunes', 'a567d260dcce27322dc9403161f8ab91', '25444555669', 'filipeantunes@gmail.com', '658554445558', 2, 4, '2021-03-26', ''),
(20, 'Marcelo Bolfarini', '70873e8580c9900986939611618d7b1e', '54589658586', 'marcelobolfarini@gmail.com', '656585658566', 3, 1, '2021-03-26', ''),
(22, 'Gustavo Juliano', '70873e8580c9900986939611618d7b1e', '554445588865', 'gustavojuliano@gmail.com', '55566558877444', 2, 5, '2021-03-27', ''),
(26, 'Iago Baldani', '70873e8580c9900986939611618d7b1e', '545554445556', 'iagobaldani@gmail.com', '66555522211425', 2, 7, '2021-03-29', ''),
(27, 'secretaria2', '70873e8580c9900986939611618d7b1e', '1214132455143', 'secretaria2@gmail.com', '13124123124123', 4, 1, '2021-04-06', ''),
(28, 'avaliador1', '70873e8580c9900986939611618d7b1e', '124214134513123', 'avaliador1@gmail.com', '131234214314123', 3, 1, '2021-04-06', ''),
(29, 'admin2', '5d80253b1cd5e5d4ca5ed539f4d72052', '124761278772387', 'admin2@gmail.com', '1827873188738787', 1, 1, '2021-04-06', ''),
(30, 'admin3', '5d80253b1cd5e5d4ca5ed539f4d72052', '123451351231434', 'admin3@gmail.com', '123412321421314', 1, 1, '2021-04-06', ''),
(31, 'admin4', '5d80253b1cd5e5d4ca5ed539f4d72052', '1290138918398938', 'admin4@gmail.com', '912891898198282918', 1, 1, '2021-04-06', ''),
(32, 'Fulano da Silva', '70873e8580c9900986939611618d7b1e', '12841872878237', 'fulanodasilva@gmail.com', '7187878437187287', 2, 4, '2021-04-06', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artigos`
--
ALTER TABLE `artigos`
  ADD PRIMARY KEY (`cod_artigos`),
  ADD KEY `status` (`status`);

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
  MODIFY `cod_artigos` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cod_cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `cod_usuario` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `artigos`
--
ALTER TABLE `artigos`
  ADD CONSTRAINT `fkstatus` FOREIGN KEY (`status`) REFERENCES `statusartigo` (`cod_status`) ON UPDATE CASCADE;

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

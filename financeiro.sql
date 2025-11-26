-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26/11/2025 às 04:40
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `financmorais`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`) VALUES
(2, 'SUPERAR'),
(3, 'SandroTechs'),
(4, 'NASA'),
(6, 'Bar do João');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pm_entrada`
--

CREATE TABLE `pm_entrada` (
  `id` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dataentrada` date NOT NULL,
  `datadocumento` date NOT NULL,
  `documento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pm_entrada`
--

INSERT INTO `pm_entrada` (`id`, `idpessoa`, `valor`, `dataentrada`, `datadocumento`, `documento`) VALUES
(3, 5, 1000.90, '1111-01-01', '1100-01-01', 'fill'),
(11, 2, 9000.50, '6565-04-05', '1000-01-01', 'fill'),
(12, 8, 10.51, '1111-10-10', '1000-10-10', 'ççll');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pm_fornecedor`
--

CREATE TABLE `pm_fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `observacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pm_fornecedor`
--

INSERT INTO `pm_fornecedor` (`id`, `nome`, `telefone`, `observacao`) VALUES
(1, 'name', '111', 'observacaoss'),
(2, 'JONAS', '55664499', 'Gente boa, mas preço caroooooooooooooooooooooo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pm_pessoa`
--

CREATE TABLE `pm_pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` int(1) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `datanascimento` date NOT NULL,
  `databatizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pm_pessoa`
--

INSERT INTO `pm_pessoa` (`id`, `nome`, `tipo`, `cep`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`, `email`, `telefone`, `complemento`, `datanascimento`, `databatizado`) VALUES
(5, 'PSFIVE', 2, '35030330', 'Rua Marechal Floriano', '175', 'Lourdes', 'Governador Valadares', 'MG', 'ARROBA@GEMAIL.COM', '88035817', 'NUTELLA', '2023-03-30', '2023-04-06'),
(8, 'Xbox360', 1, '35030330', 'Rua Marechal Floriano', '175', 'Lourdes', 'Governador Valadares', 'MG', 'dsajk@gmail.com', '88035817', 'NUTELLA', '1000-01-01', '2121-01-01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pm_saida`
--

CREATE TABLE `pm_saida` (
  `id` int(11) NOT NULL,
  `idfornecedor` int(11) NOT NULL,
  `valorpagar` decimal(10,2) NOT NULL,
  `datapagar` date NOT NULL,
  `observacao` varchar(50) NOT NULL,
  `valorpago` decimal(10,2) NOT NULL,
  `datapago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pm_saida`
--

INSERT INTO `pm_saida` (`id`, `idfornecedor`, `valorpagar`, `datapagar`, `observacao`, `valorpago`, `datapago`) VALUES
(1, 2, 1000.00, '1011-01-01', 'Calotero', 760.01, '1000-10-01'),
(3, 1, 450.00, '2020-01-05', 'Quase pg', 300.00, '2020-01-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `master` varchar(1) NOT NULL,
  `foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `master`, `foto`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 's', 0),
(2, 'Xbox', 'fhg@gmail.com', '123', 'n', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pm_entrada`
--
ALTER TABLE `pm_entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pessoa_entrada` (`idpessoa`);

--
-- Índices de tabela `pm_fornecedor`
--
ALTER TABLE `pm_fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pm_pessoa`
--
ALTER TABLE `pm_pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pm_saida`
--
ALTER TABLE `pm_saida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idfornecedor` (`idfornecedor`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pm_entrada`
--
ALTER TABLE `pm_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pm_fornecedor`
--
ALTER TABLE `pm_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pm_pessoa`
--
ALTER TABLE `pm_pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `pm_saida`
--
ALTER TABLE `pm_saida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pm_saida`
--
ALTER TABLE `pm_saida`
  ADD CONSTRAINT `idfornecedor` FOREIGN KEY (`idfornecedor`) REFERENCES `pm_fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

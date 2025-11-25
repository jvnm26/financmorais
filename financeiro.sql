-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Ago-2023 às 02:16
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ip_entrada`
--

CREATE TABLE `ip_entrada` (
  `id` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dataentrada` date NOT NULL,
  `datadocumento` date NOT NULL,
  `documento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ip_entrada`
--

INSERT INTO `ip_entrada` (`id`, `idpessoa`, `valor`, `dataentrada`, `datadocumento`, `documento`) VALUES
(3, 5, '1000.90', '1111-01-01', '1100-01-01', 'fill'),
(11, 2, '9000.50', '6565-04-05', '1000-01-01', 'fill'),
(12, 8, '10.51', '1111-10-10', '1000-10-10', 'ççll');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ip_fornecedor`
--

CREATE TABLE `ip_fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `observacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ip_fornecedor`
--

INSERT INTO `ip_fornecedor` (`id`, `nome`, `telefone`, `observacao`) VALUES
(1, 'name', '111', 'observacaoss'),
(2, 'JONAS', '55664499', 'Gente boa, mas preço caroooooooooooooooooooooo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ip_pessoa`
--

CREATE TABLE `ip_pessoa` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ip_pessoa`
--

INSERT INTO `ip_pessoa` (`id`, `nome`, `tipo`, `cep`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`, `email`, `telefone`, `complemento`, `datanascimento`, `databatizado`) VALUES
(5, 'PSFIVE', 2, '35030330', 'Rua Marechal Floriano', '175', 'Lourdes', 'Governador Valadares', 'MG', 'ARROBA@GEMAIL.COM', '88035817', 'NUTELLA', '2023-03-30', '2023-04-06'),
(8, 'Xbox360', 1, '35030330', 'Rua Marechal Floriano', '175', 'Lourdes', 'Governador Valadares', 'MG', 'dsajk@gmail.com', '88035817', 'NUTELLA', '1000-01-01', '2121-01-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ip_saida`
--

CREATE TABLE `ip_saida` (
  `id` int(11) NOT NULL,
  `idfornecedor` int(11) NOT NULL,
  `valorpagar` decimal(10,2) NOT NULL,
  `datapagar` date NOT NULL,
  `observacao` varchar(50) NOT NULL,
  `valorpago` decimal(10,2) NOT NULL,
  `datapago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ip_saida`
--

INSERT INTO `ip_saida` (`id`, `idfornecedor`, `valorpagar`, `datapagar`, `observacao`, `valorpago`, `datapago`) VALUES
(1, 2, '1000.00', '1011-01-01', 'Calotero', '760.01', '1000-10-01'),
(3, 1, '450.00', '2020-01-05', 'Quase pg', '300.00', '2020-01-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `master` varchar(1) NOT NULL,
  `foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `master`, `foto`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 's', 0),
(2, 'Xbox', 'fhg@gmail.com', '123', 'n', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ip_entrada`
--
ALTER TABLE `ip_entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pessoa_entrada` (`idpessoa`);

--
-- Índices para tabela `ip_fornecedor`
--
ALTER TABLE `ip_fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ip_pessoa`
--
ALTER TABLE `ip_pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ip_saida`
--
ALTER TABLE `ip_saida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idfornecedor` (`idfornecedor`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ip_entrada`
--
ALTER TABLE `ip_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `ip_fornecedor`
--
ALTER TABLE `ip_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `ip_pessoa`
--
ALTER TABLE `ip_pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `ip_saida`
--
ALTER TABLE `ip_saida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ip_saida`
--
ALTER TABLE `ip_saida`
  ADD CONSTRAINT `idfornecedor` FOREIGN KEY (`idfornecedor`) REFERENCES `ip_fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

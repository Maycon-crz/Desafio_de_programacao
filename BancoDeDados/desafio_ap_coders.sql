-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Jan-2022 às 18:31
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desafio_ap_coders`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `unidade` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `tipo_despesa` varchar(250) NOT NULL,
  `valor` int(100) NOT NULL,
  `vencimento_fatura` datetime NOT NULL,
  `status_pagamento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `unidade`, `descricao`, `tipo_despesa`, `valor`, `vencimento_fatura`, `status_pagamento`) VALUES
(1, 1, 'Luz', 'Padrão', 100, '2022-02-03 14:02:00', 0),
(2, 2, 'Água', 'Padrão', 120, '2022-02-03 14:02:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inquilinos`
--

CREATE TABLE `inquilinos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `idade` int(3) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `unidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inquilinos`
--

INSERT INTO `inquilinos` (`id`, `nome`, `idade`, `sexo`, `telefone`, `email`, `unidade`) VALUES
(1, 'Ester Alcantara', 36, 'f', '(47) 9999-99999', 'esteralcantara@gmail.com', 1),
(2, 'Ana', 38, 'f', '(47) 8888-88888', 'aninha@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `identificacao` varchar(250) NOT NULL,
  `proprietario` varchar(250) NOT NULL,
  `condominio` varchar(250) NOT NULL,
  `endereco` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidades`
--

INSERT INTO `unidades` (`id`, `identificacao`, `proprietario`, `condominio`, `endereco`) VALUES
(1, 'Unidade01', 'Maycon Nascimento de Oliveira', 'Girassol', 'Rua Girassol'),
(2, 'Unidade02', 'Maria Eduarda', 'Flores', 'Rua Flores');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_unidade_despesa` (`unidade`);

--
-- Indexes for table `inquilinos`
--
ALTER TABLE `inquilinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_unidade` (`unidade`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquilinos`
--
ALTER TABLE `inquilinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `fk_unidade_despesa` FOREIGN KEY (`unidade`) REFERENCES `unidades` (`id`);

--
-- Limitadores para a tabela `inquilinos`
--
ALTER TABLE `inquilinos`
  ADD CONSTRAINT `fk_unidade` FOREIGN KEY (`unidade`) REFERENCES `unidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

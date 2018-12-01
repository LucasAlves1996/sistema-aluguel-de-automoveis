-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Dez-2018 às 06:21
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_aluguel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluguel`
--

CREATE TABLE `aluguel` (
  `idAluguel` int(11) NOT NULL,
  `data_inicio_aluguel` datetime DEFAULT NULL,
  `data_devolucao_aluguel` datetime DEFAULT NULL,
  `quilometragem_inicial` float DEFAULT NULL,
  `quilometragem_final` float DEFAULT NULL,
  `idVeiculo` int(11) NOT NULL,
  `status_aluguel` varchar(45) DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  `idMtd_pagamento` int(11) NOT NULL,
  `nota_aluguel` varchar(45) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `status_pagamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluguel`
--

INSERT INTO `aluguel` (`idAluguel`, `data_inicio_aluguel`, `data_devolucao_aluguel`, `quilometragem_inicial`, `quilometragem_final`, `idVeiculo`, `status_aluguel`, `valor_total`, `idMtd_pagamento`, `nota_aluguel`, `idCliente`, `status_pagamento`) VALUES
(5, '2018-12-01 00:00:00', '2018-12-07 00:00:00', 123123000, NULL, 37, '1', NULL, 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avarias`
--

CREATE TABLE `avarias` (
  `idAvarias` int(10) UNSIGNED NOT NULL,
  `descricao_avaria` varchar(45) DEFAULT NULL,
  `valor_avaria` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo_funcionario`
--

CREATE TABLE `cargo_funcionario` (
  `idCargo_funcionario` int(11) NOT NULL,
  `nome_cargo` varchar(45) DEFAULT NULL,
  `salario_cargo` float DEFAULT NULL,
  `descricao_cargo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargo_funcionario`
--

INSERT INTO `cargo_funcionario` (`idCargo_funcionario`, `nome_cargo`, `salario_cargo`, `descricao_cargo`) VALUES
(1, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `data_cadastro_cliente` date DEFAULT NULL,
  `cpf_cliente` varchar(15) DEFAULT NULL,
  `tipo_cliente` int(11) DEFAULT NULL,
  `status_cliente` varchar(45) DEFAULT NULL,
  `telefone_cliente` varchar(45) DEFAULT NULL,
  `endereco` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome_cliente`, `data_cadastro_cliente`, `cpf_cliente`, `tipo_cliente`, `status_cliente`, `telefone_cliente`, `endereco`) VALUES
(1, 'Lucas Costa Alves', '2018-12-01', '03835313061', NULL, NULL, '51993610808', 'OrfanotrÃ³fio 204, apto.10 - Porto Alegre - Rio Grande do Sul - Brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(11) NOT NULL,
  `nome_funcionario` varchar(45) DEFAULT NULL,
  `idade_funcionario` int(11) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `data_demissao` date DEFAULT NULL,
  `email_funcionario` varchar(45) DEFAULT NULL,
  `senha_funcionario` varchar(45) DEFAULT NULL,
  `status_funcionario` varchar(45) DEFAULT NULL,
  `idCargo_funcionario` int(11) NOT NULL,
  `cpts_funcionario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome_funcionario`, `idade_funcionario`, `data_admissao`, `data_demissao`, `email_funcionario`, `senha_funcionario`, `status_funcionario`, `idCargo_funcionario`, `cpts_funcionario`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, 'admin', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca_carro`
--

CREATE TABLE `marca_carro` (
  `idMarca` int(11) NOT NULL,
  `nome_marca` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca_carro`
--

INSERT INTO `marca_carro` (`idMarca`, `nome_marca`) VALUES
(0, 'Ford'),
(1, 'Chevrolet'),
(2, 'Hyundai'),
(3, 'Renault'),
(4, 'KIA'),
(5, 'Wolksvagem'),
(12, 'godderson'),
(13, 'Josias'),
(14, 'Jambuza'),
(15, '123213'),
(16, 'TESTE'),
(17, 'MASK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_carro`
--

CREATE TABLE `modelo_carro` (
  `idModelo` int(11) NOT NULL,
  `nome_modelo` varchar(45) DEFAULT NULL,
  `idMarca` int(11) NOT NULL,
  `descricao_modelo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_carro`
--

INSERT INTO `modelo_carro` (`idModelo`, `nome_modelo`, `idMarca`, `descricao_modelo`) VALUES
(1, 'Fusca', 5, 'DEUS DO JQUERY'),
(2, 'Ford KA', 0, 'Fork KA para fans'),
(6, 'JQUERY GOD', 12, ''),
(7, '1231231', 13, ''),
(8, '', 14, ''),
(9, '12313', 15, ''),
(10, 'TESTE', 16, ''),
(11, '12321321312', 17, ''),
(12, 'FORZAO', 0, 'teste'),
(13, '123', 0, '123'),
(14, 'camaro', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mtd_pagamento`
--

CREATE TABLE `mtd_pagamento` (
  `idMtd_pagamento` int(11) NOT NULL,
  `tipo_pagamento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mtd_pagamento`
--

INSERT INTO `mtd_pagamento` (`idMtd_pagamento`, `tipo_pagamento`) VALUES
(1, 'debito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `idVeiculo` int(11) NOT NULL,
  `numero_chassi` varchar(45) DEFAULT NULL,
  `idModelo` int(11) NOT NULL,
  `status_carro` varchar(45) DEFAULT NULL,
  `placa_carro` varchar(45) DEFAULT NULL,
  `cor_carro` varchar(45) DEFAULT NULL,
  `data_aquisicao` date DEFAULT NULL,
  `quilometragem_veiculo` varchar(45) DEFAULT NULL,
  `valor_diaria` float DEFAULT NULL,
  `valor_km` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`idVeiculo`, `numero_chassi`, `idModelo`, `status_carro`, `placa_carro`, `cor_carro`, `data_aquisicao`, `quilometragem_veiculo`, `valor_diaria`, `valor_km`) VALUES
(36, '12312321', 14, '2', 'QWE-1231', 'Prata', '1970-01-01', '123123213', 312.31, 123.12),
(37, '23123213', 2, '2', '132-1313', 'Preto', '1995-12-12', '123123213', 200, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo_avarias`
--

CREATE TABLE `veiculo_avarias` (
  `idAvarias` int(10) UNSIGNED NOT NULL,
  `idVeiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluguel`
--
ALTER TABLE `aluguel`
  ADD PRIMARY KEY (`idAluguel`),
  ADD KEY `fk_aluguel_veiculo1_idx` (`idVeiculo`),
  ADD KEY `fk_aluguel_mtd_pagamento1_idx` (`idMtd_pagamento`),
  ADD KEY `fk_aluguel_cliente1_idx` (`idCliente`);

--
-- Indexes for table `avarias`
--
ALTER TABLE `avarias`
  ADD PRIMARY KEY (`idAvarias`);

--
-- Indexes for table `cargo_funcionario`
--
ALTER TABLE `cargo_funcionario`
  ADD PRIMARY KEY (`idCargo_funcionario`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`),
  ADD KEY `fk_funcionario_cargo_funcionario1_idx` (`idCargo_funcionario`);

--
-- Indexes for table `marca_carro`
--
ALTER TABLE `marca_carro`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indexes for table `modelo_carro`
--
ALTER TABLE `modelo_carro`
  ADD PRIMARY KEY (`idModelo`),
  ADD KEY `fk_modelo_carro_marca_carro_idx` (`idMarca`);

--
-- Indexes for table `mtd_pagamento`
--
ALTER TABLE `mtd_pagamento`
  ADD PRIMARY KEY (`idMtd_pagamento`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`idVeiculo`),
  ADD KEY `fk_carro_modelo_carro1_idx` (`idModelo`);

--
-- Indexes for table `veiculo_avarias`
--
ALTER TABLE `veiculo_avarias`
  ADD PRIMARY KEY (`idAvarias`,`idVeiculo`),
  ADD KEY `fk_avarias_has_veiculo_veiculo1_idx` (`idVeiculo`),
  ADD KEY `fk_avarias_has_veiculo_avarias1_idx` (`idAvarias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluguel`
--
ALTER TABLE `aluguel`
  MODIFY `idAluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avarias`
--
ALTER TABLE `avarias`
  MODIFY `idAvarias` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cargo_funcionario`
--
ALTER TABLE `cargo_funcionario`
  MODIFY `idCargo_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marca_carro`
--
ALTER TABLE `marca_carro`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `modelo_carro`
--
ALTER TABLE `modelo_carro`
  MODIFY `idModelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mtd_pagamento`
--
ALTER TABLE `mtd_pagamento`
  MODIFY `idMtd_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `idVeiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluguel`
--
ALTER TABLE `aluguel`
  ADD CONSTRAINT `fk_aluguel_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluguel_mtd_pagamento1` FOREIGN KEY (`idMtd_pagamento`) REFERENCES `mtd_pagamento` (`idMtd_pagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluguel_veiculo1` FOREIGN KEY (`idVeiculo`) REFERENCES `veiculo` (`idVeiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_cargo_funcionario1` FOREIGN KEY (`idCargo_funcionario`) REFERENCES `cargo_funcionario` (`idCargo_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `modelo_carro`
--
ALTER TABLE `modelo_carro`
  ADD CONSTRAINT `fk_modelo_carro_marca_carro` FOREIGN KEY (`idMarca`) REFERENCES `marca_carro` (`idMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_carro_modelo_carro1` FOREIGN KEY (`idModelo`) REFERENCES `modelo_carro` (`idModelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `veiculo_avarias`
--
ALTER TABLE `veiculo_avarias`
  ADD CONSTRAINT `fk_avarias_has_veiculo_avarias1` FOREIGN KEY (`idAvarias`) REFERENCES `avarias` (`idAvarias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avarias_has_veiculo_veiculo1` FOREIGN KEY (`idVeiculo`) REFERENCES `veiculo` (`idVeiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

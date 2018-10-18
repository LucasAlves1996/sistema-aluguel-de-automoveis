-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Out-2018 às 03:14
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
-- Database: `aluguel_veiculos`
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
  `cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `idCidade` int(11) NOT NULL,
  `nome_cidade` varchar(45) DEFAULT NULL,
  `idPais_uf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `data_cadastro_cliente` date DEFAULT NULL,
  `cpf_cliente` int(11) DEFAULT NULL,
  `tipo_cliente` int(11) DEFAULT NULL,
  `status_cliente` varchar(45) DEFAULT NULL,
  `telefone_cliente` varchar(45) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `idEndereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `nome_rua` varchar(45) DEFAULT NULL,
  `numero_residencia` varchar(45) DEFAULT NULL,
  `complemento_residencia` varchar(45) DEFAULT NULL,
  `cidade_idCidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `idEndereco` int(11) NOT NULL,
  `cpts_funcionario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca_carro`
--

CREATE TABLE `marca_carro` (
  `idMarca` int(11) NOT NULL,
  `nome_marca` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `mtd_pagamento`
--

CREATE TABLE `mtd_pagamento` (
  `idMtd_pagamento` int(11) NOT NULL,
  `tipo_pagamento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais_uf`
--

CREATE TABLE `pais_uf` (
  `idPais_uf` int(11) NOT NULL,
  `nome_estado` varchar(45) DEFAULT NULL,
  `nome_pais` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `valores_aluguel`
--

CREATE TABLE `valores_aluguel` (
  `idValores` int(11) NOT NULL,
  `valor_diaria` float DEFAULT NULL,
  `valor_km` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `valores_aluguel_idValores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo_avarias`
--

CREATE TABLE `veiculo_avarias` (
  `avarias_idAvarias` int(10) UNSIGNED NOT NULL,
  `veiculo_idVeiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluguel`
--
ALTER TABLE `aluguel`
  ADD PRIMARY KEY (`idAluguel`);

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
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idCidade`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `marca_carro`
--
ALTER TABLE `marca_carro`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indexes for table `modelo_carro`
--
ALTER TABLE `modelo_carro`
  ADD PRIMARY KEY (`idModelo`);

--
-- Indexes for table `mtd_pagamento`
--
ALTER TABLE `mtd_pagamento`
  ADD PRIMARY KEY (`idMtd_pagamento`);

--
-- Indexes for table `pais_uf`
--
ALTER TABLE `pais_uf`
  ADD PRIMARY KEY (`idPais_uf`);

--
-- Indexes for table `valores_aluguel`
--
ALTER TABLE `valores_aluguel`
  ADD PRIMARY KEY (`idValores`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`idVeiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

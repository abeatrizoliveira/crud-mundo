-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/11/2025 às 03:33
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
-- Banco de dados: `bd_mundo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `id_cidade` int(11) NOT NULL,
  `nm_cidade` varchar(50) NOT NULL,
  `qtd_populacao` bigint(20) NOT NULL,
  `cd_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `nm_cidade`, `qtd_populacao`, `cd_pais`) VALUES
(1, 'São Paulo', 12400232, 1),
(2, 'Rio de Janeiro', 6747815, 1),
(3, 'Belo Horizonte', 2721564, 1),
(4, 'Salvador', 2711840, 1),
(5, 'Fortaleza', 2400000, 1),
(6, 'Nova York', 7936530, 2),
(7, 'Los Angeles', 3770958, 2),
(8, 'Chicago', 2611867, 2),
(9, 'Houston', 2324082, 2),
(10, 'Phoenix', 1675144, 2),
(11, 'Pequim', 21893000, 3),
(12, 'Xangai', 24870000, 3),
(13, 'Chongqing', 32000000, 3),
(14, 'Shenzhen', 17000000, 3),
(15, 'Guangzhou', 14498400, 3),
(16, 'Mumbai', 12442000, 4),
(17, 'Delhi', 19800000, 4),
(18, 'Bengaluru', 13000000, 4),
(19, 'Hyderabad', 10000000, 4),
(20, 'Ahmedabad', 8000000, 4),
(21, 'Berlim', 3769000, 5),
(22, 'Hamburgo', 1899000, 5),
(23, 'Munique', 1484000, 5),
(24, 'Colônia', 1080000, 5),
(25, 'Frankfurt', 763000, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `continente`
--

CREATE TABLE `continente` (
  `id_continente` int(11) NOT NULL,
  `nm_continente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `continente`
--

INSERT INTO `continente` (`id_continente`, `nm_continente`) VALUES
(1, 'África'),
(2, 'América'),
(3, 'Ásia'),
(4, 'Europa'),
(5, 'Oceania');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nm_pais` varchar(50) NOT NULL,
  `cd_pais` varchar(3) NOT NULL,
  `qtd_populacao` bigint(20) NOT NULL,
  `nm_idioma` varchar(50) NOT NULL,
  `cd_continente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nm_pais`, `cd_pais`, `qtd_populacao`, `nm_idioma`, `cd_continente`) VALUES
(1, 'Brasil', '76', 211695000, 'Português', 2),
(2, 'Estados Unidos', '840', 334914895, 'Inglês', 2),
(3, 'China', '156', 1409670000, 'Mandarim', 3),
(4, 'Índia', '356', 1460000000, 'Hindi e Inglês', 3),
(5, 'Alemanha', '276', 83000000, 'Alemão', 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `cd_pais` (`cd_pais`);

--
-- Índices de tabela `continente`
--
ALTER TABLE `continente`
  ADD PRIMARY KEY (`id_continente`);

--
-- Índices de tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`),
  ADD KEY `cd_continente` (`cd_continente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `continente`
--
ALTER TABLE `continente`
  MODIFY `id_continente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`cd_pais`) REFERENCES `pais` (`id_pais`);

--
-- Restrições para tabelas `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `pais_ibfk_1` FOREIGN KEY (`cd_continente`) REFERENCES `continente` (`id_continente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

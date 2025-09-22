-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 09:51
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
-- Banco de dados: `plano_de_saude`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `acao` text DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `acao`, `data_hora`) VALUES
(1, 'pereira', 'Novo usuÃ¡rio cadastrado: antonio', '2025-06-09 04:36:40'),
(2, 'antonio', 'Login realizado com sucesso.', '2025-06-09 04:45:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nome_mae` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nascimento`, `nome_mae`, `cpf`, `email`, `telefone`, `endereco`, `login`, `senha`) VALUES
(1, 'antonio do nascimentopereira', '2024-01-03', 'maria do nascimento alcantara', '052.917.593-21', 'juliene-19@hotmail.com', '21994694457', 'Rua Alzira Vargas, nÂ° 17 - sobrado', 'antonio.silva', '$2y$10$G3rwA1J3tohLP5ebi8uNI.iKK0AHF4pArpjRRgb5DAb3CYLOMCPUK'),
(2, 'JULIENE S LUSTOZA', '2024-11-06', 'JULIENE S LUSTOZA', '052.917.593-21', 'juliene-19@hotmail.com', '21994694457', 'RUA DONA CAMILA', 'antonio.silva', '$2y$10$RS00tCZhaETbwE7XeriSj.YNJuaNnIqa6hiuMJIu05s.UatBnWrYK'),
(3, 'antonio pereeira', '1992-06-15', 'maria do nascimento alcantara', '052.917.593-21', 'alvesantonio426@gmail.com', '21994694457', 'Rua Alzira Vargas, nÂ° 17 - sobrado', 'pereira', '$2y$10$9dSZ3WP4OzXR6YL9PtoM0.fSqUO02ANOGIRVFNAualza3wgh7YN5q'),
(4, 'antonio silva', '1992-06-15', 'maria do nascimento alcantara', '121.809.747-79', 'juliene-19@hotmail.com', '21994694457', 'Rua Alzira Vargas, nÂ° 17 - sobrado', 'antonio', '$2y$10$za6znILIaJ0y4JtofilOZObcLFQ0bWTp3DaYsfLCSdk4h.sGk59/e');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

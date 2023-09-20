-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Nov-2022 às 01:40
-- Versão do servidor: 10.5.16-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u752953776_keyway`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_espacos_favoritados`
--

CREATE TABLE `tab_espacos_favoritados` (
  `cod_favoritados` int(9) NOT NULL,
  `cod_user` int(9) NOT NULL,
  `cod_spaces` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_eventos_marcados`
--

CREATE TABLE `tab_eventos_marcados` (
  `cod_marcados` int(9) NOT NULL,
  `cod_user` int(9) NOT NULL,
  `cod_events` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_events`
--

CREATE TABLE `tab_events` (
  `cod_events` int(9) NOT NULL,
  `cod_organizers` int(9) NOT NULL,
  `cod_spaces` int(9) NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(280) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_evento` date NOT NULL,
  `hora_start` time NOT NULL,
  `categoria` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_evento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ;

--
-- Extraindo dados da tabela `tab_events`
--

INSERT INTO `tab_events` (`cod_events`, `cod_organizers`, `cod_spaces`, `nome`, `descricao`, `data_evento`, `hora_start`, `categoria`, `foto_evento`) VALUES
(1, 1, 1, 'Aula de Slackline', 'Venha aprender sobre equilíbrio com o professor Alberto em um espaço verde, tranquilo e com boas energias.', '2022-11-25', '12:30:00', 'Esporte', 'https://keyway.shop/Projeto_KeyWay/imagens/event_01.jpg'),
(2, 1, 3, 'Aulão de Yoga', 'Atinja a paz interior com o professor Guilherme Mussi!', '2022-11-26', '06:30:00', 'Saúde', 'https://keyway.shop/Projeto_KeyWay/imagens/event_02.jpg'),
(3, 2, 2, 'Bosque Old Car', 'é uma oportunidade para expositores e apreciadores conhecerem de perto os possantes que fizeram história no século 20. São esperados cerca de 100 representantes do antigomobilismo.', '2022-11-27', '08:00:00', 'Automobilístico', 'https://keyway.shop/Projeto_KeyWay/imagens/event_03.jpg'),
(4, 3, 2, 'VÔLEI NO BOSQUE', 'É o vôlei não tem como.', '2022-11-25', '10:45:00', 'Esporte', 'https://keyway.shop/Projeto_KeyWay/imagens/event_04.jpg'),
(5, 3, 4, 'VÔLEI 2', 'O inimigo agora é outro', '2022-11-25', '12:30:00', 'Esporte', 'https://keyway.shop/Projeto_KeyWay/imagens/event_05.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_organizers`
--

CREATE TABLE `tab_organizers` (
  `cod_organizers` int(9) NOT NULL,
  `cod_user` int(9) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_contato` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_contato` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ;

--
-- Extraindo dados da tabela `tab_organizers`
--

INSERT INTO `tab_organizers` (`cod_organizers`, `cod_user`, `username`, `nome`, `email_contato`, `tel_contato`, `cnpj`, `cep`, `uf`) VALUES
(1, 1, 'Organizer_01', 'Associação Esportiva SCS', 'googlebrasil@google.com', '(11) 2395-8400', '06.990.590/0001-23', '04.538-13', 'SP'),
(2, 2, 'Organizer_02', 'Bosque Old Car', 'googlebrasil@google.com', '(11) 2395-8400', '06.990.590/0001-23', '04.538-13', 'SP'),
(3, 3, 'Organizer_03', 'TRAMPE INC.', 'googlebrasil@google.com', '(11) 2395-8400', '06.990.590/0001-23', '04.538-13', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_spaces`
--

CREATE TABLE `tab_spaces` (
  `cod_spaces` int(9) NOT NULL,
  `nome` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ;

--
-- Extraindo dados da tabela `tab_spaces`
--

INSERT INTO `tab_spaces` (`cod_spaces`, `nome`, `cidade`, `uf`) VALUES
(1, 'Espaço Verde Chico Mendes', 'São Caetano do Sul', 'SP'),
(2, 'Bosque do Povo', 'São Cateano do Sul', 'SP'),
(3, 'Parque Santa Maria', 'São Caetano do Sul', 'SP'),
(4, 'Parque Tom Jobim - Espaço Cerâmica', 'São Caetano do Sul', 'SP'),
(5, 'Praça da Bíblia', 'São Caetano do Sul', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_users`
--

CREATE TABLE `tab_users` (
  `cod_user` int(9) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_imagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tab_users`
--

INSERT INTO `tab_users` (`cod_user`, `username`, `nome`, `email`, `senha`, `nome_imagem`) VALUES
(1, 'Organizer_01', 'Organizador_01', 'email_01@gmail.com', '$2y$10$OtsG5OEA2TuJma0zqJWBTu8fGDrHf265lg.LReJe69lSNig5mHAqa', ''),
(2, 'Organizer_02', 'Organizador_02', 'email_02@gmail.com', '$2y$10$ClYXNgckuMAZscbEEu7LuOWj9td4FqXvopHqGOIgBo9BWbY6yEjIy', ''),
(3, 'Organizer_03', 'Organizador_03', 'email_03@gmail.com', '$2y$10$5wpSlOPEKw.4BSEWuNHyB.Qe0cLtwJDfl652OWVPMDGPwB2v7Ly/C', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tab_espacos_favoritados`
--
ALTER TABLE `tab_espacos_favoritados`
  ADD PRIMARY KEY (`cod_favoritados`),
  ADD KEY `FK_Cod_User_02` (`cod_user`),
  ADD KEY `FK_Cod_Spaces` (`cod_spaces`);

--
-- Índices para tabela `tab_eventos_marcados`
--
ALTER TABLE `tab_eventos_marcados`
  ADD PRIMARY KEY (`cod_marcados`),
  ADD KEY `FK_Cod_User_03` (`cod_user`),
  ADD KEY `FK_Cod_Events` (`cod_events`);

--
-- Índices para tabela `tab_events`
--
ALTER TABLE `tab_events`
  ADD PRIMARY KEY (`cod_events`),
  ADD KEY `FK_Cod_Organizers` (`cod_organizers`),
  ADD KEY `FK_Cod_Spaces_02` (`cod_spaces`);

--
-- Índices para tabela `tab_organizers`
--
ALTER TABLE `tab_organizers`
  ADD PRIMARY KEY (`cod_organizers`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `FK_Cod_User` (`cod_user`);

--
-- Índices para tabela `tab_spaces`
--
ALTER TABLE `tab_spaces`
  ADD PRIMARY KEY (`cod_spaces`);

--
-- Índices para tabela `tab_users`
--
ALTER TABLE `tab_users`
  ADD PRIMARY KEY (`cod_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tab_espacos_favoritados`
--
ALTER TABLE `tab_espacos_favoritados`
  MODIFY `cod_favoritados` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tab_eventos_marcados`
--
ALTER TABLE `tab_eventos_marcados`
  MODIFY `cod_marcados` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_events`
--
ALTER TABLE `tab_events`
  MODIFY `cod_events` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_organizers`
--
ALTER TABLE `tab_organizers`
  MODIFY `cod_organizers` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_spaces`
--
ALTER TABLE `tab_spaces`
  MODIFY `cod_spaces` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_users`
--
ALTER TABLE `tab_users`
  MODIFY `cod_user` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tab_espacos_favoritados`
--
ALTER TABLE `tab_espacos_favoritados`
  ADD CONSTRAINT `FK_Cod_Spaces` FOREIGN KEY (`cod_spaces`) REFERENCES `tab_spaces` (`cod_spaces`),
  ADD CONSTRAINT `FK_Cod_User_02` FOREIGN KEY (`cod_user`) REFERENCES `tab_users` (`cod_user`);

--
-- Limitadores para a tabela `tab_eventos_marcados`
--
ALTER TABLE `tab_eventos_marcados`
  ADD CONSTRAINT `FK_Cod_Events` FOREIGN KEY (`cod_events`) REFERENCES `tab_events` (`cod_events`),
  ADD CONSTRAINT `FK_Cod_User_03` FOREIGN KEY (`cod_user`) REFERENCES `tab_users` (`cod_user`);

--
-- Limitadores para a tabela `tab_events`
--
ALTER TABLE `tab_events`
  ADD CONSTRAINT `FK_Cod_Organizers` FOREIGN KEY (`cod_organizers`) REFERENCES `tab_organizers` (`cod_organizers`),
  ADD CONSTRAINT `FK_Cod_Spaces_02` FOREIGN KEY (`cod_spaces`) REFERENCES `tab_spaces` (`cod_spaces`);

--
-- Limitadores para a tabela `tab_organizers`
--
ALTER TABLE `tab_organizers`
  ADD CONSTRAINT `FK_Cod_User` FOREIGN KEY (`cod_user`) REFERENCES `tab_users` (`cod_user`),
  ADD CONSTRAINT `FK_Username` FOREIGN KEY (`username`) REFERENCES `tab_users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

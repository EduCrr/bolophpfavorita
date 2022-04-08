-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Abr-2022 às 20:48
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `favorita`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ambientes`
--

CREATE TABLE `ambientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `banner` varchar(36) NOT NULL,
  `imagem` varchar(36) NOT NULL,
  `estilo` text NOT NULL,
  `descricao` text NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `titulo_pagina` varchar(60) NOT NULL,
  `descricao_pagina` text NOT NULL,
  `titulo_compartilhamento` varchar(128) NOT NULL,
  `descricao_compartilhamento` text NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ambientes`
--

INSERT INTO `ambientes` (`id`, `nome`, `banner`, `imagem`, `estilo`, `descricao`, `visivel`, `ordem`, `slug`, `titulo_pagina`, `descricao_pagina`, `titulo_compartilhamento`, `descricao_compartilhamento`, `criado`, `modificado`, `excluido`) VALUES
(1, 'cozinha', '47e264d332b62df407173d16108d0b26.jpg', '5c01d593583d350825a73d80b1d559df.jpg', '<p>teste</p>\r\n', '<p>teste</p>\r\n', 1, NULL, 'teste', 'asd', 'asd', 'asd', 'asd', '2022-04-05 18:50:20', '2022-04-05 17:10:48', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudos`
--

CREATE TABLE `conteudos` (
  `id` int(11) UNSIGNED NOT NULL,
  `controladora` varchar(30) NOT NULL,
  `acao` varchar(30) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(36) DEFAULT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conteudos`
--

INSERT INTO `conteudos` (`id`, `controladora`, `acao`, `titulo`, `texto`, `imagem`, `criado`, `modificado`, `excluido`) VALUES
(1, 'Home', 'index', 'qual o seu estilo?', 'As pessoas são únicas e assim também devem ser suas casas. Favorita Interni é uma marca que permite expressar múltiplos estilos. Libertade, criatividade, desejo. Você pode usar e abusar de tudo isso com Favorita Interni. E com muito bom gosto, graças ao DNA italiano da marca, presente no design, na qualidade e na sofisticação que confere aos ambientes.', NULL, '2022-03-29 14:12:16', NULL, NULL),
(2, 'Home', 'index', 'onde encontrar', 'Confira abaixo a loja mais próxima e deixe sua casa mais moderna e com a praticidade que você merece no dia a dia.', NULL, '2022-04-04 12:59:58', NULL, NULL),
(3, 'Sobre', 'index', 'qual o seu estilo?', 'O estilo de vida de uma pessoa revela muito sobre sua personalidade e o seu jeito de ser. Independente do estilo, todos desejamos viver em uma casa bonita e confortável. E é isso que a Favorita Interni busca oferecer: uma casa onde cada um possa se identificar e ter prazer em viver.', NULL, '2022-04-04 13:02:36', NULL, NULL),
(4, 'Sobre', 'index', 'qualidade unicasa', 'A Favorita Interni faz parte da Unicasa, fabricante das marcas Dell Anno, New e Casa Brasileira. Localizada em Bento Gonçalves (RS), a empresa possui um dos mais modernos parques fabris da América Latina, com mais de 50 mil m² de área construída e maquinário com a mais alta tecnologia.\r\n\r\nA Unicasa é a primeira empresa do setor a ter seu capital aberto na Bolsa de Valores, representando um avanço nos padrões de qualidade e transparência corporativa, inédito em seu segmento. Desde 1985 no mercado, a Unicasa opera com foco na inovação, qualidade e sustentabilidade, garantindo ao consumidor móveis modernos, resistentes e com design diferenciado.', NULL, '2022-04-04 13:02:36', NULL, NULL),
(5, 'Sobre', 'index', 'responsabilidade ambiental', 'A Unicasa também preserva e cuida do meio ambiente através de ações que fazem toda a diferença:\r\n\r\n- Uso da madeira de reflorestamento;\r\n\r\n- Captação da água da chuva;\r\n\r\n- Reciclagem de resíduos produzidos na empresa;\r\n\r\n- Tratamento no sistema de esgotos;\r\n\r\n- A substituição do óleo diesel por GLP em todo o processo de produção.', NULL, '2022-04-04 13:06:00', NULL, NULL),
(6, 'Politica', 'index', 'Política de privacidade', 'Em razão do comprometimento com sua segurança e privacidade, nós...', NULL, '2022-04-04 13:06:00', NULL, NULL),
(7, 'Downloads', 'index', 'Downloads', 'Downloads', NULL, '2022-04-04 13:06:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudos_parametros`
--

CREATE TABLE `conteudos_parametros` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(254) NOT NULL,
  `habilitar_titulo` tinyint(1) NOT NULL,
  `habilitar_texto` tinyint(1) NOT NULL,
  `conteudo_formatado` tinyint(1) NOT NULL,
  `habilitar_img` tinyint(1) NOT NULL,
  `largura_imagem` int(11) DEFAULT NULL,
  `altura_imagem` int(11) DEFAULT NULL,
  `recortar_imagem` tinyint(1) NOT NULL,
  `habilitar_video` tinyint(1) NOT NULL,
  `galeria` tinyint(1) NOT NULL,
  `largura_galeria` int(11) DEFAULT NULL,
  `altura_galeria` int(11) DEFAULT NULL,
  `minimizavel` tinyint(1) NOT NULL,
  `conteudo_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conteudos_parametros`
--

INSERT INTO `conteudos_parametros` (`id`, `descricao`, `habilitar_titulo`, `habilitar_texto`, `conteudo_formatado`, `habilitar_img`, `largura_imagem`, `altura_imagem`, `recortar_imagem`, `habilitar_video`, `galeria`, `largura_galeria`, `altura_galeria`, `minimizavel`, `conteudo_id`) VALUES
(1, 'Estilo', 1, 1, 1, 1, 300, 300, 1, 0, 0, NULL, NULL, 0, 1),
(2, 'Onde encontrar', 1, 1, 1, 1, 300, 300, 1, 0, 0, NULL, NULL, 0, 2),
(3, 'Estilo', 1, 1, 1, 1, 300, 300, 1, 0, 0, NULL, NULL, 0, 3),
(4, 'Unicasa', 1, 1, 1, 1, 300, 300, 1, 0, 0, NULL, NULL, 1, 4),
(5, 'Responsabilidade ambiental', 1, 1, 1, 1, 300, 300, 1, 0, 0, NULL, NULL, 1, 5),
(6, 'Política de privacidade\r\n', 1, 1, 1, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 1, 6),
(7, 'Download\r\n', 1, 1, 1, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 1, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `arquivo` varchar(36) NOT NULL,
  `visivel` int(1) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `downloads`
--

INSERT INTO `downloads` (`id`, `nome`, `arquivo`, `visivel`, `ordem`, `slug`, `criado`, `modificado`, `excluido`) VALUES
(1, 'dfsdfaa', 'b5325f21b49e764dafaac2fffac510ec.jpg', 0, NULL, 'dfsdfaa.jpg', '2022-04-07 12:42:29', '2022-04-07 12:45:32', NULL),
(2, 'hb', 'f99cabe342b51a790a1e2d4d3a7c4f62.jpg', 0, NULL, 'hb.jpg', '2022-04-07 12:43:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estilos`
--

CREATE TABLE `estilos` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(36) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estilos`
--

INSERT INTO `estilos` (`id`, `nome`, `descricao`, `imagem`, `visivel`, `ordem`, `criado`, `modificado`, `excluido`) VALUES
(1, 'asd', '<p>a</p>\r\n', 'c0d877b7d628939945cec7b17ac05244.jpg', 1, NULL, '2022-04-05 15:20:05', '2022-04-08 14:29:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `categoria` varchar(60) DEFAULT NULL,
  `nome` varchar(36) NOT NULL,
  `visivel` int(1) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `ambiente_id` int(11) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id`, `categoria`, `nome`, `visivel`, `ordem`, `ambiente_id`, `criado`, `modificado`, `excluido`) VALUES
(1, 'natural', '1.jpg', 0, NULL, 1, '2022-04-06 16:26:48', NULL, '2022-04-06 17:05:41'),
(2, 'natural', 'a8d4421399787fa588ab12140dec5e42.png', 0, NULL, 1, '2022-04-06 18:30:20', '2022-04-07 11:21:00', NULL),
(3, NULL, '82a5449529cfaca7f94bd422c2e42ca9.jpg', 0, NULL, 1, '2022-04-06 18:35:43', NULL, '2022-04-06 18:44:39'),
(4, 'natural', '089e4970559bdbea24d27f647afca636.jpg', 0, NULL, 1, '2022-04-06 18:36:09', '2022-04-07 11:21:09', NULL),
(5, 'classico', '87548f3162f8d94f65ddc6099fbcf3f1.jpg', 0, NULL, 1, '2022-04-06 18:37:50', '2022-04-07 11:18:45', NULL),
(6, 'natural', '64c6a3d0271fdd9115e265a06efdf95c.jpg', 0, NULL, 1, '2022-04-06 18:38:24', '2022-04-07 11:21:04', NULL),
(7, 'moderno', 'ed20beeb6356ac2b7399b6c922c02a5f.jpg', 0, NULL, 1, '2022-04-06 18:39:09', '2022-04-07 11:19:51', NULL),
(8, NULL, '25f5d36974b001eddd325cee8a70e63a.jpg', 0, NULL, 1, '2022-04-07 11:22:46', NULL, NULL),
(9, NULL, 'ae32928865917868557605f99f06b349.jpg', 0, NULL, 1, '2022-04-07 11:23:52', NULL, NULL),
(10, NULL, '22c4cfae6a7f94cac1ebafe63fe7336e.jpg', 0, NULL, 1, '2022-04-07 11:24:32', NULL, NULL),
(11, 'classico', '77bfc65981efc3fc9c7fea3474539c3b.jpg', 0, NULL, 1, '2022-04-07 11:24:39', '2022-04-07 11:35:35', NULL),
(12, 'natural', '2907af8859617b09eb452efc5942f442.jpg', 0, NULL, 1, '2022-04-07 11:38:40', '2022-04-07 11:46:23', NULL),
(13, NULL, 'e36e42192159d7a67c876e5780d51337.jpg', 0, NULL, 1, '2022-04-07 11:46:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) UNSIGNED NOT NULL,
  `controladora` varchar(30) NOT NULL,
  `acao` varchar(30) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `descricao` text NOT NULL,
  `titulo_compartilhamento` varchar(60) NOT NULL,
  `descricao_compartilhamento` text NOT NULL,
  `imagem` varchar(36) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `paginas`
--

INSERT INTO `paginas` (`id`, `controladora`, `acao`, `titulo`, `descricao`, `titulo_compartilhamento`, `descricao_compartilhamento`, `imagem`, `criado`, `modificado`, `excluido`) VALUES
(1, 'Home', 'index', '', '', '', '', '1.jpg', '2022-03-29 13:59:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(254) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(36) NOT NULL,
  `slug` varchar(254) NOT NULL,
  `publicado` datetime DEFAULT NULL,
  `visivel` tinyint(4) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `titulo_pagina` varchar(60) NOT NULL,
  `descricao_pagina` text NOT NULL,
  `titulo_compartilhamento` varchar(128) NOT NULL,
  `descricao_compartilhamento` text NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `conteudo`, `imagem`, `slug`, `publicado`, `visivel`, `ordem`, `titulo_pagina`, `descricao_pagina`, `titulo_compartilhamento`, `descricao_compartilhamento`, `criado`, `modificado`, `excluido`) VALUES
(1, 'dasdesea', '<p>aa</p>\r\n', '4b6c08f71089f2f8b5833f8807804570.jpg', 'dasdesea', '2022-04-30 09:20:00', 1, NULL, 'a', 'a', 'a', 'a', '2022-04-05 20:03:35', '2022-04-06 12:20:58', NULL),
(2, 'ee4', '<p>ee</p>\r\n', '8643ae9e335dbc3b0c82de6b2b022d29.jpg', 'ee4', '2022-04-06 09:02:00', 0, NULL, 'k', 'k', 'k', 'k', '2022-04-05 19:24:18', '2022-04-06 12:02:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `imagem` varchar(36) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT 0,
  `ordem` int(11) DEFAULT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `slides`
--

INSERT INTO `slides` (`id`, `imagem`, `visivel`, `ordem`, `criado`, `modificado`, `excluido`) VALUES
(3, '0c20caafb96a5c1d6a5250f1b248c775.jpg', 0, 1, '2022-04-05 18:29:29', '2022-04-05 16:32:20', '2022-04-08 14:31:02'),
(4, 'aa48979efc6c37cb8b466c92c65a71e8.jpg', 0, NULL, '2022-04-05 16:30:14', NULL, '2022-04-05 16:32:02'),
(5, 'da53e92d551e240a88b60c4519024167.jpg', 0, NULL, '2022-04-05 16:30:50', NULL, '2022-04-05 16:32:06'),
(6, '57f03c793ce4b121fa56a9328d247a87.jpg', 0, NULL, '2022-04-05 16:31:52', '2022-04-05 17:01:04', NULL),
(7, '32b0ef0b36dd8d44e7586d74ac140b31.jpg', 0, NULL, '2022-04-05 17:09:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `excluido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `criado`, `modificado`, `excluido`) VALUES
(1, '8poroito', '8@8poroito.com.br', '$2a$12$Zw/O6SQErSg06h41CaM22uLAdH.Yq7obVgDODQq1dd4lQBrr30Hsi', '2022-04-04 13:19:11', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudos`
--
ALTER TABLE `conteudos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudos_parametros`
--
ALTER TABLE `conteudos_parametros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conteudos_parametros_conteudo` (`conteudo_id`);

--
-- Índices para tabela `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ambientes`
--
ALTER TABLE `ambientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `conteudos`
--
ALTER TABLE `conteudos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `conteudos_parametros`
--
ALTER TABLE `conteudos_parametros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

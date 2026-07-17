
-- -- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";

-- -- Banco de dados: `gospel_chords`

-- -- Estrutura para tabela `assinaturas`
-- CREATE TABLE `assinaturas` (
--   `id_assinatura` int(11) NOT NULL,
--   `id_usuario` int(11) NOT NULL,
--   `id_plano` int(11) NOT NULL,
--   `data_inicio` datetime NOT NULL DEFAULT current_timestamp(),
--   `data_fim` datetime DEFAULT NULL,
--   `status` tinyint(1) NOT NULL DEFAULT 1) 
--   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Estrutura para tabela `planos`
-- CREATE TABLE `planos` (
--   `id_plano` int(11) NOT NULL,
--   `nome` varchar(100) NOT NULL,
--   `descricao` text DEFAULT NULL,
--   `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
--   `periodicidade` varchar(20) NOT NULL,
--   `status` tinyint(1) NOT NULL DEFAULT 1) 
--   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Despejando dados para a tabela `planos`
-- INSERT INTO `planos` (`id_plano`, `nome`, `descricao`, `valor`, `periodicidade`, `status`) VALUES
-- (1, 'Basico', 'Acesso inicial ao sistema', 7.00, 'mensal', 1),
-- (2, 'Premium', 'Acesso completo ao curso e cifras', 400.00, 'mensal', 1);


-- -- Estrutura para tabela `usuarios`
-- CREATE TABLE `usuarios` (
--   `id` int(11) NOT NULL,
--   `nome` varchar(100) NOT NULL,
--   `email` varchar(150) NOT NULL,
--   `senha` varchar(255) NOT NULL,
--   `celular` varchar(20) DEFAULT NULL,
--   `status` tinyint(1) NOT NULL DEFAULT 1,
--   `cidade` varchar(100) DEFAULT NULL,
--   `estado` varchar(50) DEFAULT NULL,
--   `tipo_cadastro` varchar(50) DEFAULT NULL,
--   `datahora_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
--   `img` varchar(255) DEFAULT NULL,
--   `reset_token` varchar(255) DEFAULT NULL,
--   `reset_expira` datetime DEFAULT NULL,
--   `ultimo_acesso` datetime DEFAULT NULL,
--   `tipo_usuario` varchar(20) NOT NULL DEFAULT 'aluno') 
--   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Despejando dados para a tabela `usuarios`
-- INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `celular`, `status`, `cidade`, `estado`, `tipo_cadastro`, `datahora_cadastro`, `img`, `reset_token`, `reset_expira`, `ultimo_acesso`, `tipo_usuario`) VALUES
-- (2, 'Ademar neto', 'neto.moovery@gmail.com', '$2y$10$cvTpi69yqM51qtQhZl3dcOTtXB.hJVSUr6sr4d/O5jzgUVPVsJ8KK', '83998603238', 1, 'joao pessoa', 'paraiba', 'free', '2026-07-10 00:06:41', 'assets/img/perfil/1783652801_c4f3c3a2-8751-4378-85c2-3f555fd77ec8.jpeg', NULL, NULL, NULL, 'aluno');


-- -- Índices de tabela `assinaturas`
-- ALTER TABLE `assinaturas`
--   ADD PRIMARY KEY (`id_assinatura`),
--   ADD KEY `fk_assinatura_usuario` (`id_usuario`),
--   ADD KEY `fk_assinatura_plano` (`id_plano`);

-- -- Índices de tabela `planos`
-- ALTER TABLE `planos`
--   ADD PRIMARY KEY (`id_plano`);

-- -- Índices de tabela `usuarios`
-- ALTER TABLE `usuarios`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `email` (`email`);

-- -- AUTO_INCREMENT de tabela `assinaturas`
-- ALTER TABLE `assinaturas`
--   MODIFY `id_assinatura` int(11) NOT NULL AUTO_INCREMENT;

-- -- AUTO_INCREMENT de tabela `planos`
-- ALTER TABLE `planos`
--   MODIFY `id_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- -- AUTO_INCREMENT de tabela `usuarios`
-- ALTER TABLE `usuarios`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


-- -- -- Restrições para tabelas `assinaturas`
-- ALTER TABLE `assinaturas`
--   ADD CONSTRAINT `fk_assinatura_plano` FOREIGN KEY (`id_plano`) REFERENCES `planos` (`id_plano`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `fk_assinatura_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- COMMIT;

  
-- CREATE TABLE conteudos (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     titulo VARCHAR(200) NOT NULL,
--     artista VARCHAR(150),
--     versao VARCHAR(100),
--     tipo ENUM('cifra','tablatura','partitura') NOT NULL,
--     arquivo VARCHAR(255) NOT NULL,
--     tom VARCHAR(10),
--     afinacao VARCHAR(50),
--     visualizacoes INT DEFAULT 0,
--     downloads INT DEFAULT 0,
--     status ENUM('ativo','inativo') DEFAULT 'ativo',
--     usuario_id INT,
--     data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,

--     FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
-- );


-- CREATE TABLE cifras (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nome_musica VARCHAR(150) NOT NULL,
--     autor VARCHAR(150) NOT NULL,
--     versao VARCHAR(100),
--     tipo ENUM('cifra', 'tablatura', 'partitura') DEFAULT 'cifra',
--     arquivo VARCHAR(255) NOT NULL,
--     id_usuario INT NOT NULL,
--     status ENUM('pendente','aprovada','rejeitada') DEFAULT 'pendente',
--     observacao TEXT NULL,
--     data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
--     data_analise DATETIME NULL,

--     CONSTRAINT fk_cifra_usuario
--         FOREIGN KEY (id_usuario)
--         REFERENCES usuarios(id)
--         ON DELETE CASCADE
-- );

-- | Campo          | Função                                          |
-- | -------------- | ----------------------------------------------- |
-- | `id`           | Identificador da cifra.                         |
-- | `nome_musica`  | Nome da música.                                 |
-- | `autor`        | Autor ou banda.                                 |
-- | `versao`       | Ex.: Original, Acústica, Ao Vivo, Simplificada. |
-- | `tipo`         | Tipo do arquivo enviado.                        |
-- | `arquivo`      | Nome do arquivo salvo no servidor.              |
-- | `id_usuario`   | Usuário que enviou a cifra.                     |
-- | `status`       | Situação da análise.                            |
-- | `observacao`   | Comentário do administrador caso rejeite.       |
-- | `data_envio`   | Data do envio.                                  |
-- | `data_analise` | Quando o admin analisou.                        |

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,

    celular VARCHAR(20),
    cidade VARCHAR(100),
    estado CHAR(2),

    img VARCHAR(255) DEFAULT 'images.jpg',

    tipo_usuario ENUM('admin','aluno','assinante') NOT NULL DEFAULT 'assinante',

    status ENUM(
        'ativo',
        'pendente',
        'suspenso',
        'cancelado',
        'expirado'
    ) NOT NULL DEFAULT 'pendente',

    reset_token VARCHAR(255) DEFAULT NULL,
    reset_expira DATETIME DEFAULT NULL,

    ultimo_acesso DATETIME DEFAULT NULL,

    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE planos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,

    descricao TEXT,

    valor DECIMAL(10,2) NOT NULL,

    periodicidade ENUM(
        'mensal',
        'trimestral',
        'semestral',
        'anual',
        'vitalicio'
    ) NOT NULL,

    status ENUM(
        'ativo',
        'inativo'
    ) DEFAULT 'ativo',

    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO planos
(nome, descricao, valor, periodicidade)

VALUES

(
'Curso Completo',

'Acesso completo ao curso, cifras, tablaturas, partituras e vídeos.',

97.00,

'vitalicio'
),

(
'Assinante',

'Acesso mensal ao acervo de cifras.',

7.00,

'mensal'
);


INSERT INTO usuarios
(
nome,
email,
senha,
tipo_usuario,
status
)

VALUES
(
'Administrador',
'admin@gospelchords.com',
'$2y$10xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
'admin',
'ativo'
);
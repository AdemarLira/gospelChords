-- USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    celular VARCHAR(20),
    cidade VARCHAR(100),
    estado CHAR(2),

    tipo_usuario ENUM('admin','usuario') DEFAULT 'usuario',
    tipo_cadastro ENUM('assinante','aluno'),

    status ENUM(
        'pendente',
        'ativo',
        'suspenso',
        'cancelado',
        'expirado',
        'inativo'
    ) DEFAULT 'pendente',

    img VARCHAR(255) DEFAULT 'avatar.png',

    reset_token VARCHAR(255),
    reset_expira DATETIME,
    ultimo_acesso DATETIME,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PLANOS
CREATE TABLE planos(
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100),
descricao TEXT,
valor DECIMAL(10,2),
periodicidade ENUM('mensal','anual'),
status ENUM('ativo','inativo') DEFAULT 'ativo'
);

-- ASSINATURAS
CREATE TABLE assinaturas(

id INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

id_plano INT,

forma_pagamento ENUM(
'pix',
'cartao',
'boleto',
'nenhum'
) DEFAULT 'nenhum',

renovacao_automatica BOOLEAN DEFAULT TRUE,

data_inicio DATETIME,

data_fim DATETIME,

status ENUM(
'pendente',
'ativa',
'cancelada',
'expirada'
) DEFAULT 'pendente',

FOREIGN KEY(id_usuario) REFERENCES usuarios(id),

FOREIGN KEY(id_plano) REFERENCES planos(id)

);



-- CURSOS
CREATE TABLE cursos(

id INT AUTO_INCREMENT PRIMARY KEY,

titulo VARCHAR(150),

descricao TEXT,

imagem VARCHAR(255),

nivel ENUM(
'iniciante',
'intermediario',
'avancado'
),

ordem INT DEFAULT 1,

status ENUM(
'ativo',
'inativo'
) DEFAULT 'ativo',

data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

-- MODULOS
CREATE TABLE modulos(

id INT AUTO_INCREMENT PRIMARY KEY,

id_curso INT,

titulo VARCHAR(150),

descricao TEXT,

ordem INT,

FOREIGN KEY(id_curso) REFERENCES cursos(id)

);

-- AULAS
CREATE TABLE aulas(

id INT AUTO_INCREMENT PRIMARY KEY,

id_modulo INT,

titulo VARCHAR(150),

descricao TEXT,

video VARCHAR(255),

duracao VARCHAR(20),

material VARCHAR(255),

ordem INT,

status ENUM(
'ativo',
'inativo'
) DEFAULT 'ativo',

FOREIGN KEY(id_modulo)
REFERENCES modulos(id)

);

-- CATEGORIAS       
CREATE TABLE categorias(

id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(100)

);

-- CIFRAS
CREATE TABLE cifras(

id INT AUTO_INCREMENT PRIMARY KEY,

id_categoria INT,

id_usuario INT,

titulo VARCHAR(150),

autor VARCHAR(150),

tom VARCHAR(5),

capotraste VARCHAR(20),

youtube VARCHAR(255),

arquivo VARCHAR(255),

visualizacoes INT DEFAULT 0,

downloads INT DEFAULT 0,

status ENUM(
'pendente',
'aprovada',
'rejeitada'
) DEFAULT 'pendente',

data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY(id_categoria)
REFERENCES categorias(id),

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);

-- TABLRATURAS
CREATE TABLE tablaturas(

id INT AUTO_INCREMENT PRIMARY KEY,

id_categoria INT,

id_usuario INT,

titulo VARCHAR(150),

arquivo VARCHAR(255),

status ENUM(
'pendente',
'aprovada',
'rejeitada'
),

FOREIGN KEY(id_categoria)
REFERENCES categorias(id),

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);

-- PARTITURAS
CREATE TABLE partituras(

id INT AUTO_INCREMENT PRIMARY KEY,

id_categoria INT,

id_usuario INT,

titulo VARCHAR(150),

arquivo VARCHAR(255),

status ENUM(
'pendente',
'aprovada',
'rejeitada'
),

FOREIGN KEY(id_categoria)
REFERENCES categorias(id),

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);


-- FAVORITOS
CREATE TABLE favoritos(

id INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

id_cifra INT,

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id),

FOREIGN KEY(id_cifra)
REFERENCES cifras(id)

);

-- PROGRESSO DO USUÁRIO
CREATE TABLE progresso_usuario(

id INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

id_aula INT,

concluida BOOLEAN DEFAULT FALSE,

data_conclusao DATETIME,

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id),

FOREIGN KEY(id_aula)
REFERENCES aulas(id)

);

-- DOWNLOADS
CREATE TABLE downloads(

id INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

tipo ENUM(
'cifra',
'tablatura',
'partitura'
),

id_arquivo INT,

data_download DATETIME,

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);

-- PAGAMENTOS
CREATE TABLE pagamentos(

id INT AUTO_INCREMENT PRIMARY KEY,

id_assinatura INT,

valor DECIMAL(10,2),

forma_pagamento ENUM(
'pix',
'cartao',
'boleto'
),

status ENUM(
'pendente',
'pago',
'estornado'
),

data_pagamento DATETIME,

FOREIGN KEY(id_assinatura)
REFERENCES assinaturas(id)

);

-- LOGS
CREATE TABLE logs(

id INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

acao VARCHAR(255),

ip VARCHAR(50),

data_log DATETIME,

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);
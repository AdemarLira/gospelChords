# 📖 Gospel Chords

## Documentação Técnica do Projeto

---

# 1. Pré-requisitos

Antes de iniciar o projeto, o ambiente deve possuir os seguintes requisitos:

## Ambiente de desenvolvimento

### Sistema operacional

Recomendado:

- Windows 10/11
- Linux Ubuntu 22.04+
- macOS

---

## Softwares necessários

### Git

Utilizado para controle de versão e clonagem do projeto.

Verificar instalação:

```
git--version
```

---

### Docker

Responsável pela criação dos containers da aplicação.

Verificar instalação:

```
docker--version
```

---

### Docker Compose

Responsável pela orquestração dos serviços:

- Aplicação PHP
- Banco MySQL
- phpMyAdmin

Verificar:

```
docker compose version
```

---

### Editor de código

Recomendado:

- Visual Studio Code

Extensões recomendadas:

- PHP Intelephense
- Docker
- GitLens
- DotENV

---

### Composer

Gerenciador das dependências PHP.

Verificar:

```
composer--version
```

---

# 2. Clonando o projeto

O projeto deve ser obtido através do repositório Git.

Exemplo:

```
git clone https://github.com/seu-usuario/gospelChords.git
```

Acessar a pasta:

```
cd gospelChords
```

Após clonar, verificar a estrutura:

```
ls
```

Deve apresentar:

```
app
docker
public
routes
storage
vendor
composer.json
docker-compose.yml
```

---

# 3. Configurando o ambiente

Após clonar o projeto, é necessário configurar as variáveis do ambiente.

Criar o arquivo:

```
.env
```

na raiz do projeto:

```
gospelChords/
│
├── .env
├── docker-compose.yml
└── app/
```

Esse arquivo contém informações sensíveis:

- Banco de dados
- URLs
- Credenciais
- Serviços externos

O arquivo `.env` não deve ser enviado para o GitHub.

---

# 4. Docker

O Gospel Chords utiliza Docker para padronizar o ambiente.

Os serviços utilizados são:

| Serviço | Função | Porta |
| --- | --- | --- |
| PHP + Apache | Aplicação Web | 8080 |
| MySQL | Banco de dados | 3307 |
| phpMyAdmin | Administração do banco | 8081 |

## Criando os containers

Na raiz do projeto:

```
docker compose up-d--build
```

Verificar containers ativos:

```
dockerps
```

Resultado esperado:

```
gospel_chords_app
gospel_chords_db
gospel_chords_phpmyadmin
```

---

## Acessos locais

Aplicação:

```
http://localhost:8080
```

phpMyAdmin:

```
http://localhost:8081
```

---

# 5. Banco de dados

O sistema utiliza:

```
MySQL 8.0
```

Banco:

```
gospel_chords
```

Usuário:

```
gospel_user
```

---

## Importação do banco

Arquivo:

```
banco.sql
```

Local:

```
/banco.sql
```

Pode ser importado através:

- phpMyAdmin
- Beekeeper Studio
- MySQL CLI

Exemplo:

```
mysql-u gospel_user-p gospel_chords < banco.sql
```

---

# 6. Variáveis de ambiente

Arquivo:

```
.env
```

Exemplo:

```
APP_ENV=local
APP_DEBUG=true

BASE_URL=http://localhost:8080

DB_HOST=db
DB_PORT=3306
DB_DATABASE=gospel_chords
DB_USERNAME=gospel_user
DB_PASSWORD=gospel_password
```

---

## Ambiente de produção

No servidor real:

```
APP_ENV=production
APP_DEBUG=false

BASE_URL=https://seudominio.com

DB_HOST=db
DB_PORT=3306
DB_DATABASE=gospel_chords
DB_USERNAME=usuario_seguro
DB_PASSWORD=senha_segura
```

---

# 7. Executando o projeto

Após configurar o ambiente:

Subir containers:

```
docker compose up-d
```

Acessar:

```
http://localhost:8080
```

---

Para acessar o container:

```
docker exec-it gospel_chords_appbash
```

Instalar dependências:

```
composer install
```

---

# 8. Estrutura das pastas

Estrutura principal:

```
gospelChords/

├── app/
│   ├── config/
│   ├── controllers/
│   ├── helpers/
│   ├── middleware/
│   ├── models/
│   ├── services/
│   └── views/
│
├── public/
│   ├── index.php
│   ├── admin/
│   ├── aluno/
│   ├── assinante/
│   └── assets/
│
├── routes/
│
├── storage/
│
├── docker/
│
├── vendor/
│
├── banco.sql
├── composer.json
└── docker-compose.yml
```

---

# 9. Fluxo de desenvolvimento

## Desenvolvimento local

Fluxo:

```
Criar alteração
        ↓
Testar localmente
        ↓
Atualizar banco se necessário
        ↓
Commit Git
        ↓
Push GitHub
        ↓
Deploy produção
```

---

## Padrão recomendado

Antes de alterar:

Criar branch:

```
git checkout-b nova-funcionalidade
```

Após finalizar:

```
git add .git commit-m"Descrição da alteração"git push
```

---

# 10. Solução de problemas

## Erro 404 no navegador

Verificar:

```
dockerps
```

Confirmar container:

```
gospel_chords_app
```

Recriar:

```
docker compose down

docker compose up-d--build
```

---

## Erro Composer autoload

Mensagem:

```
vendor/composer/autoload_real.php not found
```

Solução:

```
composer install
```

---

## Erro .env não encontrado

Mensagem:

```
Unable to read environment file
```

Verificar:

```
.env
```

na raiz do projeto.

---

## Erro banco de dados

Verificar:

```
docker logs gospel_chords_db
```

Testar conexão:

```
Host: db
Porta: 3306
```

---

# 11. Deploy

## Requisitos do servidor

Servidor recomendado:

- Ubuntu Server 22.04+
- Docker instalado
- Domínio configurado
- SSL ativo

---

## Processo de publicação

### 1. Acessar servidor

SSH:

```
ssh usuario@servidor
```

---

### 2. Clonar projeto

```
git clone repositorio
```

---

### 3. Configurar `.env`

Criar:

```
.env
```

com dados de produção.

---

### 4. Subir aplicação

```
docker compose up-d--build
```

---

### 5. Configurar domínio

Apontar DNS:

```
dominio.com
        |
        ↓
IP do servidor
```

---

### 6. Configurar HTTPS

Utilizar:

- Nginx Proxy Manager
- Certbot
- Let's Encrypt

---

## Versão da documentação

```
Projeto: Gospel Chords
Versão: 1.0
Ambiente: Docker + PHP + MySQL
Última atualização: Agosto/2026
```

---

Ademar, eu recomendo agora uma próxima etapa: criar uma pasta dentro do projeto:

```
docs/
```

e colocar:

```
docs/
├── instalacao.md
├── arquitetura.md
├── banco.md
├── deploy.md
└── problemas-comuns.md
```

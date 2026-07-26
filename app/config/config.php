<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;


// ============================================================
// Carrega as variáveis do arquivo .env
// ============================================================

$dotenv = Dotenv::createImmutable(
    dirname(__DIR__, 2)
);

$dotenv->load();


// ============================================================
// URL base da aplicação
// ============================================================

define(
    'BASE_URL',
    $_ENV['BASE_URL'] ?? 'http://localhost:8080'
);
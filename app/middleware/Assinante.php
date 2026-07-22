<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {

    header(
        'Location: ' . BASE_URL . '/index.php?erro=naoautorizado'
    );

    exit();
}

if (
    $_SESSION['tipo_usuario'] !== 'usuario'
    ||
    $_SESSION['tipo_cadastro'] !== 'assinante'
) {

    header(
        'Location: ' . BASE_URL . '/index.php?erro=naoautorizado'
    );

    exit();
}
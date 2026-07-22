<?php

require_once __DIR__ . '/../../../app/config/config.php';
require_once __DIR__ . '/../../../app/config/database.php';
require_once __DIR__ . '/../../../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: '
        . BASE_URL
        . '/index.php'
    );

    exit();
}

$token = trim(
    $_POST['token'] ?? ''
);

$senha = $_POST['senha'] ?? '';

$confirmar = $_POST['confirmar'] ?? '';

if (
    $token === ''
    ||
    $senha === ''
    ||
    $confirmar === ''
) {

    header(
        'Location: '
        . BASE_URL
        . '/index.php?erro=campos'
    );

    exit();
}

if (strlen($senha) < 8) {

    header(
        'Location: '
        . BASE_URL
        . '/index.php?erro=senha_curta'
    );

    exit();
}

if ($senha !== $confirmar) {

    header(
        'Location: '
        . BASE_URL
        . '/index.php?erro=senhas_diferentes'
    );

    exit();
}

try {

    $controller =
        new AuthController($conn);

    $resultado =
        $controller
            ->redefinirSenha(
                $token,
                $senha
            );

    if (
        !$resultado['sucesso']
    ) {

        if (
            $resultado['erro']
            === 'token_expirado'
        ) {

            header(
                'Location: '
                . BASE_URL
                . '/index.php?erro=token_expirado'
            );

            exit();
        }

        header(
            'Location: '
            . BASE_URL
            . '/index.php?erro=senha'
        );

        exit();
    }

    header(
        'Location: '
        . BASE_URL
        . '/index.php?erro=senha_atualizada'
    );

    exit();

} catch (Exception $e) {

    error_log(
        $e->getMessage()
    );

    header(
        'Location: '
        . BASE_URL
        . '/index.php?erro=servidor'
    );

    exit();
}
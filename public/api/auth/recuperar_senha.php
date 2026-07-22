<?php

require_once __DIR__ . '/../../../app/config/config.php';
require_once __DIR__ . '/../../../app/config/database.php';
require_once __DIR__ . '/../../../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: '
        . BASE_URL
        . '/recuperar-senha'
    );

    exit();
}

$email = trim(
    $_POST['email'] ?? ''
);

if (
    $email === ''
    ||
    !filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    )
) {

    header(
        'Location: '
        . BASE_URL
        . '/recuperar-senha?status=email'
    );

    exit();
}

try {

    $controller =
        new AuthController($conn);

    $resultado =
        $controller
            ->solicitarRecuperacao(
                $email
            );

    if (
        !$resultado['sucesso']
    ) {

        header(
            'Location: '
            . BASE_URL
            . '/recuperar-senha?status=erro'
        );

        exit();
    }

    header(
        'Location: '
        . BASE_URL
        . '/recuperar-senha?status=sucesso'
    );

    exit();

} catch (Exception $e) {

    error_log(
        $e->getMessage()
    );

    header(
        'Location: '
        . BASE_URL
        . '/recuperar-senha?status=erro'
    );

    exit();
}
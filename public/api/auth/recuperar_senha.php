<?php

require_once __DIR__ . '/../../../app/config/config.php';
require_once __DIR__ . '/../../../app/config/database.php';
require_once __DIR__ . '/../../../app/controllers/AuthController.php';


// Verifica se a requisição veio pelo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: '
        . BASE_URL
        . '/esqueci_senha.php'
    );

    exit();
}


// Pega o e-mail enviado pelo formulário
$email = trim(
    $_POST['email'] ?? ''
);


// Valida o e-mail
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
        . '/esqueci_senha.php?status=email'
    );

    exit();
}


try {

    // Cria o controller de autenticação
    $controller = new AuthController($conn);


    // Solicita a recuperação da senha
    $resultado = $controller
        ->solicitarRecuperacao($email);


    // Verifica se ocorreu algum erro
    if (!$resultado['sucesso']) {

        header(
            'Location: '
            . BASE_URL
            . '/esqueci_senha.php?status=erro'
        );

        exit();
    }


    // Se tudo deu certo
    header(
        'Location: '
        . BASE_URL
        . '/esqueci_senha.php?status=sucesso'
    );

    exit();


} catch (Exception $e) {

    // Registra o erro no log do Docker/PHP
    error_log(
        'Erro na recuperação de senha: '
        . $e->getMessage()
    );


    // Volta para a página de recuperação
    header(
        'Location: '
        . BASE_URL
        . '/esqueci_senha.php?status=erro'
    );

    exit();
}
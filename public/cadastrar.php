<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.php');
    exit;
}

try {

    $dados = [
        'nome' => trim($_POST['nome'] ?? ''),

        'email' => trim($_POST['email'] ?? ''),

        'senha' => $_POST['senha'] ?? '',

        'celular' => preg_replace(
            '/\D/',
            '',
            $_POST['celular'] ?? ''
        ),

        'cidade' => trim($_POST['cidade'] ?? ''),

        'estado' => trim($_POST['estado'] ?? ''),

        'plano' => $_POST['plano'] ?? '',

        'foto' => $_FILES['foto'] ?? null,

        'forma_pagamento' =>
            $_POST['forma_pagamento'] ?? ''
    ];


    $authController = new AuthController($conn);


    $resultado =
        $authController->cadastrar($dados);


    if ($resultado['sucesso'] === true) {

        header(
            'Location: index.php?cadastro=sucesso'
        );

        exit;
    }


    $erro = urlencode(
        $resultado['erro'] ?? 'erro_desconhecido'
    );


    header(
        'Location: cadastro.php?erro=' . $erro
    );

    exit;


} catch (Throwable $e) {

    echo '<h1>Erro ao realizar cadastro</h1>';

    echo '<p>';
    echo htmlspecialchars(
        $e->getMessage()
    );
    echo '</p>';

    echo '<pre>';
    echo htmlspecialchars(
        $e->getTraceAsString()
    );
    echo '</pre>';

    exit;
}              
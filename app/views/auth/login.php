<?php

session_start();

require_once __DIR__ . '/../../../app/config/database.php';
require_once __DIR__ . '/../../../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    header('Location: ../../index.php?erro=campos');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../../index.php?erro=email');
    exit();
}

try {

    $controller = new AuthController($conn);

    $resultado = $controller->login($email, $senha);

    if (!$resultado['sucesso']) {

        $url = '../../index.php?erro=' . urlencode($resultado['erro']);

        if ($resultado['erro'] === 'senha') {
            $url .= '&email=' . urlencode($email);
        }

        header("Location: $url");
        exit();
    }

    header('Location: ' . $resultado['redirecionamento']);
    exit();

} catch (Exception $e) {

    error_log($e->getMessage());

    header('Location: ../../index.php?erro=servidor');
    exit();
}
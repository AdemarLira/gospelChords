<?php

if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../../config/config.php';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gospel Chords</title>

    <!-- Favicon -->
    <link
        rel="icon"
        type="image/x-icon"
        href="<?= BASE_URL ?>/assets/img/logo.png"
    >

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- CSS principal -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/style.css"
    >

    <!-- CSS do painel administrativo -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/dashboard_adm.css"
    >

</head>
<body>
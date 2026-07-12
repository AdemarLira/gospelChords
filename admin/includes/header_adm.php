<?php

include_once(__DIR__ . "/../../api/conexao.php");

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$imagemPerfil = !empty($_SESSION['img'])
    ? $_SESSION['img']
    : 'assets/img/perfil/avatar.png';
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Administração | Gospel Chords</title>

<link rel="icon" href="assets/img/logo_amarela.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/dashboard.css">

<script src="https://kit.fontawesome.com/328073035f.js" crossorigin="anonymous"></script>

</head>
<body>
<?php

$servidor = "db";
$usuario  = "gospel_user";
$senha    = "gospel_password";
$dbName   = "gospel_chords";
$porta    = 3306;

$conn = new mysqli(
    $servidor,
    $usuario,
    $senha,
    $dbName,
    $porta
);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados.");
}

$conn->set_charset("utf8mb4");
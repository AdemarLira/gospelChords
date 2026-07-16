<?php

$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$dbName   = "gospel_chords";

$conn = new mysqli($servidor, $usuario, $senha, $dbName);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
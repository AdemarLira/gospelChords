<?php

require_once("../api/conexao.php");
require_once("includes/verifica_admin.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Acesso inválido.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Usuário inválido.");
}

// Impede excluir o próprio administrador logado
if ($id == $_SESSION['usuario_id']) {
    die("Você não pode excluir sua própria conta.");
}

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM usuarios WHERE id=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    header("Location: usuarios.php?sucesso=excluido");
    exit();

} else {

    die("Erro ao excluir: " . mysqli_error($conn));

}

mysqli_stmt_close($stmt);
mysqli_close($conn);
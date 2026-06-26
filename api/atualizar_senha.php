<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $token = $_POST['token'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios 
            SET senha = ?, reset_token = NULL, reset_expira = NULL 
            WHERE reset_token = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $senha, $token);
    $stmt->execute();

    header("Location: ../index.php?erro=senha_atualizada");
    exit();
}
?>
<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {

            // Verifica o status do usuário
            if ($usuario['status'] == 'pendente') {
                header("Location: ../index.php?erro=pendente");
                exit();
            }

            if ($usuario['status'] == 'inativo') {
                header("Location: ../index.php?erro=inativo");
                exit();
            }

            // Cria a sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['img'] = $usuario['img'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            if ($usuario['tipo_usuario'] == 'admin') {
                header("Location: ../admin/dashboard_adm.php");
            } elseif ($usuario['tipo_usuario'] == 'aluno') {
                header("Location: ../aluno/dashboard_aluno.php");
            } elseif ($usuario['tipo_usuario'] == 'assinante') {
                header("Location: ../assinante/dashboard_assinante.php");
            }

            exit();

        } else {
            header("Location: ../index.php?erro=senha&email=" . urlencode($email));
            exit();
        }

    } else {
        header("Location: ../index.php?erro=usuario");
        exit();
    }
}

?>
<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

   $sql = "SELECT 
            u.*,
            a.id_plano
        FROM usuarios u
        LEFT JOIN assinaturas a ON a.id_usuario = u.id
        WHERE u.email = ?";
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

            if ($usuario['status'] == 'suspenso') {
                header("Location: ../index.php?erro=suspenso");
                exit();
            }

            // Cria a sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['img'] = $usuario['img'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            $_SESSION['id_plano'] = $usuario['id_plano'];

            if ($usuario['tipo_usuario'] == 'admin') {

    header("Location: ../admin/dashboard_adm.php");
    exit();

    }

    if ($usuario['tipo_usuario'] == 'usuario') {

        switch ($usuario['id_plano']) {
            case 1: // Curso Completo
                header("Location: ../aluno/dashboard_aluno.php");
                break;
            case 2: // Plano Mensal
                header("Location: ../assinante/dashboard_assinante.php");
                break;
            default:
                header("Location: ../index.php?erro=plano");
                break;
        }
    exit();
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
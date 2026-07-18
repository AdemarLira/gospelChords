<?php

include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Acesso inválido.");
}

mysqli_begin_transaction($conn);

try {

    // ============================
    // Dados do formulário
    // ============================
    $nome      = trim($_POST["nome"]);
    $email     = trim($_POST["email"]);
    $senha     = $_POST["senha"];
    $celular   = preg_replace('/\D/', '', $_POST["celular"]);
    $cidade    = trim($_POST["cidade"]);
    $estado    = trim($_POST["estado"]);

    // Plano escolhido
    $plano = (int) $_POST["plano"];

    // Tipo de usuário (permissão)
    $tipoUsuario = "usuario";

    // Tipo de cadastro (plano)
    if ($plano == 1) {
        $tipoCadastro = "aluno";
    } else {
        $tipoCadastro = "assinante";
    }

    $status = "pendente";

    // ============================
    // Verifica e-mail existente
    // ============================
    $sql = "SELECT id FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        throw new Exception("Este e-mail já está cadastrado.");
    }

    mysqli_stmt_close($stmt);

    // ============================
    // Criptografa senha
    // ============================
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // ============================
    // Upload da foto
    // ============================
    $imagem = "avatar.png";

    if (
        isset($_FILES["foto"]) &&
        $_FILES["foto"]["error"] == 0
    ) {

        $diretorio = "../assets/img/perfil/";

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $extensao = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $novoNome = uniqid() . "." . $extensao;
        $destino = $diretorio . $novoNome;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)) {
            $imagem = $novoNome;
        }
    }

    // ============================
    // Inserir usuário
    // ============================
    $sql = "INSERT INTO usuarios
    (
        nome,
        email,
        senha,
        celular,
        status,
        cidade,
        estado,
        img,
        tipo_usuario,
        tipo_cadastro
    )
    VALUES
    (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssss",
        $nome,
        $email,
        $senhaHash,
        $celular,
        $status,
        $cidade,
        $estado,
        $imagem,
        $tipoUsuario,
        $tipoCadastro
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    // ============================
    // ID do usuário criado
    // ============================
    $idUsuario = mysqli_insert_id($conn);

    // ============================
    // Criar assinatura
    // ============================
    $statusAssinatura = "pendente";
    $formaPagamento = "nenhum";
    $renovacao = 1;

    $sql = "INSERT INTO assinaturas
    (
        id_usuario,
        id_plano,
        forma_pagamento,
        renovacao_automatica,
        data_inicio,
        status
    )
    VALUES
    (
        ?, ?, ?, ?, NOW(), ?
    )";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iisis",
        $idUsuario,
        $plano,
        $formaPagamento,
        $renovacao,
        $statusAssinatura
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    // ============================
    // Finaliza transação
    // ============================
    mysqli_commit($conn);

    echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href='../index.php';
          </script>";

} catch (Exception $e) {

    mysqli_rollback($conn);

    die('Erro: ' . $e->getMessage());

}

mysqli_close($conn);

?>
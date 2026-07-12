<?php

include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Acesso inválido.");
}

mysqli_begin_transaction($conn);

try {

  
    // Dados do formulário
    $nome     = trim($_POST["nome"]);
    $email    = trim($_POST["email"]);
    $senha    = $_POST["senha"];
    $celular  = trim($_POST["celular"]);
    $cidade   = trim($_POST["cidade"]);
    $estado   = trim($_POST["estado"]);
    $tipoUsuario = $_POST["tipo_usuario"];

    switch ($tipoUsuario) {

    case "aluno":
        $plano = 1;          // ID do plano Curso Completo
        $status = "ativo";
        break;

    case "assinante":
        $plano = 2;          // ID do plano Assinante
        $status = "ativo";
        break;

    default:
        throw new Exception("Tipo de usuário inválido.");
}

    // Verifica se email existe

    $sql = "SELECT id FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        throw new Exception("Este e-mail já está cadastrado.");

    }

    mysqli_stmt_close($stmt);

    // Criptografar senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Upload da foto
    $imagem = "assets/img/perfil/avatar.png";

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

						// Caminho salvo no banco
						$imagem = "assets/img/perfil/" . $novoNome;
				}
    }

    // Inserir usuário
    $status = 1;
    $tipoUsuario = "aluno";

    
    $sql = "INSERT INTO usuarios
    (
        nome,
        email,
        senha,
        celular,
        cidade,
        estado,
        status,
        tipo_usuario,
        datahora_cadastro,
        img
    )
    VALUES
    (
        ?,?,?,?,?,?,?,?,NOW(),?
    )";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssss",
        $nome,
        $email,
        $senhaHash,
        $celular,
        $cidade,
        $estado,
        $status,
        $tipoUsuario,
        $imagem
    );

    if (!mysqli_stmt_execute($stmt)) {

        throw new Exception(mysqli_error($conn));

    }

    mysqli_stmt_close($stmt);

    // ID do usuário criado
    $idUsuario = mysqli_insert_id($conn);

    // Criar assinatura
    $statusAssinatura = "ativa";

    $sql = "INSERT INTO assinaturas
    (
        id_usuario,
        id_plano,
        data_inicio,
        status
    )
    VALUES
    (
        ?,?,NOW(),?
    )";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iis",
        $idUsuario,
        $plano,
        $statusAssinatura
    );

    if (!mysqli_stmt_execute($stmt)) {

        throw new Exception(mysqli_error($conn));

    }

    mysqli_stmt_close($stmt);

   
    // Finaliza

    mysqli_commit($conn);

    echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href='../index.php';
          </script>";

} catch (Exception $e) {

    mysqli_rollback($conn);

    echo "<script>
            alert('".$e->getMessage()."');
            history.back();
          </script>";

}

mysqli_close($conn);

?>
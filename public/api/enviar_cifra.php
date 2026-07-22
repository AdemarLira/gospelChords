<?php
session_start();
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $musica = trim($_POST['nome_musica']);
    $autor = trim($_POST['autor']);
    $versao = trim($_POST['versao']);
    $tom = trim($_POST['tom']);
    $capotraste = trim($_POST['capotraste']);
    $youtube = trim($_POST['youtube']);
    $idCategoria = (int) $_POST['id_categoria'];

    $id_usuario = $_SESSION['usuario_id'];

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {

        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));

        $permitidos = ['doc', 'docx'];

        if (!in_array($extensao, $permitidos)) {
            die("Apenas arquivos do Word (.doc e .docx) são permitidos.");
        }

        $uploadDir = "../uploads/cifras/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $novoNome = uniqid("cifra_") . "." . $extensao;

        $caminho = $uploadDir . $novoNome;

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho)) {

            $tamanho = $_FILES['arquivo']['size'];

          $sql = "INSERT INTO cifras (
                    id_categoria,
                    id_usuario,
                    titulo,
                    autor,
                    versao,
                    tom,
                    capotraste,
                    youtube,
                    arquivo
                )
                VALUES (?,?,?,?,?,?,?,?,?)";

          $stmt = mysqli_prepare($conn, $sql);

           mysqli_stmt_bind_param(
                $stmt,
                "iisssssss",
                $idCategoria,
                $id_usuario,
                $musica,
                $autor,
                $versao,
                $tom,
                $capotraste,
                $youtube,
                $novoNome
            );

            if (mysqli_stmt_execute($stmt)) {

                echo "Cifra enviada com sucesso!";

            } else {

                echo "Erro: " . mysqli_error($conn);

            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao enviar o arquivo.";
        }

    } else {
        echo "Selecione um arquivo.";
    }

} else {
    echo "Método inválido.";
}
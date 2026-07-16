<?php
session_start();
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $musica = trim($_POST['nome_musica']);
    $autor = trim($_POST['autor']);
    $versao = trim($_POST['versao']);
    $tipo = $_POST['tipo'];

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

            $sql = "INSERT INTO cifras
                    (nome_musica, autor, versao, tipo,
                     arquivo, tipo_arquivo, tamanho_arquivo, id_usuario)
                    VALUES (?,?,?,?,?,?,?,?)";

           $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "ssssssii",
                $musica,
                $autor,
                $versao,
                $tipo,
                $novoNome,
                $extensao,
                $tamanho,
                $id_usuario
            );

            if (mysqli_stmt_close($stmt)) {
                echo "Cifra enviada com sucesso!";
            } else {
                echo "Erro ao salvar no banco.";
            }

        } else {
            echo "Erro ao enviar o arquivo.";
        }

    } else {
        echo "Selecione um arquivo.";
    }

} else {
    echo "Método inválido.";
}
<?php

include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $musica = $_POST['nome_musica'] ?? '';
  $autor = $_POST['autor'] ?? '';
  $versao = $_POST['versao'] ?? '';
  $tipo = $_POST['tipo'] ?? '';
  $arquivo = $_FILES['arquivo'] ?? null;

  if ($musica && $autor && $versao && $tipo && $arquivo) {
    // Processar o arquivo e salvar os dados no banco de dados
    // Exemplo de como mover o arquivo para o diretório desejado
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($arquivo['name']);

    if (move_uploaded_file($arquivo['tmp_name'], $uploadFile)) {
      // Salvar informações no banco de dados
      $stmt = $pdo->prepare("INSERT INTO musicas (nome_musica, autor, versao, tipo, arquivo) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$musica, $autor, $versao, $tipo, $uploadFile]);

      echo "Cifra enviada com sucesso!";
    } else {
      echo "Erro ao mover o arquivo.";
    }
  } else {
    echo "Todos os campos são obrigatórios.";
  }
} else {
  echo "Método de requisição inválido.";
}
?>

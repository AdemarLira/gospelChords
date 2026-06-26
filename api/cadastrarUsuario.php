<?php
    include_once('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nome = trim($_POST["nome"]);
      $email = trim($_POST["email"]);
      $senha = trim($_POST["senha"]);
      $celular = trim($_POST["celular"]);
      $cidade = trim($_POST["cidade"]);
      $estado = trim($_POST["estado"]);
  
      $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
  
      // Upload da imagem
      $diretorio = "../assets/";
      $nomeArquivo = basename($_FILES["foto"]["name"]);
      $caminhoCompleto = $diretorio . $nomeArquivo;
  
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoCompleto)) {
          echo "Foto enviada com sucesso!<br>";
      } else {
          echo "Erro ao enviar a foto.<br>";
          $caminhoCompleto = ""; // ou defina um valor padrão
      }
  
      $sql = "INSERT INTO usuarios (nome, email, senha, celular, status, cidade, estado, tipo_cadastro, datahora_cadastro, img) 
              VALUES ('$nome', '$email', '$senhaCriptografada', '$celular', 'ativo', '$cidade', '$estado', 'free', now(), '$caminhoCompleto')";
  
      if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Usuário cadastrado com sucesso!');
                window.location.href = '../index.html';
            </script>";
          exit;
      } else {
          echo "Erro ao cadastrar: " . mysqli_error($conn);
      }
  }  
?>
  
<script src="js/functions.js"></script>  
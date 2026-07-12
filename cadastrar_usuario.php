<?php
  include_once("api/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Criar conta | Gospel Chords</title>
<link rel="stylesheet" href="assinante/assets/css/cadastro.css">

</head>

<body>
<div class="background-logo"></div>
  <div class="pagina">
    <header class="topo">
      <img src="assinante/assets/img/logo_amarela.png" class="logo">
        <a href="index.php" class="btn-voltar">Voltar</a>
    </header>

  <div class="cadastro-box">
    <div class="titulo">
      <h1>Criar sua conta</h1>
        <p>Faça parte da comunidade Gospel Chords 🎸</p>
      </div>
  
      <form class="form-cadastro" action="api/cadastrarUsuario.php" method="POST" enctype="multipart/form-data">
        <div class="campos">
          <div class="campo">
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Digite seu nome" required>
          </div>

    <div class="campo">
      <label>Email</label>
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
      </div>

    <div class="campo">
      <label>Senha</label>
      <input 
        type="password"name="senha" placeholder="Crie uma senha" required>
      </div>

    <div class="campo">
      <label>Celular</label>
      <input 
        type="tel" id="celular" name="celular" maxlength="15" placeholder="(83) 99999-9999" required>
    </div>

    <div class="campo">
      <label>
        Cidade
      </label>
      <input type="text" name="cidade" placeholder="Sua cidade">
    </div>

    <div class="campo">
      <label>Estado</label>
        <input type="text" name="estado" placeholder="Seu estado">
    </div>

      <div class="campo foto">
        <label>Foto de perfil</label>
        <input type="file" name="foto"accept="image/*">
      </div>
    </div>

    <div class="campo">
    <label>Escolha seu plano</label>
      <div class="planos">
        <label class="plano">
          <input type="radio" name="plano" value="1" required>
            <span>
                Básico
            </span>
        </label>

        <label class="plano">
          <input type="radio" name="plano" value="2">
            <span>
                Curso Completo
            </span>
        </label>
      </div>
    </div>

    <div class="acoes">
        <button type="submit" class="btn-criar">
          Criar conta
        </button>

          <a href="index.php" class="btn-cancelar">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>

  <script src="js/functions.js"></script>

</body>
</html>
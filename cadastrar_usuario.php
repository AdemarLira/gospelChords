<?php
include_once("api/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cadastro1.css">
  <title>Cadastrar Usuário</title>
</head>
<body>
    <div id="background">
      <video loop autoplay muted>
        <source src="mp4/cadastrar.mp4" type="video/mp4">
      </video>
    </div>
<!-- CABEÇALHO -->
      <div class="custom-container">
        <div id="cabecalho">
          <div id="conteudo-cabecalho">
            <h1>Cadastrar usuário</h1>
          </div>
        </div>
<!-- COLUNA DO FORMULÁRIO -->
      <div class="coluna-formulario">
        <div class="coluna-formulario">
        <form class="form-login" action="api/cadastrarUsuario.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario();">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
            </div>
            <div class="form-group">
              <label for="celular">Celular</label>
              <input type="tel" id="celular" name="celular" maxlength="15" placeholder="(11) 91234-5678" required>
            </div>
            <div class="form-group">
              <label for="cidade">Cidade</label>
              <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade">
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
              <input type="text" id="estado" name="estado" placeholder="Digite seu estado">
            </div>
            <div class="form-group">
              <label for="foto">Foto</label>
              <input type="file" id="foto" name="foto" accept="image/*">
            </div>

            <div class="form-actions">
              <button type="submit" class="custom-save-button">Salvar</button>
              <button type="button" class="custom-cancel-button" onclick="voltarIndex()">Retornar</button>
            </div>
          </form>
        </div>
      </div>
    <script src="js/functions.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const celularInput = document.getElementById('celular');

        celularInput.addEventListener('input', function (e) {
          let valor = e.target.value.replace(/\D/g, ''); // só números

          if (valor.length > 11) valor = valor.slice(0, 11);

          let formatado = '';
          if (valor.length > 0) {
            formatado += '(' + valor.substring(0, 2);
          }
          if (valor.length >= 3) {
            formatado += ') ' + valor.substring(2, 7);
          }
          if (valor.length >= 8) {
            formatado += '-' + valor.substring(7, 11);
          }
          e.target.value = formatado;
        });

        // Validação ao tentar enviar o formulário
        const form = document.querySelector('.form-login');
        form.addEventListener('submit', function (e) {
          const celular = celularInput.value.replace(/\D/g, ''); // remove máscara
          if (celular.length !== 11) {
            alert('Por favor, insira um número de celular válido com DDD (ex: (11) 98765-4321)');
            e.preventDefault(); // impede o envio
          }
        });
      });
    </script>
</body>
</html>
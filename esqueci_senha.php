<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gospel Chords</title>
  <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">
  <link href="assets/css/esqueciSenha.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body>
  <div id="background">
    <video loop autoplay muted>
      <source src="assets/mp4/violao.mp4" type="video/mp4">
    </video>
  </div>
  
    <div class="header">
      <div class="navigation_social">
        <a href="https://wa.me/5583998603238" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://www.instagram.com/ademarlneto" target="_blank">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/@ademarlneto" target="_blank">
          <i class="fab fa-youtube"></i>
        </a>
        <a href="https://www.tiktok.com/@ademarliraneto" target="_blank">
          <i class="fab fa-tiktok"></i> 
        </a>
      </div>
    </div>
 <!-- COLUNA DO FORMULÁRIO -->
    <div class="coluna-formulario">
      <form class="form-login" method="POST" action="api/esqueci_senha.php">
        <h3 class="mb-4">Atualizar senha</h3>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" placeholder="Digite seu e-mail" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Enviar
        </button>
      </form>
    </div>
  </div>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true
    });
  </script>
  <script src="assets/js/functions.js"></script>
  <?php if(isset($_GET['status'])): ?>

<!-- Modal Bootstrap -->
<div class="modal fade show" id="modalSenha" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <?php 
            echo ($_GET['status'] == 'sucesso') 
              ? 'E-mail enviado' 
              : 'Erro ao recuperar senha';
          ?>
        </h5>
      </div>
      <div class="modal-body">
        <?php if($_GET['status'] == 'sucesso'): ?>
          <p>Enviamos instruções para redefinir sua senha no seu e-mail.</p>
        <?php elseif($_GET['status'] == 'nao_encontrado'): ?>
          <p>Não encontramos esse e-mail cadastrado.</p>
        <?php else: ?>
            <p>Ocorreu um erro ao enviar o e-mail. Tente novamente.</p>
        <?php endif; ?>
      </div>

      <div class="modal-footer">
        <a href="index.php" class="btn btn-primary">Voltar ao login</a>
          <button class="btn btn-secondary" onclick="document.getElementById('modalSenha').style.display='none'">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
</body>
</html>
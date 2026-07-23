<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gospel Chords</title>

  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="assets/css/index1.css" rel="stylesheet">
</head>
<body>

<!-- BACKGROUND _____________________________________________________________________________-->
<div id="background">
  <video autoplay muted loop playsinline>
    <source src="assets/mp4/violao.mp4" type="video/mp4">
  </video>
</div>
<!-- HEADER SOCIAL __________________________________________________________________________-->
<div class="header">
  <div class="navigation_social">
    <a href="https://wa.me/5583998603238" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <a href="https://www.instagram.com/ademarlneto" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://www.youtube.com/@ademarlneto" target="_blank"><i class="fab fa-youtube"></i></a>
    <a href="https://www.tiktok.com/@ademarliraneto" target="_blank"><i class="fab fa-tiktok"></i> </a>
  </div>
</div>

<!-- CONTEÚDO PRINCIPAL -->
<main class="container-fluid pagina">

    <div class="row w-100 align-items-center justify-content-center g-5">

        <!-- INFORMAÇÕES -->
        <div class="col-12 col-lg-6 coluna-infos">

            <section class="main_info">

                <h1>
                    Bem-vindo ao Gospel Chords!
                </h1>

                <p>
                    Que você possa ser abençoado e abençoar vidas.
                </p>

                <p>
                    Funcionalidades disponíveis:
                </p>

                <div class="funcionalidades">

                    <div class="box">
                        Cifras
                    </div>

                    <div class="box">
                        Tablaturas
                    </div>

                    <div class="box">
                        Partituras
                    </div>

                </div>

                <button
                    type="button"
                    class="verificar-planos"
                    onclick="verificarPlanos()">

                    Conheça nossos planos

                </button>

            </section>

        </div>


        <!-- LOGIN -->
        <div class="col-12 col-md-8 col-lg-5 col-xl-4 coluna-formulario">

            <form
                class="form-login"
                action="api/auth/login.php"
                method="POST">

                <h3 class="mb-4">
                    Login
                </h3>


                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label">

                        E-mail

                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        name="email"
                        value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>"
                        autocomplete="email"
                        required>

                </div>


                <div class="mb-3">

                    <label
                        for="senha"
                        class="form-label">

                        Senha

                    </label>

                    <input
                        type="password"
                        id="senha"
                        class="form-control"
                        name="senha"
                        autocomplete="current-password"
                        required>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary w-100">

                    Entrar

                </button>


                <div class="text-center mt-3">

                    <a href="esqueci_senha.php">
                        Esqueceu a senha?
                    </a>

                </div>


                <div class="text-center mt-2">

                    <a href="cadastrar_usuario.php">
                        Criar conta
                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

<!--MODAL DE ERRO NO LOGIN________________________________________________________-->
<div class="modal fade" id="modalErroLogin" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <?php
          if (isset($_GET['erro'])) {
              switch ($_GET['erro']) {
                  case 'logout':
                      echo "Sessão encerrada";
                      break;
                  case 'pendente':
                      echo "Cadastro pendente";
                      break;
                  case 'inativo':
                      echo "Conta inativa";
                      break;
                  case 'suspenso':
                      echo "Conta suspensa";
                      break;
                  default:
                      echo "Erro no login";
              }
            }
          ?>
      </h5>
    </div>

      <div class="modal-body">
        <?php if(isset($_GET['erro']) && $_GET['erro'] == 'usuario'): ?>
          <p>Não existe cadastro com esse e-mail.</p>
        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'senha'): ?>
          <p>Senha incorreta. Tente novamente.</p>
        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'pendente'): ?>
          <p>Seu cadastro já foi realizado com sucesso! 🎉</p>
          <p>Agora ele está aguardando aprovação do administrador.
              Seu acesso será liberado em breve.</p>
        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'inativo'): ?>
          <p>Sua conta está inativa.</p>
          <p>Entre em contato com o administrador para obter mais informações.</p>
        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'logout'): ?>
          <p>Já está indo embora? 😄</p>
          <p>Não esqueça de praticar!</p> 
        <?php endif; ?>
      </div>

    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <?php if(isset($_GET['erro']) && ($_GET['erro'] == 'usuario' || $_GET['erro'] == 'senha')): ?>
          <a href="cadastrar_usuario.php" class="btn btn-primary">Criar conta</a>

        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'pendente'): ?>
          <?php $email = isset($_GET['email']) ? urlencode($_GET['email']) : ''; 
                $mensagem = urlencode(
            "Olá! Realizei meu cadastro no Gospel Chords.\nMeu e-mail é: {$email}\nGostaria de saber sobre a aprovação da minha conta.");?>
                 <a href="https://wa.me/5583998603238?text=<?= $mensagem ?>"target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i>
                    Falar no WhatsApp
                  </a>
               
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php if(isset($_GET['erro'])): ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let modal = new bootstrap.Modal(document.getElementById("modalErroLogin"));
    modal.show();
  });
</script>

<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/functions.js"></script>

</body>
</html>

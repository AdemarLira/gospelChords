<?php
  require_once __DIR__ . '/../app/config/database.php';

  $sqlPlanos = "SELECT id, nome FROM planos
                    WHERE status = 'ativo'
                    ORDER BY id";

$resultPlanos = mysqli_query($conn, $sqlPlanos);

if (!$resultPlanos) {
    die("Erro ao carregar os planos: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Criar conta | Gospel Chords</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/cadastro.css">
<link rel="icon" type="image/x-icon" href="assets/img/logo.png">
</head>

<body>
<div class="background-logo"></div>
  <div class="pagina">
    <header class="topo">
      <img src="assets/img/logo_amarela.png" class="logo">
        <a href="index.php" class="btn-voltar">Voltar</a>
    </header>

        <div class="cadastro-box">
          <div class="titulo">
            <h1>Criar sua conta</h1>
              <p>Faça parte da comunidade Gospel Chords 🎸</p>
          </div>
  
					<form class="form-cadastro" action="cadastrar.php" method="POST" enctype="multipart/form-data">
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
                <input type="password"name="senha" placeholder="Crie uma senha" required>
              </div>

              <div class="campo">
                <label>Celular</label>
                  <input type="text" name="celular" id="celular" class="form-control" maxlength="15" placeholder="(83) 99999-9999" required>
              </div>
            </div>

            <div class="linha">
							<div class="campo">
								<label>Estado</label>
									<select id="estado" name="estado" required>
										<option value="">Selecione um estado</option>
									</select>
								</div>

								<div class="campo" id="campo-cidade" style="display:none;">
									<label>Cidade</label>
										<select id="cidade" name="cidade" required>
											<option value="">Selecione uma cidade</option>
										</select>
								</div>
						
									<div class="campo foto">
										<label>Foto de perfil</label>
											<input type="file" name="foto"accept="image/*">
									</div>
								</div>

              <div class="campo">
                <label for="plano">Escolha seu plano</label>

                <select name="plano" id="plano" class="form-select" required>
                    <option value="">Selecione um plano</option>

                    <?php while ($plano = mysqli_fetch_assoc($resultPlanos)): ?>
                        <option value="<?= (int) $plano['id'] ?>">
                            <?= htmlspecialchars($plano['nome']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
             </div>

            <div class="campo">
                <label for="forma_pagamento">Forma de pagamento</label>

                <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
                    <option value="">Selecione uma forma de pagamento</option>
                    <option value="pix">Pix</option>
                    <option value="cartao">Cartão</option>
                    <option value="boleto">Boleto</option>
                </select>
            </div>
              
              <div class="acoes">
                <button type="submit" class="btn-criar">Criar conta</button>
                  <a href="index.php" class="btn-cancelar">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
    </div>

<?php if (isset($_GET['erro']) && $_GET['erro'] === 'email_existente'): ?>

<div class="modal fade" id="modalEmailExistente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    E-mail já cadastrado
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Já existe uma conta cadastrada com este e-mail.
                </p>

                <p>
                    Utilize outro endereço de e-mail ou faça login
                    para acessar sua conta.
                </p>

            </div>

            <div class="modal-footer">

                <a
                    href="index.php"
                    class="btn btn-primary">

                    Fazer login

                </a>

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Usar outro e-mail

                </button>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const elementoModal =
        document.getElementById("modalEmailExistente");

    if (elementoModal) {

        const modal =
            new bootstrap.Modal(elementoModal);

        modal.show();

    }

});

</script>

<?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/functions.js"></script> 
  <script src="assets/js/cadastro.js"></script>
</body>
</html>
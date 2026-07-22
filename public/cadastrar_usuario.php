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
  
					<form class="form-cadastro" action="api/cadastrar_usuario.php" method="POST" enctype="multipart/form-data">
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
              <label>Escolha seu plano</label>
                <div class="mb-3">
									<label class="form-label">Tipo de acesso</label>
									<select name="plano" class="form-select" required>
										<option value="">Selecione um plano</option>
                        <?php while($plano = mysqli_fetch_assoc($resultPlanos)): ?>
                            <option value="<?= $plano['id'] ?>">
                                <?= htmlspecialchars($plano['nome']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <label class="form-label">Forma de pagamento</label>
                  <select name="forma_pagamento" class="form-select">
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
  <script src="assets/js/functions.js"></script> 
  <script src="assets/js/cadastro.js"></script>
</body>
</html>
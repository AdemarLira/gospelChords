<?php

require_once __DIR__ . '/../app/config/config.php';


$token = $_GET['token'];

$sql = "SELECT id_usuario
        FROM usuarios
        WHERE reset_token = ?
        AND reset_expira > NOW()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
	die("Este link é inválido ou expirou.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Redefinir Senha</title>
	<link rel="icon" type="image/x-icon" href="../assets/img/logo.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/esqueci_senha.css">

</head>

<body>

	<div id="background">
		<video autoplay muted loop>
			<source src="../assets/mp4/violao.mp4" type="video/mp4">
		</video>
	</div>

	<div class="container vh-100 d-flex justify-content-center align-items-center">
		<div class="card shadow p-4" style="max-width:450px;width:100%;">
			<h3 class="text-center mb-4">
				Nova Senha
			</h3>
			<form action="api/atualizar_senha.php" method="POST">
				<input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
				<div class="mb-3">
					<label class="form-label">
						Nova senha
					</label>
					<input type="password" class="form-control" name="senha" id="senha" required minlength="8">
				</div>

				<div class="mb-3">
					<label class="form-label">
						Confirmar senha
					</label>
					<input type="password" class="form-control" id="confirmar" required>
				</div>

				<button class="btn btn-primary w-100">Atualizar senha</button>
			</form>
		</div>
	</div>

	<script>
		const senha = document.getElementById('senha');
		const confirmar = document.getElementById('confirmar');

		confirmar.addEventListener('input', function() {
			if (confirmar.value !== senha.value) {
				confirmar.setCustomValidity("As senhas não coincidem.");
			} else {
				confirmar.setCustomValidity("");
			}
		});
	</script>

</body>
</html>
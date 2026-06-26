<?php
include('api/conexao.php');

if (!isset($_GET['token'])) {
    die("Token inválido.");
}

$token = $_GET['token'];

$sql = "SELECT id FROM usuarios WHERE reset_token = ? AND reset_expira > NOW()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows != 1) {
    die("Link expirado ou inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card p-4" style="width: 350px;">

  <h4 class="mb-3 text-center">Criar nova senha</h4>

  <form method="POST" action="api/atualizar_senha.php">

    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

    <div class="mb-3">
      <label>Nova senha</label>
      <input type="password" name="senha" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">
      Atualizar senha
    </button>

  </form>

</div>

</body>
</html>
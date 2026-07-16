<?php
require_once(__DIR__ . "/includes/verifica_admin.php");
include('../api/conexao.php');

include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");
include(__DIR__ . "/includes/tabela_cifras.php");

$nomeMusica = $_GET['nome_musica'] ?? '';
$status = $_GET['status'] ?? '';
$tipo = $_GET['tipo'] ?? '';



$sqlTotal = "SELECT COUNT(*) AS total
             FROM cifras";

$resultadoTotal = $conn->query($sqlTotal);

$totalCifras = $resultadoTotal->fetch_assoc()['total'];


$sql = "
SELECT
    cifras.id,
    cifras.nome_musica,
    cifras.autor,
    cifras.versao,
    cifras.tipo,
    cifras.arquivo,
    cifras.status,
    cifras.data_envio,

    usuarios.nome AS usuario

FROM cifras

INNER JOIN usuarios
ON usuarios.id = cifras.id_usuario

WHERE 1=1
";


if(!empty($nomeMusica)){

    $nomeMusica = $conn->real_escape_string($nomeMusica);

    $sql .= " AND nome_musica LIKE '%$nomeMusica%'";

}

if(!empty($status)){

    $status = $conn->real_escape_string($status);

    $sql .= " AND cifras.status='$status'";

}

if(!empty($tipo)){

    $tipo = $conn->real_escape_string($tipo);

    $sql .= " AND cifras.tipo='$tipo'";

}

$sql .= " ORDER BY data_envio DESC";

$resultado = $conn->query($sql);
?>


<div class="container-fluid mt-4">

<div class="card shadow">

<div class="card-header">

<h4>
📄 Gerenciamento de Cifras

<span class="badge bg-primary">

<?= $totalCifras ?>

</span>

</h4>

</div>

<form method="GET" class="row g-2 mb-3">

<div class="col-md-4">

<input
type="text"
class="form-control"
name="nome_musica"
placeholder="Pesquisar música..."
value="<?= htmlspecialchars($nomeMusica) ?>">

</div>

<div class="col-md-3">

<select name="tipo" class="form-select">

<option value="">Todos os tipos</option>

<option value="cifra">Cifra</option>

<option value="tablatura">Tablatura</option>

<option value="partitura">Partitura</option>

</select>

</div>

<div class="col-md-3">

<select name="status" class="form-select">

<option value="">Todos</option>

<option value="pendente">Pendente</option>

<option value="aprovada">Aprovada</option>

<option value="rejeitada">Rejeitada</option>

</select>

</div>

<div class="col-md-1">

<button class="btn btn-primary w-100">

Filtrar

</button>

</div>

<div class="col-md-1">

<a href="cifras.php"
class="btn btn-secondary w-100">

Limpar

</a>

</div>

</form>

<?php renderTabelaCifras($resultado);
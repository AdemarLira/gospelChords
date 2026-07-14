<?php
require_once(__DIR__ . "/includes/verifica_admin.php");
include('../api/conexao.php');

include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");
include(__DIR__ . "/includes/tabela_usuarios.php");

//==================== TOTAL ALUNOS ====================

$sqlTotalAlunos = "SELECT COUNT(*) AS total
                   FROM usuarios
                   WHERE tipo_usuario='aluno'";

$resultadoTotalAlunos = $conn->query($sqlTotalAlunos);
$totalAlunos = $resultadoTotalAlunos->fetch_assoc()['total'];

//==================== LISTA ALUNOS ====================

$sqlAlunos = "SELECT id, nome, email, status, img
              FROM usuarios
              WHERE tipo_usuario='aluno'
              ORDER BY nome";

$resultadoAlunos = $conn->query($sqlAlunos);

//==================== TOTAL ASSINANTES ====================

$sqlTotalAssinantes = "SELECT COUNT(*) AS total
                       FROM usuarios
                       WHERE tipo_usuario='assinante'";

$resultadoTotalAssinantes = $conn->query($sqlTotalAssinantes);
$totalAssinantes = $resultadoTotalAssinantes->fetch_assoc()['total'];

//==================== LISTA ASSINANTES ====================

$sqlAssinantes = "SELECT id, nome, email, status, img
                  FROM usuarios
                  WHERE tipo_usuario='assinante'
                  ORDER BY nome";

$resultadoAssinantes = $conn->query($sqlAssinantes);
?>

<div class="container-fluid mt-4">
	<div class="card shadow">
		<ul class="nav nav-tabs mb-3" id="usuariosTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="alunos-tab"
                data-bs-toggle="tab"
                data-bs-target="#alunos"
                type="button">
            👨‍🎓 Alunos
            <span class="badge bg-primary"><?= $totalAlunos ?></span>
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="assinantes-tab"
                data-bs-toggle="tab"
                data-bs-target="#assinantes"
                type="button">

            ⭐ Assinantes
            <span class="badge bg-success"><?= $totalAssinantes ?></span>
        </button>
    </li>
</ul>	

<div class="card-body">
    <div class="tab-content">
        <!-- ================= ALUNOS ================= -->
      <div class="tab-pane fade show active" id="alunos">
				<div class="row mb-3">
					<div class="col-md-4">
							<input class="form-control" placeholder="Pesquisar aluno...">
					</div>
				</div>
			<?php renderTabelaUsuarios($resultadoAlunos); ?>
		</div>
        <!-- ================= ASSINANTES ================= -->
      <div class="tab-pane fade" id="assinantes">
				<div class="row mb-3">
					<div class="col-md-4">
							<input class="form-control" placeholder="Pesquisar assinante...">
					</div>
   		 </div>
    	<?php renderTabelaUsuarios($resultadoAssinantes); ?>
		</div>
  </div>
</div>

<?php include(__DIR__ . "/includes/footer_adm.php");?>



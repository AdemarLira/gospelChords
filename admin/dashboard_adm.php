<?php

include('../api/conexao.php');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=naoautorizado");
    exit();
}


require_once(__DIR__ . "/includes/verifica_admin.php");
include("includes/dashboard_adm_consultas.php");
include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");
?>

<div class="container-fluid mt-4">
	<h2 class="mb-4">
		Dashboard Administrativo
	</h2>

	<div class="row g-4">
    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>👨‍🎓 Alunos</h5>
					<h2><?=$totalAlunos?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>💳 Assinantes</h5>
					<h2><?= $totalAssinantes ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>📚 Cursos</h5>
					<h2><?= $totalCursos ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>🎼 Cifras</h5>
					<h2><?= $totalCifras ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>🎸 Tablaturas</h5>
					<h2><?= $totalTablaturas ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>🎼 Partituras</h5>
					<h2><?= $totalPartituras ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>✅ Usuários Ativos</h5>
					<h2><?= $totalAtivos ?></h2>
				</div>
			</div>
    </div>

    <div class="col-lg-3 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-body text-center">
					<h5>⏳ Pendentes</h5>
					<h2><?= $totalPendentes ?></h2>
				</div>
			</div>
    </div>

</div>
<?php include(__DIR__ . "/includes/footer_adm.php");?>
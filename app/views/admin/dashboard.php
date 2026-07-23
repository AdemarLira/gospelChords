<?php

$totalAlunos = $dados['totalAlunos'];
$totalAssinantes = $dados['totalAssinantes'];
$totalCursos = $dados['totalCursos'];
$totalCifras = $dados['totalCifras'];
$totalTablaturas = $dados['totalTablaturas'];
$totalPartituras = $dados['totalPartituras'];
$totalAtivos = $dados['totalAtivos'];
$totalPendentes = $dados['totalPendentes'];

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/menu_adm.php';

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
<?php

require_once __DIR__ . '/../layouts/footer.php';
?>
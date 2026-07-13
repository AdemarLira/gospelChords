<?php

include('../api/conexao.php');


// Quantidade total de alunos
$sqlAlunos = "SELECT COUNT(*) AS total FROM usuarios WHERE tipo_usuario='aluno'";
$resultadoAlunos = $conn->query($sqlAlunos);
$totalAlunos = $resultadoAlunos->fetch_assoc()['total'];

// Quantidade total de assinantes
$sqlAssinantes = "SELECT COUNT(*) AS total FROM usuarios WHERE tipo_usuario='assinante'";
$resultadoAssinantes = $conn->query($sqlAssinantes);
$totalAssinantes = $resultadoAssinantes->fetch_assoc()['total'];

require_once(__DIR__ . "/includes/verifica_admin.php");
include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");

?>

<div class="container-fluid mt-4">
	<h2 class="mb-4">
		Dashboard Administrativo
	</h2>

	<div class="row">
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h5>Total de Alunos</h5>
					<h3><?php echo $totalAlunos; ?></h3>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h5>Assinantes</h5>
					<h3><?php echo $totalAssinantes; ?></h3>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
						<h5>Cursos</h5>
						<h2>0</h2>
				</div>
			</div>
		</div>

	<div class="col-md-3">
		<div class="card shadow-sm">
			<div class="card-body">
					<h5>Cifras</h5>
					<h2>0</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include(__DIR__ . "/includes/footer_adm.php");?>
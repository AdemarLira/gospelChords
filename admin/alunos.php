<?php
require_once(__DIR__ . "/includes/verifica_admin.php");
include('../api/conexao.php');

include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");

// Quantidade total
$sqlAlunos = "SELECT COUNT(*) AS total
              FROM usuarios
              WHERE tipo_usuario='aluno'";

$resultadoAlunos = $conn->query($sqlAlunos);
$totalAlunos = $resultadoAlunos->fetch_assoc()['total'];

$sql = "SELECT id, nome, email, status, img
        FROM usuarios
        WHERE tipo_usuario='aluno'
        ORDER BY nome";

$resultado = $conn->query($sql);

?>

<div class="container-fluid mt-4">
	<div class="card shadow">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h4 class="mb-0">
					<i class="fas fa-user-graduate"></i>
					Gerenciamento de Alunos
			</h4>
			<span class="badge bg-primary fs-6">
					Total: <?= $totalAlunos; ?>
			</span>
	</div>
		<div class="card-body">
		<!-- Pesquisa -->
			<div class="row mb-3">
				<div class="col-md-4">
						<input
								type="text"
								class="form-control"
								placeholder="Pesquisar aluno...">
				</div>
			</div>
		<!-- Tabela -->
			<div class="table-responsive">
			<table class="table table-hover align-middle">
				<thead class="table-dark">
					<tr>
						<th>Foto</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>

						<tbody>
							<?php while($aluno = $resultado->fetch_assoc()): ?>
							<tr>
								<td>
									<td>
										<?php
											if (!empty($aluno['img'])) {
													$foto = "../assets/img/perfil/" . $aluno['img'];
											} else {
													$foto = "../assets/img/images.jpg";
											}										
											?>

										<img src="<?= $foto; ?>"
												alt="Foto do aluno"
												width="45"
												height="45"
												class="rounded-circle"
												style="object-fit: cover;">
									</td>
							
										<td><?= htmlspecialchars($aluno['nome']); ?></td>
										<td><?= htmlspecialchars($aluno['email']); ?></td>
										<td>
													<?php switch($aluno['status']){
																case 'ativo':
																		echo '<span class="badge bg-success">Ativo</span>';
																		break;
																case 'pendente':
																		echo '<span class="badge bg-warning text-dark">Pendente</span>';
																		break;
																case 'inativo':
																		echo '<span class="badge bg-danger">Inativo</span>';
																		break;
														}?>
											</td>
										<td>
									<button class="btn btn-sm btn-primary">
										<i class="fas fa-edit"></i>Editar</button>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>




<?php
require_once(__DIR__ . "/includes/verifica_admin.php");
include('../api/conexao.php');

include(__DIR__ . "/includes/header_adm.php");
include(__DIR__ . "/includes/menu_adm.php");
include(__DIR__ . "/includes/tabela_usuarios.php");

//==================== TOTAL ALUNOS ====================
$nomeAluno = $_GET['nome_aluno'] ?? '';
$statusAluno = $_GET['status_aluno'] ?? '';

$sqlTotalAlunos = "SELECT COUNT(*) AS total
                   FROM usuarios
                   WHERE tipo_usuario='aluno'";

$resultadoTotalAlunos = $conn->query($sqlTotalAlunos);
$totalAlunos = $resultadoTotalAlunos->fetch_assoc()['total'];

$nomeAssinante = $_GET['nome_assinante'] ?? '';
$statusAssinante = $_GET['status_assinante'] ?? '';

//==================== LISTA ALUNOS ====================
$sqlAlunos = "SELECT
								id,
								nome,
								email,
								celular,
								cidade,
								estado,
								status,
								tipo_usuario,
								img
							FROM usuarios
							WHERE tipo_usuario='aluno'";

	if (!empty($nomeAluno)) {
    $nomeAluno = $conn->real_escape_string($nomeAluno);
    $sqlAlunos .= " AND nome LIKE '%$nomeAluno%'";
	}

	if (!empty($statusAluno)) {
    $statusAluno = $conn->real_escape_string($statusAluno);
    $sqlAlunos .= " AND status = '$statusAluno'";
	}

$sqlAlunos .= " ORDER BY nome";
$resultadoAlunos = $conn->query($sqlAlunos);

//==================== TOTAL ASSINANTES ====================
$sqlTotalAssinantes = "SELECT COUNT(*) AS total
                       FROM usuarios
                       WHERE tipo_usuario='assinante'";

$resultadoTotalAssinantes = $conn->query($sqlTotalAssinantes);
$totalAssinantes = $resultadoTotalAssinantes->fetch_assoc()['total'];

//==================== LISTA ASSINANTES ====================
$sqlAssinantes = "SELECT
						id,
						nome,
						email,
						celular,
						cidade,
						estado,
						status,
						tipo_usuario,
						img
					FROM usuarios
					WHERE tipo_usuario='assinante'";


	if (!empty($nomeAssinante)) {
    $nomeAssinante = $conn->real_escape_string($nomeAssinante);
    $sqlAssinantes .= " AND nome LIKE '%$nomeAssinante%'";
	}

	if (!empty($statusAssinante)) {
    $statusAssinante = $conn->real_escape_string($statusAssinante);
    $sqlAssinantes .= " AND status = '$statusAssinante'";
	}


$sqlAssinantes .= " ORDER BY nome";

$resultadoAssinantes = $conn->query($sqlAssinantes);
?>

<div class="container-fluid mt-4">
	<div class="card shadow">
		<ul class="nav nav-tabs mb-3" id="usuariosTab" role="tablist">

			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="alunos-tab" data-bs-toggle="tab" data-bs-target="#alunos" type="button">
						👨‍🎓 Alunos
					<span class="badge bg-primary"><?= $totalAlunos ?></span>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="assinantes-tab" data-bs-toggle="tab" data-bs-target="#assinantes" type="button"> 
						⭐ Assinantes
					<span class="badge bg-success"><?= $totalAssinantes ?></span>
				</button>
			</li>	
		</ul>	

<!-- ================= assinantes ================= -->
<div class="card-body">
  <div class="tab-content"> 
		<div class="tab-pane fade show active" id="alunos">
			<form method="GET" class="row g-2 mb-3">
				<div class="col-md-4">
					<input type="text" name="nome_aluno" class="form-control" placeholder="Pesquisar aluno..." value="<?= htmlspecialchars($_GET['nome_aluno'] ?? '') ?>">
				</div>

				<div class="col-md-3">
					<select name="status_aluno" class="form-select">
						<option value="">Todos os status</option>
						<option value="ativo" <?= ($_GET['status_aluno'] ?? '') == 'ativo' ? 'selected' : '' ?>>Ativo</option>
						<option value="pendente" <?= ($_GET['status_aluno'] ?? '') == 'pendente' ? 'selected' : '' ?>>Pendente</option>
						<option value="suspenso" <?= ($_GET['status_aluno'] ?? '') == 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
						<option value="expirado" <?= ($_GET['status_aluno'] ?? '') == 'expirado' ? 'selected' : '' ?>>Expirado</option>
						<option value="cancelado" <?= ($_GET['status_aluno'] ?? '') == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
					</select>
				</div>

				<div class="col-md-2">
					<button type="submit" class="btn btn-primary w-100">Filtrar</button>
				</div>
				<div class="col-md-2">
					<a href="usuarios.php" class="btn btn-secondary w-100">
							Limpar
					</a>
				</div>
			</form>
		<?php renderTabelaUsuarios($resultadoAlunos); ?>
</div>


<div class="tab-pane fade" id="assinantes">
	<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="nome_assinante" class="form-control" placeholder="Pesquisar assinante..." value="<?= htmlspecialchars($_GET['nome_assinante'] ?? '') ?>">
    </div>

    <div class="col-md-3">
			<select name="status_assinante" class="form-select">
				<option value="">Todos os status</option>
				<option value="ativo"<?= ($_GET['status_assinante'] ?? '') == 'ativo' ? 'selected' : '' ?>>Ativo</option>
				<option value="pendente"<?= ($_GET['status_assinante'] ?? '') == 'pendente' ? 'selected' : '' ?>>Pendente</option>
				<option value="suspenso"<?= ($_GET['status_assinante'] ?? '') == 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
				<option value="expirado"<?= ($_GET['status_assinante'] ?? '') == 'expirado' ? 'selected' : '' ?>>Expirado</option>
				<option value="cancelado"<?= ($_GET['status_assinante'] ?? '') == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
			</select>
    </div>
	
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary w-100">
						Filtrar
				</button>
			</div>
			<div class="col-md-2">
				<a href="usuarios.php" class="btn btn-secondary w-100">
						Limpar
				</a>
			</div>
		</form>
		<?php renderTabelaUsuarios($resultadoAssinantes); ?>
	</div>


<script>
	document.addEventListener('DOMContentLoaded', function () {
			// Recupera a aba salva
		let abaSalva = localStorage.getItem('abaUsuarios');
			if (abaSalva) {
				let botao = document.querySelector(
						'button[data-bs-target="' + abaSalva + '"]'
					);
					if (botao) {
							new bootstrap.Tab(botao).show();
					}
			}
			// Sempre que trocar de aba, salva
			document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(tab){
				tab.addEventListener('shown.bs.tab', function(e){
					localStorage.setItem(
							'abaUsuarios',
							e.target.getAttribute('data-bs-target')
					);
				});
			});
	});
</script> 

	<div class="modal fade" id="modalEditar" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="editar_usuario.php" method="POST">
					<div class="modal-header">
						<h5 class="modal-title">Editar Usuário</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

				<div class="modal-body">
					<input type="hidden" name="id" id="editar_id">
						<div class="mb-3">
							<label>Nome</label>
							<input type="text" class="form-control" name="nome" id="editar_nome">
						</div>
						<div class="mb-3">
							<label>Email</label>
							<input type="email" class="form-control" name="email" id="editar_email">
						</div>
						<div class="mb-3">
							<label>Celular</label>
							<input type="text" name="celular" id="editar_celular" class="form-control" maxlength="15" placeholder="(83) 99999-9999">
						</div>
						<div class="mb-3">
							<label>Cidade</label>
							<input type="text" class="form-control" name="cidade" id="editar_cidade">
						</div>
						<div class="mb-3">
							<label>Estado</label>
							<input type="text" class="form-control" name="estado" id="editar_estado">
						</div>
						<div class="mb-3">
							<label>Status</label>
							<select class="form-select" name="status" id="editar_status">
								<option value="ativo">Ativo</option>
								<option value="pendente">Pendente</option>
								<option value="suspenso">Suspenso</option>
								<option value="expirado">Expirado</option>
								<option value="cancelado">Cancelado</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script> 
	const modal = document.getElementById('modalEditar');

	modal.addEventListener('show.bs.modal', function(event){

		const botao = event.relatedTarget;

		document.getElementById('editar_id').value = botao.dataset.id;
		document.getElementById('editar_nome').value = botao.dataset.nome;
		document.getElementById('editar_email').value = botao.dataset.email;
		document.getElementById('editar_celular').value = botao.dataset.celular;
		document.getElementById('editar_cidade').value = botao.dataset.cidade;
		document.getElementById('editar_estado').value = botao.dataset.estado;
		document.getElementById('editar_status').value = botao.dataset.status;
	});


const campoCelular = document.getElementById('editar_celular');

campoCelular.addEventListener('input', function(){

    let valor = this.value;

    // remove tudo que não for número
    valor = valor.replace(/\D/g,'');
    // limita a 11 números
    valor = valor.substring(0,11);

    if(valor.length <= 10){
        // telefone fixo
        valor = valor.replace(
            /^(\d{2})(\d{4})(\d{0,4})/,
            '($1) $2-$3'
        );
    } else {
        // celular
        valor = valor.replace(
            /^(\d{2})(\d{5})(\d{0,4})/,
            '($1) $2-$3'
        );
    }

    this.value = valor;
});
</script>

<?php include(__DIR__ . "/includes/footer_adm.php");?>



<?php
function renderTabelaUsuarios($resultado){
	
?>

<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead class="table-dark">
			<tr>
				<th>Foto</th>
				<th>Nome</th>
				<th>Celular</th>
				<th>Email</th>
				<th>Estado</th>
				<th>Cidade</th>
				<th>Status</th>
				<th width="160">Ações</th>
			</tr>
		</thead>

    <tbody>
        <?php while($usuario = $resultado->fetch_assoc()): ?>

            <?php
            $foto = !empty($usuario['img'])
                ? "../assets/img/perfil/" . $usuario['img']
                : "../assets/img/images.jpg";
            ?>

            <tr>
							<td>
								<img src="<?= $foto ?>" width="45" height="45" class="rounded-circle" style="object-fit:cover;">
							</td>
							<td><?= htmlspecialchars($usuario['nome']) ?></td>
							<td><?= htmlspecialchars($usuario['celular']) ?></td>
							<td><?= htmlspecialchars($usuario['email']) ?></td>
							<td><?= htmlspecialchars($usuario['estado']) ?></td>
							<td><?= htmlspecialchars($usuario['cidade']) ?></td>

							<td>
              <?php

									$status = strtolower(trim($usuario['status']));

									$coresStatus = [
											'ativo'     => ['bg-success', 'text-white'],
											'pendente'  => ['bg-primary', 'text-white'],
											'suspenso'  => ['bg-warning', 'text-dark'],
											'expirado'  => ['bg-danger', 'text-white'],
											'cancelado' => ['bg-dark', 'text-white'],
											'inativo'   => ['bg-secondary', 'text-white']
									];

									$classes = $coresStatus[$status] ?? ['bg-secondary', 'text-white'];

									echo '<span class="badge ' . implode(' ', $classes) . '">'
											. ucfirst(htmlspecialchars($status)) .
											'</span>';
									?>
							</td>
							<td>

							<!-- Botão Editar -->
							<button
								class="btn btn-warning btn-sm btn-editar"
								data-bs-toggle="modal"
								data-bs-target="#modalEditar"
								data-id="<?= $usuario['id'] ?>"
								data-nome="<?= htmlspecialchars($usuario['nome']) ?>"
								data-email="<?= htmlspecialchars($usuario['email']) ?>"
								data-celular="<?= htmlspecialchars($usuario['celular']) ?>"
								data-cidade="<?= htmlspecialchars($usuario['cidade']) ?>"
								data-estado="<?= htmlspecialchars($usuario['estado']) ?>"
								data-status="<?= $usuario['status'] ?>"
								data-tipo="<?= $usuario['tipo_usuario'] ?>">

								<i class="fas fa-edit"></i> Editar

							</button>

							<!-- Botão Excluir -->
							<form
								action="excluir_usuario.php"
								method="POST"
								style="display:inline-block"
								onsubmit="return confirm('Deseja realmente excluir este usuário?');">

								<input
									type="hidden"
									name="id"
									value="<?= $usuario['id'] ?>">

								<button
									type="submit"
									class="btn btn-danger btn-sm">

									<i class="fas fa-trash"></i> Excluir

								</button>

							</form>

						</td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
}


function formatarCelular($numero){

    $numero = preg_replace('/\D/', '', $numero);

    if(strlen($numero)==11){
        return '('
            .substr($numero,0,2).') '
            .substr($numero,2,5).'-'
            .substr($numero,7,4);
    }

    if(strlen($numero)==10){
        return '('
            .substr($numero,0,2).') '
            .substr($numero,2,4).'-'
            .substr($numero,6,4);
    }

    return $numero;
}
?>
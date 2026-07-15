<?php
function renderTabelaUsuarios($resultado){
?>

<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead class="table-dark">
			<tr>
				<th>Foto</th>
				<th>Nome</th>
				<th>Email</th>
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
							<td><?= htmlspecialchars($usuario['email']) ?></td>

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
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
}
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
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal de editar -->
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
                        <input type="text" class="form-control" name="celular" id="editar_celular">
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
                            <option value="inativo">Inativo</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Salvar</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </form>

        </div>
    </div>
</div>	


<script> const botoes = document.querySelectorAll('.btn-editar');

botoes.forEach(botao => {
    botao.addEventListener('click', function () {

        document.getElementById('editar_id').value = this.dataset.id;
        document.getElementById('editar_nome').value = this.dataset.nome;
        document.getElementById('editar_email').value = this.dataset.email;
        document.getElementById('editar_celular').value = this.dataset.celular;
        document.getElementById('editar_cidade').value = this.dataset.cidade;
        document.getElementById('editar_estado').value = this.dataset.estado;
        document.getElementById('editar_status').value = this.dataset.status;

    });
});
</script>
<?php
}
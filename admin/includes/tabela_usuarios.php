<?php

function renderTabelaUsuarios($resultado)
{
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
                    <img
                        src="<?= $foto ?>"
                        width="45"
                        height="45"
                        class="rounded-circle"
                        style="object-fit:cover;">
                </td>

                <td><?= htmlspecialchars($usuario['nome']) ?></td>

                <td><?= htmlspecialchars($usuario['email']) ?></td>

                <td>

                    <?php

                    switch($usuario['status']){

                        case 'ativo':
                            echo '<span class="badge bg-success">Ativo</span>';
                            break;

                        case 'pendente':
                            echo '<span class="badge bg-warning text-dark">Pendente</span>';
                            break;

                        case 'inativo':
                            echo '<span class="badge bg-danger">Inativo</span>';
                            break;

                    }

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
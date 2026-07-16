<?php
function renderTabelaCifras($resultado){
?>

<div class="table-responsive">
    <table class="table table-hover align-middle">

        <thead class="table-dark">
            <tr>
                <th>Música</th>
                <th>Autor</th>
                <th>Tipo</th>
                <th>Enviado por</th>
                <th>Status</th>
                <th>Data</th>
                <th>Arquivo</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php while($linha = $resultado->fetch_assoc()){ ?>

            <tr>

                <td><?= htmlspecialchars($linha['nome_musica']) ?></td>

                <td><?= htmlspecialchars($linha['autor']) ?></td>

                <td><?= ucfirst($linha['tipo']) ?></td>

                <td><?= htmlspecialchars($linha['usuario']) ?></td>

                <td><?= ucfirst($linha['status']) ?></td>

                <td><?= date('d/m/Y', strtotime($linha['data_envio'])) ?></td>

                <td>
                    <a href="../uploads/cifras/<?= urlencode($linha['arquivo']) ?>" target="_blank" class="btn btn-sm btn-primary">
                        Abrir
                    </a>
                </td>

                <td>

                    <button class="btn btn-warning btn-sm">
                        Editar
                    </button>

                    <button class="btn btn-danger btn-sm">
                        Excluir
                    </button>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>
</div>

<?php
}
?>  
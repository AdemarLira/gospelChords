<?php
function renderTabelaCifras($resultado){
?>

<div class="table-responsive">
    <table class="table table-hover align-middle">

        <thead class="table-dark">
            <tr>
                <th>Música</th>
                <th>Autor</th>
                <th>Categoria</th>
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

                <td><?= htmlspecialchars($linha['titulo']) ?></td>

                <td><?= htmlspecialchars($linha['autor']) ?></td>

                <td><?= htmlspecialchars($linha['categoria']) ?></td>

                <td><?= htmlspecialchars($linha['usuario']) ?></td>

                <td>
                    <?php
                        $status = strtolower($linha['status']);

                        $cores = [
                            'pendente' => 'bg-warning text-dark',
                            'aprovada' => 'bg-success text-white',
                            'rejeitada' => 'bg-danger text-white'
                        ];
                    ?>

                    <span class="badge <?= $cores[$status] ?? 'bg-secondary' ?>">
                        <?= ucfirst($status) ?>
                    </span>
                </td>

                <td><?= date('d/m/Y', strtotime($linha['data_envio'])) ?></td>

                <td>
                    <a href="../uploads/cifras/<?= urlencode($linha['arquivo']) ?>"
                       target="_blank"
                       class="btn btn-primary btn-sm">
                        Abrir
                    </a>
                </td>

                <td>

                    <button class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </button>

                    <button class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Excluir
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
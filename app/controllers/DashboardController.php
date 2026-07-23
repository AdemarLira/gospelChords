<?php

class DashboardController
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function index(): array
    {
        return [
            'totalAlunos' => $this->contarAlunos(),
            'totalAssinantes' => $this->contarAssinantes(),
            'totalCursos' => $this->contarRegistros('cursos'),
            'totalCifras' => $this->contarRegistros('cifras'),
            'totalTablaturas' => $this->contarRegistros('tablaturas'),
            'totalPartituras' => $this->contarRegistros('partituras'),
            'totalAtivos' => $this->contarUsuariosAtivos(),
            'totalPendentes' => $this->contarUsuariosPendentes()
        ];
    }

    private function contarUsuariosPendentes(): int
        {
            $sql = "
                SELECT COUNT(*) AS total
                FROM usuarios
                WHERE status = 'pendente'
                AND tipo_usuario <> 'admin'
            ";

            return $this->executarContagem($sql);
        }

    private function contarAlunos(): int
    {
        return $this->contarUsuariosPorTipo('aluno');
    }

    private function contarAssinantes(): int
    {
        return $this->contarUsuariosPorTipo('assinante');
    }

    private function contarUsuariosPorTipo(string $tipo): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE tipo_cadastro = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                'Erro ao preparar consulta: ' . $this->conn->error
            );
        }

        $stmt->bind_param('s', $tipo);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $dados = $resultado->fetch_assoc();

        return (int) ($dados['total'] ?? 0);
    }

    private function contarUsuariosAtivos(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE status = 'ativo'
            AND tipo_usuario <> 'admin'
        ";

        return $this->executarContagem($sql);
    }

    private function contarRegistros(string $tabela): int
    {
        $tabelasPermitidas = [
            'cursos',
            'cifras',
            'tablaturas',
            'partituras'
        ];

        if (!in_array($tabela, $tabelasPermitidas, true)) {
            throw new Exception(
                'Tabela não permitida.'
            );
        }

        $sql = "SELECT COUNT(*) AS total FROM {$tabela}";

        return $this->executarContagem($sql);
    }

    private function executarContagem(string $sql): int
    {
        $resultado = $this->conn->query($sql);

        if (!$resultado) {
            throw new Exception(
                'Erro ao consultar banco: '
                . $this->conn->error
            );
        }

        $dados = $resultado->fetch_assoc();

        return (int) ($dados['total'] ?? 0);
    }
}
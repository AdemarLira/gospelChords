<?php

class Dashboard
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function totalAlunos(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE tipo_cadastro = 'aluno'
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalAssinantes(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE tipo_cadastro = 'assinante'
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalCursos(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM cursos
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalCifras(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM cifras
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalTablaturas(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM tablaturas
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalPartituras(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM partituras
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalAtivos(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE status = 'ativo'
            AND tipo_usuario <> 'admin'
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }

    public function totalPendentes(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM usuarios
            WHERE status = 'pendente'
            AND tipo_usuario <> 'admin'
        ";

        return $this->conn
            ->query($sql)
            ->fetch_assoc()['total'];
    }
}
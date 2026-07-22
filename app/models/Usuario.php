<?php

class Usuario
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function buscarPorEmail(string $email): ?array
    {
        $sql = "
            SELECT 
                u.*,
                a.id_plano
            FROM usuarios u
            LEFT JOIN assinaturas a 
                ON a.id_usuario = u.id
            WHERE u.email = ?
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro ao preparar consulta do usuário.");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows !== 1) {
            $stmt->close();
            return null;
        }

        $usuario = $resultado->fetch_assoc();

        $stmt->close();

        return $usuario;
    }
}
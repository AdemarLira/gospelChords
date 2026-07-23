<?php

class Usuario
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Busca usuário pelo e-mail.
     */
    public function buscarPorEmail(string $email): ?array
    {
        $sql = "
            SELECT 
                id,
                nome,
                email,
                senha,
                img,
                tipo_usuario,
                tipo_cadastro,
                status
            FROM usuarios
            WHERE email = ?
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar consulta de usuário: " . $this->conn->error
            );
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            return null;
        }

        return $resultado->fetch_assoc();
    }

    /**
     * Salva o token de recuperação e sua validade.
     */
    public function salvarTokenRecuperacao(
        int $idUsuario,
        string $tokenHash,
        string $expira
    ): bool {

        $sql = "
            UPDATE usuarios
            SET 
                reset_token = ?,
                reset_expira = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar atualização do token: " . $this->conn->error
            );
        }

        $stmt->bind_param(
            "ssi",
            $tokenHash,
            $expira,
            $idUsuario
        );

        return $stmt->execute();
    }

    /**
     * Busca usuário pelo token de recuperação válido.
     */
    public function buscarPorToken(string $tokenHash): ?array
    {
        $sql = "
            SELECT 
                id,
                email
            FROM usuarios
            WHERE reset_token = ?
            AND reset_expira > NOW()
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar consulta do token: " . $this->conn->error
            );
        }

        $stmt->bind_param("s", $tokenHash);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            return null;
        }

        return $resultado->fetch_assoc();
    }

    /**
     * Atualiza a senha e invalida o token.
     */
    public function atualizarSenha(
        int $idUsuario,
        string $senhaHash
    ): bool {

        $sql = "
            UPDATE usuarios
            SET 
                senha = ?,
                reset_token = NULL,
                reset_expira = NULL
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar atualização da senha: " . $this->conn->error
            );
        }

        $stmt->bind_param(
            "si",
            $senhaHash,
            $idUsuario
        );

        return $stmt->execute();
    }

    /**
     * Remove tokens antigos ou inválidos.
     */
    public function limparTokenRecuperacao(int $idUsuario): bool
    {
        $sql = "
            UPDATE usuarios
            SET 
                reset_token = NULL,
                reset_expira = NULL
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar limpeza do token: " . $this->conn->error
            );
        }

        $stmt->bind_param("i", $idUsuario);

        return $stmt->execute();
    }
}
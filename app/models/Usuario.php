<?php

class Usuario
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }


    /*
    |--------------------------------------------------------------------------
    | BUSCAR USUÁRIO POR E-MAIL
    |--------------------------------------------------------------------------
    */

    public function buscarPorEmail(
        string $email
    ): ?array {

        $sql = "
            SELECT 
                id,
                nome,
                email,
                senha,
                celular,
                cidade,
                estado,
                img,
                tipo_usuario,
                tipo_cadastro,
                status
            FROM usuarios
            WHERE email = ?
            LIMIT 1
        ";

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar consulta de usuário: "
                . $this->conn->error
            );
        }

        $stmt->bind_param(
            "s",
            $email
        );

        $stmt->execute();

        $resultado =
            $stmt->get_result();

        if (
            $resultado->num_rows
            === 0
        ) {

            return null;
        }

        return $resultado
            ->fetch_assoc();
    }


    /*
    |--------------------------------------------------------------------------
    | CRIAR USUÁRIO
    |--------------------------------------------------------------------------
    */

    public function criar(
        array $dados
    ): int {

        $sql = "
            INSERT INTO usuarios (
                nome,
                email,
                senha,
                celular,
                cidade,
                estado,
                img,
                tipo_usuario,
                tipo_cadastro,
                status
            )
            VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ";

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar cadastro: "
                . $this->conn->error
            );
        }

        $stmt->bind_param(
            "ssssssssss",

            $dados['nome'],

            $dados['email'],

            $dados['senha'],

            $dados['celular'],

            $dados['cidade'],

            $dados['estado'],

            $dados['img'],

            $dados['tipo_usuario'],

            $dados['tipo_cadastro'],

            $dados['status']
        );


        if (!$stmt->execute()) {

            /*
             * E-mail duplicado
             */

            if (
                $stmt->errno
                === 1062
            ) {

                throw new Exception(
                    "Este e-mail já está cadastrado."
                );
            }


            throw new Exception(
                "Erro ao cadastrar usuário: "
                . $stmt->error
            );
        }


        return $this->conn
            ->insert_id;
    }


    /*
    |--------------------------------------------------------------------------
    | SALVAR TOKEN DE RECUPERAÇÃO
    |--------------------------------------------------------------------------
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

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar atualização do token: "
                . $this->conn->error
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


    /*
    |--------------------------------------------------------------------------
    | BUSCAR USUÁRIO POR TOKEN
    |--------------------------------------------------------------------------
    */

    public function buscarPorToken(
        string $tokenHash
    ): ?array {

        $sql = "
            SELECT 
                id,
                email
            FROM usuarios
            WHERE reset_token = ?
            AND reset_expira > NOW()
            LIMIT 1
        ";

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar consulta do token: "
                . $this->conn->error
            );
        }

        $stmt->bind_param(
            "s",
            $tokenHash
        );

        $stmt->execute();

        $resultado =
            $stmt->get_result();

        if (
            $resultado->num_rows
            === 0
        ) {

            return null;
        }

        return $resultado
            ->fetch_assoc();
    }


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR SENHA
    |--------------------------------------------------------------------------
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

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar atualização da senha: "
                . $this->conn->error
            );
        }

        $stmt->bind_param(
            "si",
            $senhaHash,
            $idUsuario
        );

        return $stmt->execute();
    }


    /*
    |--------------------------------------------------------------------------
    | LIMPAR TOKEN DE RECUPERAÇÃO
    |--------------------------------------------------------------------------
    */

    public function limparTokenRecuperacao(
        int $idUsuario
    ): bool {

        $sql = "
            UPDATE usuarios
            SET 
                reset_token = NULL,
                reset_expira = NULL
            WHERE id = ?
        ";

        $stmt =
            $this->conn
                ->prepare($sql);

        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar limpeza do token: "
                . $this->conn->error
            );
        }

        $stmt->bind_param(
            "i",
            $idUsuario
        );

        return $stmt->execute();
    }
}
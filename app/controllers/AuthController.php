<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private AuthService $authService;

    public function __construct(mysqli $conn)
    {
        $this->authService =
            new AuthService($conn);
    }

    public function login(
        string $email,
        string $senha
    ): array {

        return $this->authService
            ->autenticar(
                $email,
                $senha
            );
    }

    public function solicitarRecuperacao(
        string $email
    ): array {

        return $this->authService
            ->solicitarRecuperacao(
                $email
            );
    }

    public function redefinirSenha(
        string $token,
        string $senha
    ): array {

        return $this->authService
            ->redefinirSenha(
                $token,
                $senha
            );
    }
}
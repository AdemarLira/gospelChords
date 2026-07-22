<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private AuthService $authService;

    public function __construct(mysqli $conn)
    {
        $this->authService = new AuthService($conn);
    }

    public function login(string $email, string $senha): array
    {
        return $this->authService->autenticar($email, $senha);
    }
}
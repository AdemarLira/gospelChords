<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthService
{
    private Usuario $usuarioModel;

    public function __construct(mysqli $conn)
    {
        $this->usuarioModel = new Usuario($conn);
    }

    public function autenticar(string $email, string $senha): array
    {
        $usuario = $this->usuarioModel->buscarPorEmail($email);

        if ($usuario === null) {
            return [
                'sucesso' => false,
                'erro' => 'usuario'
            ];
        }

        if (!password_verify($senha, $usuario['senha'])) {
            return [
                'sucesso' => false,
                'erro' => 'senha'
            ];
        }

       if ($usuario['status'] === 'pendente') {
            return [
                'sucesso' => false,
                'erro' => 'pendente'
            ];
        }

        if ($usuario['status'] === 'inativo') {
            return [
                'sucesso' => false,
                'erro' => 'inativo'
            ];
        }

        if ($usuario['status'] === 'suspenso') {
            return [
                'sucesso' => false,
                'erro' => 'suspenso'
            ];
        }

        $this->criarSessao($usuario);

        return [
            'sucesso' => true,
            'redirecionamento' => $this->obterRedirecionamento($usuario)
        ];
    }

    private function criarSessao(array $usuario): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['img'] = $usuario['img'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['tipo_cadastro'] = $usuario['tipo_cadastro'];
        $_SESSION['id_plano'] = $usuario['id_plano'];
    }

    private function obterRedirecionamento(array $usuario): string
    {
        if ($usuario['tipo_usuario'] === 'admin') {
            return '../../admin/dashboard.php';
        }

        if ($usuario['tipo_usuario'] === 'usuario') {

            if ($usuario['tipo_cadastro'] === 'aluno') {
                return '../../aluno/dashboard.php';
            }

            if ($usuario['tipo_cadastro'] === 'assinante') {
                return '../../assinante/dashboard.php';
            }
        }

        return '../../index.php?erro=plano';
    }
}
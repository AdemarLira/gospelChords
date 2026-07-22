<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/EmailService.php';

class AuthService
{
    private Usuario $usuarioModel;
    private EmailService $emailService;

    public function __construct(mysqli $conn)
    {
        $this->usuarioModel = new Usuario($conn);
        $this->emailService = new EmailService();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function autenticar(
        string $email,
        string $senha
    ): array {

        $usuario = $this->usuarioModel
            ->buscarPorEmail($email);

        if ($usuario === null) {
            return [
                'sucesso' => false,
                'erro' => 'usuario'
            ];
        }

        if (!password_verify(
            $senha,
            $usuario['senha']
        )) {
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
            'redirecionamento' =>
                $this->obterRedirecionamento($usuario)
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | RECUPERAÇÃO DE SENHA
    |--------------------------------------------------------------------------
    */

    public function solicitarRecuperacao(
        string $email
    ): array {

        $usuario = $this->usuarioModel
            ->buscarPorEmail($email);

        /*
         * Por segurança, não informamos
         * se o e-mail existe ou não.
         */

        if ($usuario === null) {

            return [
                'sucesso' => true
            ];
        }

        /*
         * Gera o token original.
         *
         * Esse token será enviado
         * no link do e-mail.
         */

        $token = bin2hex(
            random_bytes(32)
        );

        /*
         * Apenas o hash do token
         * será armazenado no banco.
         */

        $tokenHash = hash(
            'sha256',
            $token
        );

        /*
         * Token válido por 1 hora.
         */

        $expira = date(
            'Y-m-d H:i:s',
            strtotime('+1 hour')
        );

        /*
         * Salva o token no banco.
         */

        $salvou = $this->usuarioModel
            ->salvarTokenRecuperacao(
                (int) $usuario['id'],
                $tokenHash,
                $expira
            );

        if (!$salvou) {

            return [
                'sucesso' => false,
                'erro' => 'token'
            ];
        }

        /*
         * Monta o link que será
         * enviado para o usuário.
         */

        $link = BASE_URL
            . '/reset-senha.php?token='
            . urlencode($token);

        /*
         * Envia o e-mail.
         */

        $enviado = $this->emailService
            ->enviarEmailRecuperacao(
                $usuario['email'],
                $usuario['nome'],
                $link
            );

        if (!$enviado) {

            return [
                'sucesso' => false,
                'erro' => 'email'
            ];
        }

        return [
            'sucesso' => true
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | REDEFINIR SENHA
    |--------------------------------------------------------------------------
    */

    public function redefinirSenha(
        string $token,
        string $senha
    ): array {

        if ($token === '') {

            return [
                'sucesso' => false,
                'erro' => 'token'
            ];
        }

        /*
         * Gera o hash do token recebido
         * para comparar com o banco.
         */

        $tokenHash = hash(
            'sha256',
            $token
        );

        /*
         * Procura o usuário pelo token
         * e verifica se ainda está válido.
         */

        $usuario = $this->usuarioModel
            ->buscarPorToken($tokenHash);

        if ($usuario === null) {

            return [
                'sucesso' => false,
                'erro' => 'token_expirado'
            ];
        }

        /*
         * Cria o hash da nova senha.
         */

        $senhaHash = password_hash(
            $senha,
            PASSWORD_DEFAULT
        );

        /*
         * Atualiza a senha e invalida
         * o token de recuperação.
         */

        $atualizou = $this->usuarioModel
            ->atualizarSenha(
                (int) $usuario['id'],
                $senhaHash
            );

        if (!$atualizou) {

            return [
                'sucesso' => false,
                'erro' => 'atualizacao'
            ];
        }

        return [
            'sucesso' => true
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | CRIAR SESSÃO
    |--------------------------------------------------------------------------
    */

    private function criarSessao(
        array $usuario
    ): void {

        if (
            session_status()
            === PHP_SESSION_NONE
        ) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['usuario_id']
            = $usuario['id'];

        $_SESSION['usuario_email']
            = $usuario['email'];

        $_SESSION['img']
            = $usuario['img'];

        $_SESSION['tipo_usuario']
            = $usuario['tipo_usuario'];

        $_SESSION['tipo_cadastro']
            = $usuario['tipo_cadastro'];

        $_SESSION['id_plano']
            = $usuario['id_plano']
            ?? null;
    }


    /*
    |--------------------------------------------------------------------------
    | REDIRECIONAMENTO
    |--------------------------------------------------------------------------
    */

    private function obterRedirecionamento(
        array $usuario
    ): string {

        /*
         * ADMIN
         */

        if (
            $usuario['tipo_usuario']
            === 'admin'
        ) {

            return BASE_URL
                . '/admin.php';
        }


        /*
         * USUÁRIO
         */

        if (
            $usuario['tipo_usuario']
            === 'usuario'
        ) {

            /*
             * ALUNO
             */

            if (
                $usuario['tipo_cadastro']
                === 'aluno'
            ) {

                return BASE_URL
                    . '/aluno.php';
            }


            /*
             * ASSINANTE
             */

            if (
                $usuario['tipo_cadastro']
                === 'assinante'
            ) {

                return BASE_URL
                    . '/assinante.php';
            }
        }


        /*
         * PLANO INVÁLIDO
         */

        return BASE_URL
            . '/index.php?erro=plano';
    }
}
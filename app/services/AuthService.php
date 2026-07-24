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
    | CADASTRO DE USUÁRIO
    |--------------------------------------------------------------------------
    */

    public function cadastrar(array $dados): array
    {
        try {

            /*
             * Validação básica
             */

            if (
                empty($dados['nome']) ||
                empty($dados['email']) ||
                empty($dados['senha']) ||
                empty($dados['celular']) ||
                empty($dados['cidade']) ||
                empty($dados['estado']) ||
                empty($dados['plano'])
            ) {
                return [
                    'sucesso' => false,
                    'erro' => 'campos_obrigatorios'
                ];
            }


            /*
             * Validação do e-mail
             */

            if (!filter_var(
                $dados['email'],
                FILTER_VALIDATE_EMAIL
            )) {
                return [
                    'sucesso' => false,
                    'erro' => 'email_invalido'
                ];
            }


            /*
             * Validação da senha
             */

            if (strlen($dados['senha']) < 8) {
                return [
                    'sucesso' => false,
                    'erro' => 'senha_curta'
                ];
            }


            /*
             * Verifica se o e-mail
             * já está cadastrado
             */

            $usuarioExistente =
                $this->usuarioModel
                    ->buscarPorEmail(
                        $dados['email']
                    );

            if ($usuarioExistente !== null) {

                return [
                    'sucesso' => false,
                    'erro' => 'email_existente'
                ];
            }


            /*
             * Define o tipo de cadastro
             *
             * Plano 1 = Aluno
             * Plano 2 = Assinante
             */

            $idPlano = (int) $dados['plano'];

            if ($idPlano === 1) {

                $tipoCadastro = 'aluno';

            } elseif ($idPlano === 2) {

                $tipoCadastro = 'assinante';

            } else {

                return [
                    'sucesso' => false,
                    'erro' => 'plano_invalido'
                ];
            }


            /*
             * Cria hash seguro da senha
             */

            $senhaHash = password_hash(
                $dados['senha'],
                PASSWORD_DEFAULT
            );


            /*
             * Upload da foto
             */

            $nomeFoto = null;

            if (
                isset($dados['foto']) &&
                $dados['foto']['error']
                === UPLOAD_ERR_OK
            ) {

                $extensao = strtolower(
                    pathinfo(
                        $dados['foto']['name'],
                        PATHINFO_EXTENSION
                    )
                );

                $extensoesPermitidas = [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'webp'
                ];

                if (
                    !in_array(
                        $extensao,
                        $extensoesPermitidas,
                        true
                    )
                ) {

                    return [
                        'sucesso' => false,
                        'erro' => 'foto_invalida'
                    ];
                }


                /*
                 * Cria nome único
                 */

                $nomeFoto =
                    uniqid(
                        'perfil_',
                        true
                    )
                    . '.'
                    . $extensao;


                /*
                 * Diretório físico
                 *
                 * Projeto:
                 *
                 * /public/assets/img/perfil/
                 */

                $diretorio =
                    __DIR__
                    . '/../../public/assets/img/perfil/';


                /*
                 * Cria a pasta caso
                 * ela ainda não exista
                 */

                if (!is_dir($diretorio)) {

                    if (!mkdir(
                        $diretorio,
                        0775,
                        true
                    )) {

                        return [
                            'sucesso' => false,
                            'erro' => 'diretorio_foto'
                        ];
                    }
                }


                /*
                 * Move a foto
                 */

                $upload =
                    move_uploaded_file(
                        $dados['foto']['tmp_name'],
                        $diretorio . $nomeFoto
                    );

                if (!$upload) {

                    return [
                        'sucesso' => false,
                        'erro' => 'upload_foto'
                    ];
                }
            }


            /*
             * Cria o usuário
             */

            $idUsuario =
                $this->usuarioModel
                    ->criar([

                        'nome' =>
                            $dados['nome'],

                        'email' =>
                            $dados['email'],

                        'senha' =>
                            $senhaHash,

                        'celular' =>
                            $dados['celular'],

                        'cidade' =>
                            $dados['cidade'],

                        'estado' =>
                            $dados['estado'],

                        'img' =>
                            $nomeFoto,

                        'tipo_usuario' =>
                            'usuario',

                        'tipo_cadastro' =>
                            $tipoCadastro,

                        'status' =>
                            'ativo'
                    ]);


            /*
             * Cadastro realizado
             */

            return [
                'sucesso' => true,
                'id_usuario' => $idUsuario,
                'id_plano' => $idPlano,
                'tipo_cadastro' =>
                    $tipoCadastro
            ];


        } catch (Exception $e) {

            return [
                'sucesso' => false,
                'erro' => $e->getMessage()
            ];
        }
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
         */

        $token = bin2hex(
            random_bytes(32)
        );

        /*
         * Armazena somente o hash.
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
         * Salva o token.
         */

        $salvou =
            $this->usuarioModel
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
         * Link de recuperação.
         */

        $link =
            BASE_URL
            . '/reset-senha.php?token='
            . urlencode($token);

        /*
         * Envia o e-mail.
         */

        $enviado =
            $this->emailService
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
         * Hash do token recebido.
         */

        $tokenHash = hash(
            'sha256',
            $token
        );

        /*
         * Busca usuário.
         */

        $usuario =
            $this->usuarioModel
                ->buscarPorToken(
                    $tokenHash
                );

        if ($usuario === null) {

            return [
                'sucesso' => false,
                'erro' => 'token_expirado'
            ];
        }

        /*
         * Cria novo hash da senha.
         */

        $senhaHash =
            password_hash(
                $senha,
                PASSWORD_DEFAULT
            );

        /*
         * Atualiza senha.
         */

        $atualizou =
            $this->usuarioModel
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
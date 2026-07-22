<?php

require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    public function enviarEmailRecuperacao(
        string $email,
        string $nome,
        string $link
    ): bool {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = 'smtp-relay.brevo.com';

            $mail->SMTPAuth = true;

            $mail->AuthType = 'LOGIN';

            $mail->Username = 'SEU_USUARIO_SMTP';

            $mail->Password = 'SUA_SENHA_SMTP';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                'ademarliraneto@gmail.com',
                'Gospel Chords'
            );

            $mail->addAddress(
                $email,
                $nome
            );

            $mail->isHTML(true);

            $mail->Subject =
                'Recuperação de senha - Gospel Chords';

            $mail->Body = "
                <div style='font-family: Arial, sans-serif;'>
                    
                    <h2>Gospel Chords</h2>

                    <p>Olá, {$nome}!</p>

                    <p>
                        Recebemos uma solicitação para redefinir
                        a senha da sua conta.
                    </p>

                    <p>
                        Clique no botão abaixo para criar uma
                        nova senha:
                    </p>

                    <p>
                        <a 
                            href='{$link}'
                            style='
                                display:inline-block;
                                padding:12px 20px;
                                background:#0d6efd;
                                color:#fff;
                                text-decoration:none;
                                border-radius:5px;
                            '
                        >
                            Redefinir minha senha
                        </a>
                    </p>

                    <p>
                        Este link é válido por 1 hora.
                    </p>

                    <p>
                        Se você não solicitou a redefinição
                        da senha, ignore este e-mail.
                    </p>

                </div>
            ";

            $mail->AltBody = "
                Olá, {$nome}!

                Recebemos uma solicitação para redefinir
                a senha da sua conta Gospel Chords.

                Acesse o link abaixo:

                {$link}

                Este link é válido por 1 hora.
            ";

            return $mail->send();

        } catch (Exception $e) {

            error_log(
                "Erro ao enviar e-mail: " . $mail->ErrorInfo
            );

            return false;
        }
    }
}
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public function enviarEmailRecuperacao(
        string $email,
        string $nome,
        string $link
    ): bool {

        $mail = new PHPMailer(true);

        try {

            // ==================================================
            // Configuração SMTP
            // ==================================================

            $mail->isSMTP();

            $mail->Host =
                $_ENV['BREVO_SMTP_HOST'];

            $mail->SMTPAuth = true;

            $mail->AuthType = 'LOGIN';

            $mail->Username =
                $_ENV['BREVO_SMTP_USERNAME'];

            $mail->Password =
                $_ENV['BREVO_SMTP_PASSWORD'];

            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port =
                (int) $_ENV['BREVO_SMTP_PORT'];


            // ==================================================
            // Configuração do e-mail
            // ==================================================

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                $_ENV['MAIL_FROM'],
                $_ENV['MAIL_FROM_NAME']
            );

            $mail->addAddress(
                $email,
                $nome
            );


            // ==================================================
            // Conteúdo do e-mail
            // ==================================================

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


            // ==================================================
            // Versão texto
            // ==================================================

            $mail->AltBody = "
                Olá, {$nome}!

                Recebemos uma solicitação para redefinir
                a senha da sua conta Gospel Chords.

                Acesse o link abaixo:

                {$link}

                Este link é válido por 1 hora.
            ";


            // ==================================================
            // Envia o e-mail
            // ==================================================

            return $mail->send();


        } catch (Exception $e) {

            error_log(
                'Erro ao enviar e-mail: '
                . $mail->ErrorInfo
            );

            throw new Exception(
                'Erro PHPMailer: '
                . $mail->ErrorInfo
            );
        }
    }
}
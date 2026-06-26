<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('conexao.php');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = $_POST['email'];
     $sql = "SELECT id FROM usuarios WHERE email = ?";
     $stmt = $conn->prepare($sql);

      if(!$stmt){
      die("Erro SELECT: ".$conn->error);
      }

      $stmt->bind_param("s",$email);
      $stmt->execute();

      $resultado = $stmt->get_result();

      if($resultado->num_rows == 1){


      $usuario = $resultado->fetch_assoc();



      $token = bin2hex(random_bytes(32));

      $expira = date(
      "Y-m-d H:i:s",
      strtotime("+1 hour")
      );

        $sqlUpdate="
        UPDATE usuarios 
        SET reset_token=?, reset_expira=? 
        WHERE id=?";

        $stmt2=$conn->prepare($sqlUpdate);

        $stmt2->bind_param(
        "ssi",
        $token,
        $expira,
        $usuario['id']
        );

    $stmt2->execute();

    $link="http://localhost/dashboard/projetos/gospel_chords-main/reset_senha.php?token=".$token;

      $mail = new PHPMailer(true);

        try{

          $mail->isSMTP();
          $mail->Host = 'smtp-relay.brevo.com';
          $mail->SMTPAuth = true;

            /*força método compatível com Brevo*/
            $mail->AuthType = 'LOGIN';

            $mail->Username = 'aff885001@smtp-brevo.com';
            $mail->Password = 'bskrNRYeFpN2sho';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ademarliraneto@gmail.com', 'Gospel Chords');
            $mail->addAddress($email);  

            $mail->isHTML(true);

                  $mail->Subject="Recupere sua senha da plataforma Gospel Chords de Ademar Lira";

                  $mail->Body="
                  <h2>Gospel Chords</h2>

                  <p>Recebemos uma solicitação para alterar sua senha.</p>
                    <p>
                    Clique abaixo:
                    </p>
                  <a href='$link'>
                  Redefinir minha senha
                  </a>
                    <p>
                    Esse link expira em 1 hora.
                    </p>
                  ";

                $mail->send();

                header(
                "Location: ../esqueci_senha.php?status=sucesso"
                );

            exit();

          }catch(Exception $e){

        echo "ERRO PHPMailer: ";
        echo $mail->ErrorInfo;

        exit();

        }
      }else{

      header("Location: ../esqueci_senha.php?status=nao_encontrado");

      exit();
    }
  }
?>
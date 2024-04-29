<?php
   //require 'vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;


    function envia_email2($tipo,$email,$atach,$asunto,$contenido){

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.ionos.mx';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'atencion.clientes@laboratoriosarca.mx';
        $mail->Password = 'Arca_2023';
        $mail->setFrom('atencion.clientes@laboratoriosarca.mx', 'Servicio al paciente');
        $mail->addReplyTo('atencion.clientes@laboratoriosarca.mx', 'Servicio al paciente');
        $mail->addCC('acuses@laboratoriosarca.mx','Acuse ER'); // acuse a Envio de resultado
        $mail->addAttachment("../../pdf_resenv/".$atach);
        $mail->addAddress($email, $email);
        $mail->Subject = $asunto;
        $mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = $contenido;
        //$mail->addAttachment('attachment.txt');
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            $regreso = 0;
        } else {
            echo 'The email message was sent.';
            $regreso = 1;
        }
        return $regreso;
    };

    
?>
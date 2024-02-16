<?php

//function envia_email($email,$atach){

$email='soporte.producto@medisyslabs.onmicrosoft.com';
$atach='OIP.jpeg';


    // Mostrar errores PHP (Desactivar en producción)
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    // Incluir la libreria PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    // Inicio
    $mail = new PHPMailer(true);

    try {
        // Configuracion SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         // Mostrar salida (Desactivar en producción)
        $mail->isSMTP();                                               // Activar envio SMTP
        $mail->Host  = 'smtp.ionos.mx';                     // Servidor SMTP
        $mail->SMTPAuth  = true;                                       // Identificacion SMTP
        $mail->Username  = 'javier.pradel@medisyslabs.com.mx';                  // Usuario SMTP
        $mail->Password  = 'Maxulco_2023_Tecomitl';	          // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port  = 587;
        $mail->setFrom('hola@prueba.com', 'javier pradel m.');                // Remitente del correo

        // Destinatarios
        $mail->addAddress($email, 'destinatario');  // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Asunto del correo';
        $mail->Body  = 'Contenido del correo <b>en HTML!</b>';
        $mail->addAttachment($atach);
        $mail->AltBody = 'Contenido del correo en texto plano para los clientes de correo que no soporten HTML';
        $mail->send();
        $estenv = 1; //'El mensaje se ha enviado';
    } catch (Exception $e) {
        $estenv = 0; //"El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
    }
//}
<?php
use PHPMailer\PHPMailer;
use PHPMailer\Exception;
use PHPMailer\SMTP;

$email = new PHPMailer(TRUE);

try {
    // ***** Autentificación con SMTP  ****
    // Intentar crear una nueva instancia de la clase PHPMailer
    $mail = new PHPMailer (true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    // Datos personales
    $mail->Host = "smtp.ionos.mx";
    $mail->Port = "587";
    $mail->Username = "atencion.clientes@laboratoriosarca.mx";
    $mail->Password = "Arca%2022";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //*** Introducir el destinatario del correo electrónico */
    // Remitente
    $mail->setFrom('atencion.clientes@laboratoriosarca.mx', 'Servicio ARCA');
    // Destinatario, opcionalmente también se puede especificar el nombre
    $mail->addAddress('javier.pradel@medisyslabs.com.mx', 'Javier Pradel');
    // Copia
    $mail->addCC('jpradelm@hotmail.com', 'javier');
    // Copia oculta
    $mail->addBCC('jpradelm@hotmail.com', 'pradel');

    // *** Añadir el contenido del correo ***
    $mail->isHTML(true);
    // Asunto
    $mail->Subject = 'Asunto de tu correo electrónico';
    // Contenido HTML
    $mail->Body = 'El contenido de tu correo en HTML. Los elementos en <b>negrita</b> también están permitidos.';
    $mail->AltBody = 'El texto como elemento de texto simple';
    // Agregar archivo adjunto
    $mail->addAttachment("294938_456.pdf", "294938_456.pdf");

    //**  Utilizar la codificación de caracteres correcta */
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    //** Enviar el correo electrónico */
    $mail-> gt;send();
    //$mail->send();

} catch (Exception $e) {
        echo "Mailer Error: ".$mail->ErrorInfo;
}
?>
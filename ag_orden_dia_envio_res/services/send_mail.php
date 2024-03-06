<?php 
include "../../controladores/conex.php";
include_once('./includes/class.phpmailer.php');
include_once('./includes/class.smtp.php');


$fac = $_POST['numero_factura'];
$studio = $_POST['studio'];
$enviar = $_POST['enviar'];

/*
$fac = 185068;
$studio = 491;
$enviar = 1;
*/

//echo 'Factura='.$fac;
//echo 'Enviar='.$enviar;

//Obtenemos datos del usuario
$stmt = $conexion->prepare("SELECT CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,cl.mail,CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) medico,me.e_mail FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
WHERE id_factura = ?");

$stmt->bind_param("i", $fac);
$stmt->execute();
$stmt->store_result();
$rows = $stmt->num_rows;
if($rows > 0)
{
	$stmt->bind_result($paciente,$e_paciente,$medico,$e_medico);
    $stmt->fetch();
}else
{
	3;
}
//echo 'datos --> '.$paciente.$e_paciente.$medico.$e_medico;

//Obtenemos nombre del estudio
$stmt = $conexion->prepare("SELECT desc_estudio FROM km_estudios WHERE id_estudio = ?");
$stmt->bind_param("i", $studio);
$stmt->execute();
$stmt->store_result();
$rows = $stmt->num_rows;
if($rows > 0)
{
	$stmt->bind_result($desc_estudio);
    $stmt->fetch();
}else
{
	echo 3;
}
//Datos del destinatario
//Paciente
$paciente = $paciente;
$e_paciente = $e_paciente;
//Medico
$medico = $medico;
$e_medico = $e_medico;
//Estudio
$estudio = $desc_estudio;
//Asunto
$subject = utf8_decode('Resultado de estudios');
//Mensaje
$mensage = utf8_decode('Resultados del estudio: '.$estudio.' del paciente: '.$paciente); 
//echo 'datos -->'.$estudio.$mensage;
//Este bloque es importante
$mail = new PHPMailer();
try{
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.ionos.mx";   //"laboratoriosarca.com.mx";
$mail->Port = 587;


//Nuestra cuenta
$mail->Username ='atencion.clientes@laboratoriosarca.mx';
$mail->Password = 'Arca_2021'; //Su password
 
//Agregar destinatario
//Recipients

//De
$mail->setFrom('atencion.clientes@laboratoriosarca.mx', 'Laboratorios Arca');


//Para
if($enviar == 1)
{
	$mail->addAddress($e_medico,$medico);
}else
if($enviar == 2)
{
	$mail->addAddress($e_paciente,$paciente);
}else
{
	$mail->addAddress($e_paciente,$paciente);
}

$mail->addCC('marisol.briceno@laboratoriosarca.mx','Copia Resultado enviado');

//Para adjuntar archivo
$mail->AddAttachment("../emails/".$fac."_".$studio.".pdf");
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    ='<h4>'.$mensage.'</h4>';
$mail->AltBody = $mensage;

//$mail->MsgHTML("Prueba de mensaje para ARCA");
//echo 'mail -->'.'../emails/'.$fac.'_'.$studio.'.pdf';
$mail->Send();

$mail->SMTPOptions = array(
'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => true,
    'allow_self_signed' => true
));
echo 1;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
 ?>
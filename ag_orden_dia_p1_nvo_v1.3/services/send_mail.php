<?php 
include "../../controladores/conex.php";
include_once('./includes/class.phpmailer.php');
include_once('./includes/class.smtp.php');


$fac = $_POST['numero_factura'];
$studio = $_POST['studio'];

//Obtenemos datos del usuario
$query = "SELECT fa.email,CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) nombre 		FROM so_factura fa
			LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente) WHERE id_factura = $fac";
$result = $conexion->query($query);
$row=mysqli_fetch_array($result);


//Obtenemos nombre del estudio
$query2 = "SELECT desc_estudio FROM km_estudios WHERE id_estudio = $studio";
$result2 = $conexion->query($query2);
$row2=mysqli_fetch_array($result2);

//Para
$name = $row['nombre'];
$email = $row['email'];
$estudio = $row2['desc_estudio'];
$subject = 'Laboratorios ARCA';
$mensage = 'Resultados de su estudio: ' .$estudio; //Mensaje del usuario


//Este bloque es importante
$mail = new PHPMailer();
try{
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "laboratoriosarca.com.mx";
$mail->Port = 465;


//Nuestra cuenta
$mail->Username ='atencion.cliente@laboratoriosarca.com.mx';
$mail->Password = 'UyNJe9ffZaY]'; //Su password
 
//Agregar destinatario
//Recipients

//De
$mail->setFrom('atencion.cliente@laboratoriosarca.com.mx', $subject);


//Para
$mail->addAddress($email,$name);
 $mail->addCC('marisol.briseno@laboratoriosarca.com.mx','Copia Resultado enviado');

//Para adjuntar archivo
$mail->AddAttachment("../emails/".$fac."_".$studio.".pdf");
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    ='<h4>'.$mensage.'</h4>';
$mail->AltBody = $mensage;

//$mail->MsgHTML("Prueba de mensaje para ARCA");

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
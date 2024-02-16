<?php 
include "../../controladores/conex.php";
// include_once('./includes/class.phpmailer.php');
// include_once('./includes/class.smtp.php');


$fac = $_POST['numero_factura'];
$studio = $_POST['studio'];
$enviar = $_POST['enviar'];



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
	echo 3;
}



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

$estudio_pdf="../emails/".$fac."_".$studio.".pdf";

//  **** EBVIO DE MAIL VERSION 2 **** //


    ini_set("SMTP","mail.estudiosclinicosanbuenaventura.com.mx");
	ini_set("smtp_port","localhost");
	ini_set('sendmail_from', 'atencion.cliente@estudiosclinicosanbuenaventura.com.mx');

	ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
	
	//$name = strip_tags($_POST["nombre"]);
	$name = 'Estudios Clinicos';
	//$apellido = strip_tags( $_POST["apellidos"]);
	$apellido = 'San Buenaventura';
	//$mail = strip_tags($_POST["correo"]);
	$mail = 'atencion.cliente@estudiosclinicosanbuenaventura.com.mx';
	$mensaje = strip_tags($mensage);

	// $nameFile = $_FILES["archivo"]["name"];
	$nameFile = $fac."_".$studio.".pdf";
	//$sizeFile= $_FILES["archivo"]["size"];
	$sizeFile = filesize($estudio_pdf);
	//$typeFile= $_FILES["archivo"]["type"];
	//$tempFile= $_FILES["archivo"]["tmp_name"];

	$fecha= time();
	$fechaFormato = date("j/n/Y",$fecha);
	
/*
	echo "Nombre: " . $nameFile . "<br>";
	echo "TamaÃ±o: " . $sizeFile . "<br>";
	echo "Tipo: ". $typeFile . "<br>";
	echo "Temporal: " . $tempFile . "<br>";
*/

	$correoDestino = $e_medico.';'.'beatriz.ramirez@estudiosclinicosanbuenaventura.com.mx';
	
	//asunto del correo
	//$asunto = "Enviado por " . $name . " ". $apellido;
	$asunto = $mensaje;

 	// -> mensaje en formato Multipart MIME
	$cabecera = "MIME-VERSION: 1.0\r\n";
	$cabecera .= "Content-type: multipart/mixed;";
	$cabecera .="boundary=\"=C=T=E=C=\"\r\n";
	$cabecera .= "From: {$mail}";

	//Primera parte del mensaje (texto plano)
	//    -> encabezado de la parte

	$cuerpo = "--=C=T=E=C=\r\n";
	$cuerpo .= "Content-type: text/plain";
	$cuerpo .= "charset=utf-8\r\n";
	$cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
	$cuerpo .= "\r\n"; // linea vacia
	$cuerpo .= "Correo enviado por: " . $name . " ". $apellido;
	$cuerpo .= " con fecha: " . $fechaFormato;
	$cuerpo .= "Email: " . $mail;
	$cuerpo .= "Mensaje: " . $mensaje;
	$cuerpo .= "\r\n";// linea vacia

 	// -> segunda parte del mensaje (archivo adjunto)
        //    -> encabezado de la parte
    $cuerpo .= "--=C=T=E=C=\r\n";
    $cuerpo .= "Content-Type: application/octet-stream; ";
    $cuerpo .= "name=" . $nameFile . "\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
    $cuerpo .= "Content-Disposition: attachment; ";
    $cuerpo .= "filename=" . $nameFile . "\r\n";
    $cuerpo .= "\r\n"; // linea vacia


	$fp = fopen($estudio_pdf, "rb");
    $file = fread($fp, $sizeFile);
	$file = chunk_split(base64_encode($file));

    //    -> lectura del archivo correspondiente al archivo adjunto
    //$datos = file_get_contents($archivo);
    
    //    -> codificacion y fragmentacion de los datos
    //$datos = chunk_split(base64_encode($datos));
    //    -> datos de la parte (integracion en el mensaje)
    //$mensaje .= "$datos\r\n";
    $cuerpo .= "$file\r\n";
    $cuerpo .= "\r\n"; // linea vacia
    // Delimitador de final del mensaje.
    $cuerpo .= "--=C=T=E=C=--\r\n";
    // Envio del mensaje.
    // $ok = mail($destinatarios,$asunto,$mensaje,$encabezados);
    //echo 'Nota: la linea de codigo que permite enviar el correo esta en el comentario.<br />';

	//Enviar el correo
	if(mail($correoDestino, $asunto, $cuerpo, $cabecera)){
		echo 1;
	}else{
		echo 2;
	}
	


/*
// ***** Rutina de envio de mail VERSION 1  *****

	ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $from = "atencion.cliente@estudiosclinicosanbuenaventura.com.mx";
    $to = "javier.pradel@medisyslabs.com.mx";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";

// ***** Termina rutina  ****
*/


 ?>
<?php
session_start();
include("../../controladores/conex.php");
//use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal_log=$_SESSION['fk_id_sucursal'];
$fk_id_usuario_log=$_SESSION['id_usuario'];



$idcliente =$_POST['idcliente'];
$nombre =$_POST["nombre"];
$a_paterno =$_POST["a_paterno"];
$a_materno =$_POST["a_materno"];
$anios =$_POST["anios"];
$meses =$_POST["meses"];
$dias =$_POST["dias"];
$sexo =$_POST["sexo"];
$estado_civil =$_POST["estado_civil"];
$ocupacion =$_POST["ocupacion"];
$t_fijo =$_POST["t_fijo"];
$movil =$_POST["movil"];
$mail =$_POST["mail"];
$edo =$_POST["edo"];
$muni =$_POST["muni"];
$loca =$_POST["loca"];
$colonia =$_POST["colonia"];
$cp =$_POST["cp"];
$calle =$_POST["calle"];
$numero =$_POST["numero"];
$fecha_nac =$_POST["fecha_nac"];
$box_publicidad =$_POST["box_publicidad"];

$despues=
$nombre.' '.$a_paterno.' '.$a_materno.' '.$anios.' '.$meses.' '.$dias.' '.$sexo.' '.$estado_civil.' '.$ocupacion.' '.$t_fijo.' '.$movil.' '.
$mail.' '.$edo.' '.$muni.' '.$loca.' '.$colonia.' '.$cp.' '.$calle.' '.$numero.' '.$fecha_nac.' '.$box_publicidad;
/*  Rutina para obtener el movimiento antes
	del cambio y guardar el log
*/
$stm_select=
"
select * from so_clientes where id_cliente = $idcliente
";
if ($res_select = mysqli_query($conexion, $stm_select)) {
	while($row_select = $res_select->fetch_assoc())
	{
		$fk_id_empresa = $row_select['fk_id_empresa'];
		$id_cliente = $row_select['id_cliente'];
		$rfc = $row_select['rfc'];
		$nombre = $row_select['nombre'];
		$a_paterno = $row_select['a_paterno'];
		$a_materno = $row_select['a_materno'];
		$anios = $row_select['anios'];
		$meses = $row_select['meses'];
		$dias = $row_select['dias'];
		$fk_id_sexo = $row_select['fk_id_sexo'];
		$fk_id_estado_civil = $row_select['fk_id_estado_civil'];
		$fk_id_ocupacion = $row_select['fk_id_ocupacion'];
		$telefono_fijo = $row_select['telefono_fijo'];
		$telefono_movil = $row_select['telefono_movil'];
		$mail = $row_select['mail'];
		$fk_id_estado = $row_select['fk_id_estado'];
		$fk_id_municipio = $row_select['fk_id_municipio'];
		$fk_id_localidad = $row_select['fk_id_localidad'];
		$colonia = $row_select['colonia'];
		$cp = $row_select['cp'];
		$calle = $row_select['calle'];
		$numero_exterior = $row_select['numero_exterior'];
		$fecha_registro = $row_select['fecha_registro'];
		$fecha_actualizacion = $row_select['fecha_actualizacion'];
		$activo = $row_select['activo'];
		$publicidad = $row_select['publicidad'];
		$fk_id_medico = $row_select['fk_id_medico'];
		$origen = $row_select['origen'];
		$fecha_nac = $row_select['fecha_nac'];
		$pass_word = $row_select['pass_word'];

		$antes=
		$rfc.' '.$nombre.' '.$a_paterno.' '.$a_materno.' '.$anios.' '.$meses.' '.$dias.' '.$fk_id_sexo.' '.$fk_id_estado_civil.' '.$fk_id_ocupacion.' '.$telefono_fijo.' '.
		$telefono_movil.' '.$mail.' '.$fk_id_estado.' '.$fk_id_municipio.' '.$fk_id_localidad.' '.$colonia.' '.$cp.' '.$calle.' '.$numero_exterior.' '.$fecha_registro.' '.
		$fecha_actualizacion.' '.$activo.' '.$publicidad.' '.$fk_id_medico.' '.$origen.' '.$fecha_nac.' '.$pass_word;
		/* guardamos en el log */
		$stm_insert=
		"
		insert into so_clientes_log
            (fk_id_empresa,
             id_cliente,
             rfc,
             nombre,
             a_paterno,
             a_materno,
             anios,
             meses,
             dias,
             fk_id_sexo,
             fk_id_estado_civil,
             fk_id_ocupacion,
             telefono_fijo,
             telefono_movil,
             mail,
             fk_id_estado,
             fk_id_municipio,
             fk_id_localidad,
             colonia,
             cp,
             calle,
             numero_exterior,
             fecha_registro,
             fecha_actualizacion,
             activo,
             publicidad,
             fk_id_medico,
             origen,
             fecha_nac,
             pass_word,
             fk_id_sucursal_log,
             fk_id_usuario_log,
             fecha_log)
		values ('$fk_id_empresa',
				'$id_cliente',
				'$rfc',
				'$nombre',
				'$a_paterno',
				'$a_materno',
				'$anios',
				'$meses',
				'$dias',
				'$fk_id_sexo',
				'$fk_id_estado_civil',
				'$fk_id_ocupacion',
				'$telefono_fijo',
				'$telefono_movil',
				'$mail',
				'$fk_id_estado',
				'$fk_id_municipio',
				'$fk_id_localidad',
				'$colonia',
				'$cp',
				'$calle',
				'$numero_exterior',
				'$fecha_registro',
				'$fecha_actualizacion',
				'$activo',
				'$publicidad',
				'$fk_id_medico',
				'$origen',
				'$fecha_nac',
				'$pass_word',
				'$fk_id_sucursal_log',
				'$fk_id_usuario_log',
				NOW()
			);
		";
		$res_insert = mysqli_query($conexion, $stm_insert);
		if($res_insert){
			//use PHPMailer\PHPMailer\PHPMailer;
			$tipo=1;
			$email='eloisa.flores@laboratoriosarca.com.mx';
			$asunto='Modificacion de pacientes';
			$contenido='El usuario '.$fk_id_usuario_log.' modifico, al paciente'.$nombre.' '.$a_paterno.' '.$a_materno;
	
				require './PHPMailer/src/Exception.php';
				require './PHPMailer/src/PHPMailer.php';
				require './PHPMailer/src/SMTP.php';
		
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = 'smtp.ionos.mx';
				$mail->Port = 587;
				$mail->SMTPAuth = true;
				$mail->Username = 'atencion.clientes@laboratoriosarca.mx';
				$mail->Password = 'Arca_2023';
				$mail->setFrom('atencion.clientes@laboratoriosarca.mx', 'Servicio al paciente');
				$mail->addReplyTo('atencion.clientes@laboratoriosarca.mx', 'Servicio al paciente');
				$mail->addCC('atencion.clientes@laboratoriosarca.mx','Modificacion de paciente'); // acuse a Envio de resultado
				//$mail->addAttachment("../../pdf_resenv/".$atach);
				$mail->addAddress($email, $email);
				$mail->Subject = $asunto;
				$mail->msgHTML(file_get_contents('message.html'), __DIR__);
				$mail->Body = $contenido;
				//$mail->addAttachment('attachment.txt');
				if (!$mail->send()) {
					//echo 'Mailer Error: ' . $mail->ErrorInfo;
					$regreso = 0;
				} else {
					//echo 'The email message was sent.';
					$regreso = 1;
				}
		}else{

		}
	}
};


$query = "";

$stmt = $conexion->prepare("UPDATE so_clientes
SET
 nombre = ?,
 a_paterno = ?,
 a_materno = ?,
 anios = ?,
 meses = ?,
 dias = ?,
 fk_id_sexo = ?,
 fk_id_estado_civil = ?,
 fk_id_ocupacion = ?,
 telefono_fijo = ?,
 telefono_movil = ?,
 mail = ?,
 fk_id_estado = ?,
 fk_id_municipio = ?,
 fk_id_localidad = ?,
 colonia = ?,
 cp = ?,
 calle = ?,
 numero_exterior = ?,
 fecha_nac = ?,
 publicidad = ?
WHERE id_cliente = ?");
$stmt->bind_param("sssiiisiisssiiisisssii",	$nombre,$a_paterno,$a_materno, $anios, $meses,
																					$dias, $sexo, $estado_civil, $ocupacion, $t_fijo,
																					$movil, $mail,$edo, $muni, $loca, $colonia, $cp,
																					$calle, $numero, $fecha_nac, $box_publicidad, $idcliente);
if($stmt->execute()){
	echo "Datos Agregados Correctamente";
}else{
	$codigo = mysqli_errno($conexion);
  echo $codigo;
}

$stmt->close();

?>

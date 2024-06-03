<?php
session_start();
include("../../controladores/conex.php");
include("../../emails/multiple2.php");

date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal_log=$_SESSION['fk_id_sucursal'];
$fk_id_usuario_log=$_SESSION['id_usuario'];

// obtener datos de la sucursal  
$sql_suc="select desc_sucursal from kg_sucursales s where s.id_sucursal = $fk_id_sucursal_log";
if ($result_suc = mysqli_query($conexion, $sql_suc)) {
	while($row_suc = $result_suc->fetch_assoc())
	{
		$desc_sucursal=$row_suc['desc_sucursal'];
	}
}

// obtener datos del usuario
$sql_usu="SELECT u.id_usr FROM se_usuarios u WHERE u.id_usuario = $fk_id_usuario_log";
if ($result_usu = mysqli_query($conexion, $sql_usu)) {
	while($row_usu = $result_usu->fetch_assoc())
	{
		$id_usr=$row_usu['id_usr'];
	}
}

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
		$lfk_id_empresa = $row_select['fk_id_empresa'];
		$lid_cliente = $row_select['id_cliente'];
		$lrfc = $row_select['rfc'];
		$lnombre = $row_select['nombre'];
		$la_paterno = $row_select['a_paterno'];
		$la_materno = $row_select['a_materno'];
		$lanios = $row_select['anios'];
		$lmeses = $row_select['meses'];
		$ldias = $row_select['dias'];
		$lfk_id_sexo = $row_select['fk_id_sexo'];
		$lfk_id_estado_civil = $row_select['fk_id_estado_civil'];
		$lfk_id_ocupacion = $row_select['fk_id_ocupacion'];
		$ltelefono_fijo = $row_select['telefono_fijo'];
		$ltelefono_movil = $row_select['telefono_movil'];
		$lmail = $row_select['mail'];
		$lfk_id_estado = $row_select['fk_id_estado'];
		$lfk_id_municipio = $row_select['fk_id_municipio'];
		$lfk_id_localidad = $row_select['fk_id_localidad'];
		$lcolonia = $row_select['colonia'];
		$lcp = $row_select['cp'];
		$lcalle = $row_select['calle'];
		$lnumero_exterior = $row_select['numero_exterior'];
		$lfecha_registro = $row_select['fecha_registro'];
		$lfecha_actualizacion = $row_select['fecha_actualizacion'];
		$lactivo = $row_select['activo'];
		$lpublicidad = $row_select['publicidad'];
		$lfk_id_medico = $row_select['fk_id_medico'];
		$lorigen = $row_select['origen'];
		$lfecha_nac = $row_select['fecha_nac'];
		$lpass_word = $row_select['pass_word'];

		$antes=
		$lrfc.' '.$lnombre.' '.$la_paterno.' '.$la_materno.' '.$lanios.' '.$lmeses.' '.$ldias.' '.$lfk_id_sexo.' '.$lfk_id_estado_civil.' '.$lfk_id_ocupacion.' '.$ltelefono_fijo.' '.
		$ltelefono_movil.' '.$lmail.' '.$lfk_id_estado.' '.$lfk_id_municipio.' '.$lfk_id_localidad.' '.$lcolonia.' '.$lcp.' '.$lcalle.' '.$lnumero_exterior.' '.$lfecha_registro.' '.
		$lfecha_actualizacion.' '.$lactivo.' '.$lpublicidad.' '.$lfk_id_medico.' '.$lorigen.' '.$lfecha_nac.' '.$lpass_word;
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
		values ('$lfk_id_empresa',
				'$lid_cliente',
				'$lrfc',
				'$lnombre',
				'$la_paterno',
				'$la_materno',
				'$lanios',
				'$lmeses',
				'$ldias',
				'$lfk_id_sexo',
				'$lfk_id_estado_civil',
				'$lfk_id_ocupacion',
				'$ltelefono_fijo',
				'$ltelefono_movil',
				'$lmail',
				'$lfk_id_estado',
				'$lfk_id_municipio',
				'$lfk_id_localidad',
				'$lcolonia',
				'$lcp',
				'$lcalle',
				'$lnumero_exterior',
				'$lfecha_registro',
				'$lfecha_actualizacion',
				'$lactivo',
				'$lpublicidad',
				'$lfk_id_medico',
				'$lorigen',
				'$lfecha_nac',
				'$lpass_word',
				'$fk_id_sucursal_log',
				'$fk_id_usuario_log',
				NOW()
			);
		";
		$res_insert = mysqli_query($conexion, $stm_insert);
		if($res_insert){
			$atach="SgcDefinicion.pdf";
			$asunto="Ha Recibido un email, hubo afectacion al catalogo de pacientes";
			$contenido="Ha actualizado los datos del paciente (antes) ".$antes." por los datos ".$despues."  realizados por ".$id_usr." de la sucursal ".$desc_sucursal;
			
			$regreso = multiple2(2,19,$atach,$asunto,$contenido);
		}else{

		}
		//mysqli_close($conexion);
	}
};


$query = "";

$stmt = "
UPDATE so_clientes 
SET
 nombre = '$nombre',
 a_paterno = '$a_paterno',
 a_materno = '$a_materno',
 anios = '$anios',
 meses = '$meses',
 dias = '$dias',
 fk_id_sexo = '$sexo',
 fk_id_estado_civil = '$estado_civil',
 fk_id_ocupacion = '$ocupacion',
 telefono_fijo = '$t_fijo',
 telefono_movil = '$movil',
 mail = '$mail',
 fk_id_estado = '$edo',
 fk_id_municipio = '$muni',
 fk_id_localidad = '$loca',
 colonia = '$colonia',
 cp = '$cp',
 calle = '$calle',
 numero_exterior = '$numero',
 fecha_nac = '$fecha_nac',
 publicidad = '$box_publicidad'
WHERE id_cliente =  $idcliente";
/*
$stmt->bind_param("sssiiisiisssiiisisssii",	$nombre,$a_paterno,$a_materno, $anios, $meses,
																					$dias, $sexo, $estado_civil, $ocupacion, $t_fijo,
																					$movil, $mail,$edo, $muni, $loca, $colonia, $cp,
																					$calle, $numero, $fecha_nac, $box_publicidad, $idcliente);
																					*/
//echo $stmt;
$res_stmt = mysqli_query($conexion, $stmt);
if($res_stmt){
	echo "Datos Agregados Correctamente";
}else{
	$codigo = mysqli_errno($conexion);
  echo $codigo;
}

mysqli_close($conexion);

?>

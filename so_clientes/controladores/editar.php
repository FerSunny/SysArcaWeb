<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');
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

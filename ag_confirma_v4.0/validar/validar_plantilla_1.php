<?php 
	session_start();
	include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d H:i:s");

$factura = $_POST['factura'];
$estudio = $_POST['estudio'];	

$stmt = $conexion->prepare("UPDATE cr_plantilla_1_re SET validado = 1, fecha_validacion = ? WHERE fk_id_factura = ? AND fk_id_estudio = ?");
$stmt->bind_param('sii', $fecha,$factura,$estudio);
$result = $stmt->execute();

if($result)
{
 echo 1;
}else
{
	$codigo = mysqli_errno($conexion); 
  	echo $codigo;
}
$stmt->close();

 ?>
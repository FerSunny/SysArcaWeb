<?php 

include ("../../controladores/conex.php");

$stmt = $conexion->prepare("SELECT MAX(id_detalle) as id FROM eb_detalle_solicitud");
//$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($detalle);
$stmt->fetch();

if($detalle == '' OR $detalle == null)
{
	$detalle = 1;
	echo $detalle;
}else
{
	$detalle = $detalle + 1;
	echo $detalle;
}
 ?>
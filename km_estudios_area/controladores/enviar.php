<?php 


include ("../../controladores/conex.php");
$id_detalle= $_POST['id_detalle'];

$query ="UPDATE eb_detalle_solicitud SET estatus = 'C' WHERE id_detalle = $id_detalle ";
$result = $conexion -> query($query);

if ($result) {
	$query1 ="UPDATE eb_solicitudes SET estatus = 'C' WHERE fk_id_detalle = $id_detalle ";
	$result1 = $conexion -> query($query1);
	if ($result1) {
		echo 1;
	}else{
		$codigo = mysqli_errno($conexion); 
		echo $codigo;
	}
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
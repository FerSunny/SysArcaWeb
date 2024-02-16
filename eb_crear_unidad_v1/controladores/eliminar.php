<?php 


include ("../../controladores/conex.php");
$id_detalle= $_POST['id_detalle'];

$query ="UPDATE eb_detalle_solicitud SET estado = 'S' WHERE id_detalle = $id_detalle ";
$result = $conexion -> query($query);

if ($result) {
	$query ="UPDATE eb_solicitudes SET estado = 'S' WHERE fk_id_detalle = $id_detalle ";
	$result = $conexion -> query($query);
	
	if ($result) {
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
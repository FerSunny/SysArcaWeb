<?php 


include ("../../controladores/conex.php");
$id_solicitud= $_POST['id_solicitud'];

$query ="UPDATE eb_solicitudes SET estado = 'S' WHERE id_solicitud = $id_solicitud";
$result = $conexion -> query($query);

if ($result) {
    echo 1;
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
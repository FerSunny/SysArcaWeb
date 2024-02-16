<?php 
include ("../../controladores/conex.php");
$id_uso= $_POST['id_uso'];

$query ="UPDATE  kg_usos  SET estado = 'S' WHERE id_uso = $id_uso";
$stmt = $conexion -> prepare($query);

if ($stmt->execute()) {
    echo 1;
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}
$conexion->close();
?>
<?php 


include ("../../controladores/conex.php");
$id_estudio_area= $_POST['id_estudio_area'];

$query ="UPDATE km_estudios_area SET estado = 'S' WHERE id_estudio_area = $id_estudio_area";
$result = $conexion -> query($query);

if ($result) {
    echo 1;
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
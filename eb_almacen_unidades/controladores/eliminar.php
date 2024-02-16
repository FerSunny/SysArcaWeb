<?php 


include ("../../controladores/conex.php");
$id_unidades = $_POST['id_unidades'];


$query ="UPDATE  eb_almacen_unidades  SET estado = 'S' WHERE id_unidades = $id_unidades";
$result = $conexion -> query($query);

if ($result) {
    echo 1;
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}

$conexion->close();
?>
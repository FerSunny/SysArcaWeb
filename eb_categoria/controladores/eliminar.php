<?php 


include ("../../controladores/conex.php");
$id_categoria= $_POST['id_categoria'];

$query ="UPDATE eb_categoria SET estado = 'S' WHERE id_categoria = $id_categoria ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
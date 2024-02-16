<?php 


include ("../../controladores/conex.php");
$id_departamento= $_POST['id_departamento'];

$query ="UPDATE eb_departamento SET estado = 'S' WHERE id_departamento = $id_departamento ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
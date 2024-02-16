<?php 


include ("../../controladores/conex.php");
$id_proveedor= $_POST['id_proveedor'];

$query ="UPDATE eb_proveedores SET estado = 'S' WHERE id_proveedor = $id_proveedor ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>
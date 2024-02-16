<?php
include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');

$id = $_POST['id'];


$query = "DELETE FROM so_folios_efectivo WHERE id_folios = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i",$id);

if($stmt->execute())
{
	echo "Los datos han sido eliminados";
}else
{
	$codigo = mysqli_errno($conexion); 
    echo "Error MySQL #".$codigo;
}



 ?>
<?php
include("../../controladores/conex.php");

$fk_id_detalle = $_POST["fk_id_detalle"];
$tabla = $_POST['tabla'];

if($tabla == 'D')
{
	editar_detalle($conexion, $fk_id_detalle);
}else
if($tabla == 'S')
{
	editar_solicitud($conexion, $fk_id_detalle);
}else
{
	echo 'Ocurrio un Error';
}

function editar_detalle($conexion, $fk_id_detalle)
{
	$query = "UPDATE eb_detalle_solicitud SET estatus = 'R' WHERE id_detalle = '$fk_id_detalle'";

	$resultado = $conexion->query($query);
	echo $query;
	$conexion->close();
}


function editar_solicitud($conexion, $fk_id_detalle)
{
	$query = "UPDATE eb_solicitudes SET estatus = 'R' WHERE fk_id_detalle = '$fk_id_detalle'";

	$resultado = $conexion->query($query);
	$conexion->close();
}




?>
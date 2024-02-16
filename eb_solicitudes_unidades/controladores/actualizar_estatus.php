<?php
include("../../controladores/conex.php");

$tipo = $_POST['tipo']; //Tipo = 1 Actualiza 
$fk_id_detalle = $_POST['fk_id_detalle'];
$estatus = $_POST['estatus'];

//Tipo = 1 Actualiza eb_detalle_solicitud y eb_solicitudes al mismo tiempo
//Tipo =  2 Actualiza solo eb_detalle_solicitud
//Tipo = 3 Actualiza solo eb_solicitudes
if($tipo == 1)
{
	actualiza_ambos($conexion,$fk_id_detalle,$estatus);
}else
if($tipo == 2)
{
	actualiza_detalle($conexion,$fk_id_detalle,$estatus);
}else
if($tipo == 3)
{
	actualiza_solicitudes($conexion,$fk_id_detalle,$estatus);
}else
{
	echo 0;
}


function actualiza_ambos($conexion,$fk_id_detalle,$estatus)
{
	$query = "UPDATE eb_detalle_solicitud SET estatus = '$estatus' WHERE id_detalle = '$fk_id_detalle'";
	$resultado = $conexion -> query($query);


	$query1 = "UPDATE eb_solicitudes SET estatus = '$estatus' WHERE fk_id_detalle = '$fk_id_detalle'";
	$resultado1 = $conexion -> query($query1);

}

function actualiza_detalle($conexion,$fk_id_detalle,$estatus)
{
	$query = "UPDATE eb_detalle_solicitud SET estatus = '$estatus' WHERE id_detalle = '$fk_id_detalle'";
	$resultado = $conexion -> query($query);
}

function actualiza_solicitudes($conexion,$fk_id_detalle,$estatus)
{
	$query1 = "UPDATE eb_solicitudes SET estatus = '$estatus' WHERE fk_id_detalle = '$fk_id_detalle'";
	$resultado1 = $conexion -> query($query1);
}



$conexion->close();

?>
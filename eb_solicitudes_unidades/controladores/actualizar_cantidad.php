<?php
include("../../controladores/conex.php");

$id_solicitud = $_POST["id_solicitud"];
$cantidad = $_POST["cantidad"];


$query = " UPDATE  eb_solicitudes SET  cantidad = '$cantidad' WHERE id_solicitud = '$id_solicitud'";

$resultado = mysqli_query($conexion, $query);

echo $query;


?>
<?php

session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_medico=$_POST["id_medico"];
$fn_mbaja=$_POST["fn_mbaja"];

$movi=$_POST["movi"];
$motivo=$_POST["motivo"];

$usuario = $_SESSION['id_usuario'];


$query = "UPDATE  so_medicos 
SET 
fk_id_tipo_baja =$movi, 
fk_id_motivo	=$motivo,
fecha_baja = now(), 
motivo_baja = '$fn_mbaja', 
usuario_baja = '$usuario' 
WHERE id_medico='$id_medico'";

//echo $query;

$result = $conexion->query($query);

//echo $query;
if ($result) {
	$bien = 1;
    echo $bien;

}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();


 ?>

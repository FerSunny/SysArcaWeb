<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];
$clave_uso = $_POST['clave_uso'];
$desc_uso = $_POST['desc_uso'];
$fecha = date("Y-m-d H:i:s");

$query ="INSERT INTO kg_usos (fk_id_empresa, fk_id_sucursal, clave_uso,  desc_uso, estado, fecha_registro) 
VALUES (1, '$sucursal', '$clave_uso', '$desc_uso','A','$fecha')";
$stmt = $conexion->prepare($query);

if ($stmt->execute()) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
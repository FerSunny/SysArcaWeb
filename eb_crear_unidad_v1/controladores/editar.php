<?php 


session_start();
include ("../../controladores/conex.php");



$dep = $_POST['dep'];
$festima  = $_POST['festima'];

     
$query ="
UPDATE eb_detalle_solicitud
SET fecha_libera = '$festima'
WHERE id_detalle = $dep
";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
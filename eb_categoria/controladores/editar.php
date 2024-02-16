<?php 


session_start();
include ("../../controladores/conex.php");



$ca = $_POST['ca'];
$cat  = $_POST['cat'];
$abrev = $_POST['abrev'];
$descrip = $_POST['descrip']; 
$fecha_actualizacion = date("Y-m-d H:i:s");
$query = "UPDATE eb_categoria
SET

 categoria = '$cat',
 abreviatura ='$abrev',
 descripcion = '$descrip',
 fecha_actualizacion = '$fecha_actualizacion'

WHERE id_categoria = '$ca'";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>



































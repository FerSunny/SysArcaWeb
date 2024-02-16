<?php
session_start();
include("../../controladores/conex.php");
$id_imagen= $_POST['id_imagen'];

$query ="UPDATE cr_plantilla_ekg_img SET estado = 'S' WHERE id_imagen = $id_imagen ";
$result = $conexion -> query($query);

if ($result) {
  
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}



$conexion->close();
?>
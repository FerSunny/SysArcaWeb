<?php
include("../../controladores/conex.php");

$idvalor = $_POST["idvalor"];


$query="UPDATE cr_plantilla_1 set estado = 'S' WHERE fk_id_estudio ='$idvalor'";
//echo $query;
$result = $conexion->query($query);

if ($result) {
  echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
 ?>

<?php
include("../../controladores/conex.php");

$idvalor = $_POST["idvalor"];


$query="UPDATE cr_plantilla_cvo set estado = 'X' WHERE id_valor ='$idvalor'";

$result = $conexion->query($query);

if ($result) {
  echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
 ?>

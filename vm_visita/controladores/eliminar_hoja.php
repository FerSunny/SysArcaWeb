<?php
include("../../controladores/conex.php");

$id_hoja = $_POST["id_hoja"];
$activo="A";
$suspendido="S";


$query="UPDATE vm_hoja_visita set estado = 'S' WHERE id_hoja='$id_hoja'";
$resultado = $conexion -> query($query);

if($resultado){

}else{
  $codigo = mysql_errno($conexion);
  echo $codigo;
}

$conexion->close();

 
 ?>

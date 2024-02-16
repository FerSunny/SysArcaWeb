<?php
include("../../controladores/conex.php");

$id_agenda = $_POST["id_agenda"];
$activo="A";
$suspendido="S";


$query="UPDATE vm_agenda set estado = 'S' WHERE id_agenda='$id_agenda'";
$resultado = $conexion -> query($query);

if($resultado){

}else{
  $codigo = mysql_errno($conexion);
  echo $codigo;
}

$conexion->close();

 
 ?>

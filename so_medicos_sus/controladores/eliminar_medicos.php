<?php
include("../../controladores/conex.php");

$id_medico = $_POST["id_medico"];
$activo="A";
$suspendido="S";


$query="UPDATE so_medicos set estado = 'S' WHERE id_medico='$id_medico'";
$resultado = $conexion -> query($query);

if($resultado){

}else{
  $codigo = mysql_errno($conexion);
  echo $codigo;
}

$conexion->close();

 
 ?>

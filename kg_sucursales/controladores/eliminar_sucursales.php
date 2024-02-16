<?php
include("../../controladores/conex.php");

$id_sucursal = $_POST["id_sucursal"];
$activo="A";
$suspendido="S";


$query="UPDATE kg_sucursales SET estado = 'S' WHERE id_sucursal = '$id_sucursal'";
$resultado = $conexion -> query($query);

//echo $query;

if($resultado){
  //echo "Error en la consulta";
}else{
  $codigo = mysql_errno($conexion);
  echo $codigo;
}

$conexion->close();



 ?>

<?php
include("../../controladores/conex.php");

$id_cliente= $_POST['id_cliente'];

$query ="UPDATE so_clientes SET activo = 'S' WHERE id_cliente = $id_cliente ";
$result = $conexion -> query($query);

if ($result) {
  
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}



$conexion->close();
?>
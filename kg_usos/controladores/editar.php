<?php 
session_start();
include ("../../controladores/conex.php");
$id_uso= $_POST['id_uso'];
$clave_uso = $_POST['clave_uso'];
$desc_uso = $_POST['desc_uso'];

$query = "UPDATE kg_usos SET clave_uso = '$clave_uso', desc_uso= '$desc_uso'  WHERE id_uso = '$id_uso' ";

$stmt = $conexion -> prepare($query);

if ($stmt->execute()) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

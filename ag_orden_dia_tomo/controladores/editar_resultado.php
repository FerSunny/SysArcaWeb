<?php 

date_default_timezone_set('America/Chihuahua');
session_start();
include ("../../controladores/conex.php");
$id_factura= $_POST['id_factura'];
$estudio_id= $_POST['estudio_id'];

$titulo_desc = $_POST['titulo_desc'];
$descripcion = $_POST['descripcion'];
$firma = $_POST['firma'];



$query = "UPDATE cr_plantilla_tomo_re 
SET titulo_desc = '$titulo_desc', descripcion = '$descripcion', firma = '$firma'
WHERE fk_id_factura = '$id_factura' and fk_id_estudio = '$estudio_id'";




$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

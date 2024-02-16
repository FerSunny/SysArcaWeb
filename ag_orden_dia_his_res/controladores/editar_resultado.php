<?php 


session_start();
include ("../../controladores/conex.php");
$id_factura= $_POST['id_factura'];

$titulo_desc = $_POST['titulo_desc'];
$descripcion = $_POST['descripcion'];
$firma = $_POST['firma'];



$query = "UPDATE cr_plantilla_ekg_re 
SET titulo_desc = '$titulo_desc', descripcion = '$descripcion', firma = '$firma'
WHERE fk_id_factura = '$id_factura'";



$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

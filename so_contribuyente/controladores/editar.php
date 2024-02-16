<?php 


session_start();
include ("../../controladores/conex.php");
$id_facturacion= $_POST['id_facturacion'];
$nombre = $_POST['nombre'];
$rfc = $_POST['rfc'];
$domicilio = $_POST['domicilio'];
$email = $_POST['email'];


$query = "UPDATE so_facturacion SET nombre = '$nombre', rfc= '$rfc', domicilio= '$domicilio', email = '$email'  WHERE id_facturacion = '$id_facturacion' ";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

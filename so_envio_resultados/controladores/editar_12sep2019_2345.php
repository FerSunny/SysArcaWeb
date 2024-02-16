<?php 


session_start();
include ("../../controladores/conex.php");



$pro = $_POST['pro'];
$codigo  = $_POST['codigo'];
$producto =$_POST['producto'];
$desc_p = $_POST['desc_p']; 
$uni = $_POST['uni'];
$costo = $_POST['costo'];
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
//$depto = $_POST['depto']; 
$proveedor = $_POST['proveedor'];
$cat = $_POST['cat'];
$caducidad = $_POST['caducidad'];


$query = "UPDATE eb_productos
SET

 cod_producto = '$codigo',
 producto = '$producto',
 desc_producto = '$desc_p',
 fk_unidad_medida = '$uni',
 costo_producto = '$costo',
 utilidad = '$utilidad',
 costo_total = '$c_total',
 fk_id_proveedor = '$proveedor',
 fk_id_categoria = '$cat',
 caducidad = '$caducidad'
WHERE id_producto = '$pro'";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>



































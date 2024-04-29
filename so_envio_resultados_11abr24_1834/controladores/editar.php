<?php 


session_start();
include ("../../controladores/conex.php");



$pro = $_POST['pro'];
$codigo  = $_POST['codigo'];
$producto =$_POST['producto'];
$desc_p = $_POST['desc_p']; 
$uni = $_POST['uni'];
$lote =$_POST['lote'];
$num_p = $_POST['num_p'];
$costo = $_POST['costo'];
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
//$depto = $_POST['depto']; 
$proveedor = $_POST['proveedor'];
$cat = $_POST['cat'];
$caducidad = $_POST['caducidad'];
$con = $_POST['con'];
$fecha_actualizacion = date("Y-m-d H:i:s");


$query = "UPDATE eb_productos
SET

 cod_producto = '$codigo',
 producto = '$producto',
 desc_producto = '$desc_p',
 fk_unidad_medida = '$uni',
 lote = '$lote',
 numero_p = '$num_p',
 costo_producto = '$costo',
 utilidad = '$utilidad',
 costo_total = '$c_total',
 fk_id_proveedor = '$proveedor',
 fk_id_categoria = '$cat',
 caducidad = '$caducidad',
 fecha_actualizacion = '$fecha_actualizacion',
 fk_id_tipo_consumo = $con
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



































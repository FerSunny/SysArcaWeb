<?php 

date_default_timezone_set('America/Mexico_City');
$FechaHoy=date("y/m/d  H:i:s");
session_start();
include ("../../controladores/conex.php");

$id_unidades= $_POST['id_unidades'];
$fk_id_proveedor  = $_POST['proveedor'];
$producto = $_POST['producto'];
$esxistencia = $_POST['exis']; 
$minimo = $_POST['min']; 
$maximo = $_POST['max']; 




$query = "UPDATE 
eb_almacen_unidades
 SET  
 fk_id_producto = '$producto', 
 fk_id_proveedor = '$fk_id_proveedor', 
 existencias = '$esxistencia',
 min = '$minimo',
 max ='$maximo',
 fecha_actualizacion = '$FechaHoy'
  WHERE id_unidades ='$id_unidades'";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
  echo $query,"mal";
}
$conexion->close();

?>



































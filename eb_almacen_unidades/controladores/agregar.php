<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


$desc_producto = $_POST['producto'];
$razon_social = $_POST['proveedor'];
$existencias = $_POST['existencias'];
$min = $_POST['min'];
$max = $_POST['max'];


$query ="INSERT INTO eb_almacen_unidades
             (fk_id_empresa, fk_id_sucursal,  fk_id_producto, fk_id_proveedor, existencias, min, max )
VALUES (1,$sucursal,'$desc_producto','$razon_social','$existencias','$min','$max')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
<?php 


session_start();
include ("../../controladores/conex.php");
$id_unidades= $_POST['id_unidades'];
$desc_producto = $_POST['producto'];
$razon_social = $_POST['proveedor'];
$existencias = $_POST['existencias'];
$min = $_POST['min'];
$max = $_POST['max'];

$query = "UPDATE eb_almacen_unidades SET fk_id_producto=$desc_producto, existencias = $existencias, min=$min, max=$max, fk_id_proveedor=$razon_social  WHERE id_unidades = $id_unidades ";





$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

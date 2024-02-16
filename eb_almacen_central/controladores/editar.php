<?php 


session_start();
include ("../../controladores/conex.php");
$id_central= $_POST['id_central'];
$desc_producto = $_POST['producto'];
$razon_social = $_POST['proveedor'];
$existencias = $_POST['existencias'];
$min = $_POST['min'];
$max = $_POST['max'];

if ($max>$min) {

	$query = "UPDATE eb_almacen_central SET fk_id_producto=$desc_producto, existencias = $existencias, min=$min, max=$max, fk_id_proveedor=$razon_social  WHERE id_central = $id_central ";
}else{

	


}


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;

}
$conexion->close();

?>

<?php 


session_start();
include ("../../controladores/conex.php");



$prov = $_POST['prov'];
$provee  = $_POST['provee'];
$respon = $_POST['respon']; 

$query = "UPDATE eb_proveedores
SET

 razon_social = '$provee',
 nombre_respon = '$respon'
WHERE id_proveedor = '$prov'";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>



































<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


$codigo  = $_POST['codigo'];
$producto = $_POST['producto'];
$desc_p = $_POST['desc_p']; 
$uni = $_POST['uni'];
$costo = $_POST['costo']; 
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
//$depto = $_POST['depto']; 
$proveedor = $_POST['proveedor'];
$cat = $_POST['cat'];
$caducidad = $_POST['caducidad'];


$query ="INSERT INTO eb_productos
            (fk_id_empresa,fk_id_sucursal,cod_producto,producto,desc_producto,fk_unidad_medida,costo_producto,utilidad,costo_total,fk_id_proveedor,fk_id_categoria,caducidad)
VALUES (1,$sucursal,'$codigo','$producto','$desc_p','$uni','$costo','$utilidad','$c_total','$proveedor','$cat','$caducidad')";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

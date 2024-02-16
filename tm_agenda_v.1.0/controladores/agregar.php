<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


$id_factura  = $_POST['codigo'];
$id_estudio = $_POST['id_estudio'];
$desc_p = $_POST['desc_p']; 
$costo = $_POST['costo']; 
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
$depto = $_POST['depto']; 
$proveedor = $_POST['proveedor'];
$cat = $_POST['cat'];
$caducidad = $_POST['caducidad'];


$query ="INSERT INTO eb_productos
            (fk_id_empresa,fk_id_sucursal,cod_producto,producto,desc_producto,costo_producto,utilidad,costo_total,departamento,fk_id_proveedor,fk_id_categoria,caducidad)
VALUES (1,$sucursal,'$codigo','$producto','$desc_p','$costo','$utilidad','$c_total','$depto','$proveedor','$cat','$caducidad')";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

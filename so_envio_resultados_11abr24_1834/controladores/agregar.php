<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


$codigo  = $_POST['codigo'];
$producto = $_POST['producto'];
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
$fecha_registro = date("Y-m-d H:i:s");
$fecha_actualizacion = date("Y-m-d H:i:s");


$query ="INSERT INTO eb_productos
            (fk_id_empresa,fk_id_sucursal,cod_producto,producto,desc_producto,fk_unidad_medida,lote,numero_p,costo_producto,utilidad,costo_total,fk_id_proveedor,fk_id_categoria,caducidad,fecha_registro,fecha_actualizacion,fk_id_tipo_consumo)
VALUES (1,$sucursal,'$codigo','$producto','$desc_p','$uni','$lote','$num_p','$costo','$utilidad','$c_total','$proveedor','$cat','$caducidad','$fecha_registro','$fecha_actualizacion',$con)";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

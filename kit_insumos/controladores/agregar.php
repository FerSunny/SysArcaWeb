<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];
$empresa=1;
$fecha=date("y/m/d H:i:s");
//$factura=1;

/*
$codigo  = $_POST['codigo'];
$producto = $_POST['producto'];
$desc_p = $_POST['desc_p']; 
$costo = $_POST['costo']; 
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
*/
$articulo = $_POST['articulo']; 
$cantidad = $_POST['cantidad'];
$studio = $_POST['id_estudio'];
$fecha_registro = date("y-m-d H:i:s");
$fecha_actualizacion = date("y-m-d H:i:s");

$costo_producto=0;

$sql_max="SELECT costo_producto FROM eb_productos
WHERE estado = 'A' and id_producto = ".$articulo;
// echo $sql_max;

if ($result = mysqli_query($conexion, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $costo_producto =$row['costo_producto'];
  }
}



$query ="INSERT INTO km_insumos_estudio
            (fk_id_empresa, fk_id_sucursal, id_insumo_estudio, fk_id_estudio, fk_id_producto, precio, cantidad, fecha_registro,fecha_actualizacion, estado)
VALUES (1,$sucursal,0,$studio,$articulo,$costo_producto,$cantidad,'$fecha_registro','$fecha_actualizacion','A')";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
    echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

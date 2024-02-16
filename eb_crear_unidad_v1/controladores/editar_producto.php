<?php 


session_start();
include ("../../controladores/conex.php");

$sucursal =$_SESSION['fk_id_sucursal'];

$id_solicitud = $_POST['codigo'];
$cantidad  = $_POST['cantidad'];
$producto  = $_POST['producto'];

$stmt_pro=
"
select pr.* from eb_productos pr where id_producto = $producto
";
if ($result_pro = mysqli_query($conexion, $stmt_pro)) {
  while($row_pro = $result_pro->fetch_assoc())
  {
      $costo_total=$row_pro['costo_total'];
      $fk_id_proveedor=$row_pro['fk_id_proveedor'];
  }
}

$importe_total= $cantidad*$costo_total;
     
$query ="
UPDATE eb_solicitudes
SET 
  fk_id_proveedor = $fk_id_proveedor,
  fk_id_producto = $producto,
  cantidad = $cantidad,
  costo_pza = $costo_total,
  importe_total = $importe_total
WHERE `id_solicitud` = $id_solicitud
";

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
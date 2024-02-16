<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];
$usuario =$_SESSION['id_usuario'];
$id_detalle =$_SESSION['id_detalle'];


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
INSERT INTO eb_solicitudes
            (fk_id_empresa,
             fk_id_sucursal,
             fk_id_area,
             fk_id_proveedor,
             fk_id_producto,
             fk_id_usuario,
             id_solicitud,
             fk_id_detalle,
             cantidad,
             costo_pza,
             importe_total,
             cantidad_real,
             costo_real_pza,
             importe_real_total,
             fecha_registro,
             estado,
             estatus,
             tipo,
             llego)
VALUES (1,
        $sucursal,
        1,
        $fk_id_proveedor,
        $producto,
        $usuario,
        0,
        $id_detalle,
        $cantidad,
        $costo_total,
        $importe_total,
        0, 
        0, 
        0, 
        NOW(),
        'A',
        'L',
        '2',
        '');
";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
  $stmt_up=
  "
  update eb_detalle_solicitud
  set 
  importe_total = (importe_total+$importe_total),
  importe_real_total = (importe_real_total+$importe_total)
  where id_detalle = $id_detalle
  ";
  //echo $stmt_up;
  $execute_query_update = mysqli_query($conexion,$stmt_up);
  echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

/*
$query ="INSERT INTO eb_departamento
            (fk_id_empresa,fk_id_sucursal,desc_departamento,descripcion,responsable,fk_sucursal)
VALUES (1,'$sucursal','$depto','$descrip','$respon','$suc')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
*/
?>

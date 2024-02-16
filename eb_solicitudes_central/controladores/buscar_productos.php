<?php
include("../../controladores/conex.php");

$id = $_POST['id'];
$sol = $_POST['sol'];

$stmt = $conexion->prepare("SELECT sol.id_solicitud,pt.desc_producto,pro.razon_social,sol.cantidad,sol.costo_pza costo_total,sol.fk_id_sucursal,sol.fk_id_producto,sol.fk_id_proveedor,sol.cantidad,
      sol.fk_id_detalle,sol.tipo,sol.importe_total
   FROM eb_solicitudes sol
LEFT OUTER JOIN eb_proveedores pro ON (pro.id_proveedor = sol.fk_id_proveedor)
LEFT OUTER JOIN eb_productos pt ON (pt.id_producto = sol.fk_id_producto)
WHERE fk_id_detalle = ? AND id_solicitud = ?
ORDER BY sol.id_solicitud");
$stmt->bind_param("ii",$id,$sol);

if($stmt->execute())
{
  $result = $stmt->get_result();
  $data=array();
  while ($row = $result->fetch_assoc()){
    $data[]= $row;
  }

  echo json_encode($data);

}else
{

}


 ?>

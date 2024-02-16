<?php

session_start();
include ("../../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d H:i:s");
$data=json_decode($_POST['datas'],true);

  foreach($data as $objeto)
  {
    $orden=$objeto['td0'];
    $tipo=$objeto['td1'];
    $concepto=$objeto['td2'];
    $resultado=$objeto['td3'];
    $verificado=$objeto['td4'];
    $observaciones=$objeto['observaciones'];
    $id_factura=$objeto['factura'];
    $id_studio=$objeto['estudio'];

    	$stmt = $conexion->prepare("UPDATE cr_plantilla_2_re SET valor = ?, verificado = ?, observaciones = ?, fecha_modificacion = ? WHERE orden = ? AND fk_id_factura = ? AND fk_id_estudio = ?");
      $stmt->bind_param('ssssdii',$resultado,$verificado,$observaciones,$fecha,$orden,$id_factura,$id_studio);
      $result = $stmt->execute();

  }
  
  $val = 1;
  header('Content-Type: application/json');
  echo $val;


?>

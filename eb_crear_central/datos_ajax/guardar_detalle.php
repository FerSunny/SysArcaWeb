<?php

include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');

session_start();
$iduser = $_SESSION['id_usuario'];
$sucursal = $_SESSION['fk_id_sucursal'];
$empresa = 1;
$total = $_POST['imp_total'];
$fecha = date("Y-m-d H:i:s");
$activo = 'A';
$status = 'C';
$tipo = 1;
$stmt = $conexion->prepare("INSERT INTO eb_detalle_solicitud (
  fk_id_empresa,
  fk_id_sucursal,
  fk_id_usuario,
  importe_total,
  estatus,
  fecha_registro,
  estado,
  tipo,
  importe_real_total
)
VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param('iiidsssid',$empresa,$sucursal,$iduser,$total,$status,$fecha,$activo,$tipo,$total);

    if ($stmt->execute())
    {
      echo 1;
    } else
    {
      $codigo = mysqli_errno($conexion);
      echo $codigo;
    }

 ?>

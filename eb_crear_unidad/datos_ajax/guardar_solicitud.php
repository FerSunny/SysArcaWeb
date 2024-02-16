<?php
include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');

session_start();
$iduser = $_SESSION['id_usuario'];
$sucursal = $_SESSION['fk_id_sucursal'];
$empresa = 1;
$area = 1;

$td0 = $_POST['td0'];//ID Proveedor
$td1 = $_POST['td1'];//ID Producto
$td2 = $_POST['td2'];// Codigo producto
$td5 = $_POST['td5'];//Cantidad
$td6 = $_POST['td6'];//Costo
$td7 = $_POST['td7'];//Importe
$folio = $_POST['folio'];//Importe
$fecha = date("Y-m-d H:i:s");
$activo = 'A';
$status = 'C';
$tipo = 2;
$stmt = $conexion->prepare("INSERT INTO eb_solicitudes (
  fk_id_empresa,
  fk_id_sucursal,
  fk_id_area,
  fk_id_proveedor,
  fk_id_producto,
  fk_id_usuario,
  fk_id_detalle,
  cantidad,
  costo_pza,
  importe_total,
  fecha_registro,
  estado,
  estatus,
  tipo,
  costo_real_pza,
  importe_real_total
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param('iiiiiiiiddsssidd',$empresa,$sucursal,$area,$td0,$td1,$iduser,$folio,$td5,$td6,$td7,$fecha,$activo,$status,$tipo,$td6,$td7);

    if ($stmt->execute())
    {
      echo 1;
    } else
    {
      $codigo = mysqli_errno($conexion);
      echo $codigo;
    }
 ?>

<?php
require_once ("../config/db.php");
require_once ("../config/conexion.php");
date_default_timezone_set('America/Mexico_City');
$f_nombre = $_POST['f_nombre'];
$f_rfc = $_POST['f_rfc'];
$f_dom = $_POST['f_dom'];
$f_mail = $_POST['f_mail'];
$f_usos = $_POST['f_usos'];
$f_pago = $_POST['f_pago'];
$fecha = date("Y-m-d H:i:s");

$stmt = $con->prepare("INSERT INTO so_facturacion(nombre,rfc,domicilio,email,fk_id_usos,fk_id_tipo_pago,fecha_registro)
                        VALUES (?,?,?,?,?,?,?)");

$stmt->bind_param("ssssiis",$f_nombre,$f_rfc,$f_dom,$f_mail,$f_usos,$f_pago,$fecha);
if($stmt->execute()){
  echo 1;
}else {
  $codigo = mysqli_errno($con);
  echo $codigo;
}


?>

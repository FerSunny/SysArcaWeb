<?php
include "../controladores/conex.php";
date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d");
$dias = array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO');
$numero = date("w")-1;
switch ($numero) {
  case '0':
        $i = $fecha;
        $f= date("Y-m-d", strtotime("$fecha   6 day"));
    break;
  case '1':
        $i= date("Y-m-d", strtotime("$fecha   -1 day"));
        $f= date("Y-m-d", strtotime("$fecha   5 day"));
    break;
  case '2':
        $i= date("Y-m-d", strtotime("$fecha   -2 day"));
        $f= date("Y-m-d", strtotime("$fecha   4 day"));
    break;
  case '3':
        $i= date("Y-m-d", strtotime("$fecha   -3 day"));
        $f= date("Y-m-d", strtotime("$fecha   3 day"));
    break;
  case '4':
        $i= date("Y-m-d", strtotime("$fecha   -4 day"));
        $f= date("Y-m-d", strtotime("$fecha   2 day"));
    break;
  case '5':
        $i= date("Y-m-d", strtotime("$fecha   -5 day"));
        $f= date("Y-m-d", strtotime("$fecha   1 day"));
    break;
  case '6':
        $i= date("Y-m-d", strtotime("$fecha   -6 day"));
        $f= date("Y-m-d", strtotime("$fecha   0 day"));
    break;
  default:
    // code...
    break;
}
$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
$stmt->execute();
$stmt = $conexion->prepare("SELECT id_usuario,CONCAT(nombre,' ',a_paterno,' ',a_materno) paciente FROM se_usuarios WHERE activo = 'A' AND huella > '' ");
$stmt->execute();
$result = $stmt->get_result();
while ($row =  $result->fetch_assoc()) {
$arreglo["data"][]=$row;
}

echo json_encode($arreglo);

?>

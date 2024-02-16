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
$stmt = $conexion->prepare("SELECT
DISTINCT
ga.fk_id_usuario,
CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_materno) nombre,
 ga.fecha_asistencia,
DATE_FORMAT(ga.fecha_asistencia, '%d') dia,
DATE_FORMAT(ga.fecha_asistencia, '%M') mes,
DATE_FORMAT(ga.fecha_asistencia, '%Y') año,
CASE
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'SABADO' THEN
'Sabado'
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'DOMINGO' THEN
'Domingo'
ELSE
'Lunes-Viernes'
END semana,
CASE
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'SABADO' THEN
CONCAT(us.entra_s,'-',us.salida_s)
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'DOMINGO' THEN
CONCAT(us.entra_d,'-',us.salida_d)
ELSE
CONCAT(us.entra,'-',us.salida)
END horario,
(SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia) minimo,
(SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia) maximo,
CASE
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'SABADO' THEN
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra_s)
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'DOMINGO' THEN
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra_d)
ELSE
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)
END acceso
FROM generar_asistencia ga
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
WHERE DATE(ga.fecha_asistencia) >= '$i' AND DATE(ga.fecha_asistencia) <= '$f'");
$stmt->execute();
$result = $stmt->get_result();
while ($row =  $result->fetch_assoc()) {
$arreglo["data"][]=$row;
}

echo json_encode($arreglo);

?>

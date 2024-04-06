<?php
date_default_timezone_set('America/Mexico_City');
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$anio = $_POST['anio']; //estado
$mes = $_POST['mes'];
$dia = $_POST['dia'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$id_usuario = $_SESSION['id_usuario'];


// obtenemos los medicos del dia 
$sql_max="
SELECT ag.*
FROM vm_agenda ag
WHERE ag.`estado` = 'A'
AND ag.`fk_id_usuario` = $id_usuario
AND YEAR(ag.`fecha`) = $anio
AND MONTHNAME(ag.`fecha`) = '$mes'
AND DAY(ag.`fecha`) = $dia
"
;
  $veces='0';
  if ($result = mysqli_query($con, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $stm_insert="
        INSERT INTO vm_agenda
                    (fk_id_empresa,
                     id_agenda,
                     fk_id_usuario,
                     fk_id_medico,
                     fecha,
                     hora,
                     estado,
                     planeado)
        VALUES (1,
                0,
                $id_usuario,
                $row['fk_id_medico'],
                '$fecha',
                '$row['hora']',
                'A',
                'S')
        ";
        $execute_query_update = mysqli_query($con,$stm_insert);
  }

//
?>

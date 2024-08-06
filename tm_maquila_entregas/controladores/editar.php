<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

//$lote  = $_POST['lote'];

$hora_llegada =$_POST['hora_llegada'];

$hora_salida = $_POST['hora_salida']; 

$temperatura = $_POST['temperatura'];

$termometro = $_POST['termometro'];

$fecha_toma = $_POST['fecha_toma'];

$q_upate="
      UPDATE `tm_tomas`
      SET 
        `fecha_llego` = '$hora_llegada',
        `fecha_salio` = '$hora_salida',
        `temperatura` = '$temperatura',
        `fk_id_termometro` = '$termometro',
        aceptado_ia = 2
      WHERE fk_id_equipo = '$codigo'
      AND date(fecha_toma) = '$fecha_toma' 
    ";
    //echo $q_upate;
    $result1 = $conexion -> query($q_upate);
    if ($result1) {
        echo 1;
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }
    $conexion->close();






?>






































































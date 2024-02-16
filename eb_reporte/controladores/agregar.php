<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];




$codigo  = $_POST['codigo'];

$problema = $_POST['problema'];

$equipo = $_POST['equipo'];

$dequipo = $_POST['dequipo'];

$freporte = $_POST['freporte']; 

$prioridad = $_POST['prioridad']; 



$query ="
INSERT INTO eb_reportes
            (fk_id_empresa,
             id_reporte,
             desc_reporte,
             fk_id_sucursal,
             fk_id_usuario,
             fk_id_equipo,
             desc_equipo,
             fecha_reporte,
             prioridad,
             fecha_atencion,
             fecha_termino,
             estatus,
             estado)
VALUES (1,
        0,
        '$problema',
        '$sucursal',
        '$id_usuario',
        $equipo,
        '$dequipo',
        NOW(),
        $prioridad,
        NULL,
        NULL,
        1,
        'A');
";



$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>


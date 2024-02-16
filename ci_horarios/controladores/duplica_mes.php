<?php 



session_start();

include ("../../controladores/conex.php");

//$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];


$pro  = $_POST['pro']; // anio

$codigo  = $_POST['codigo']; // mes

$sucursal = $_POST['sucursal'];

$periodo = $_POST['periodo']; 

$estatus = 0;
// borramos el mes a guardar, para evitar duplicados
$query_borra ="delete  from ca_horarios 
WHERE fk_id_sucursal = $sucursal
AND YEAR(dia_atencion) = $pro
AND MONTH(dia_atencion) = $codigo
";
//echo $query_borra;
/*
//echo $query_borra;
$result0 = $conexion -> query($query_borra);
if ($result0) {
    $estatus=1;
}else{
    $error = mysqli_errno($conexion); 
    $estatus = $error;
    $codigo=0; // movemos el dia a ceros para que no entre a duplicar los meses
}

// EOF
*/

$anio_nuevo = substr ($periodo, 0, 4);
$mes_nuevo = substr ($periodo, 5, 2);

// extraemos los datos del mes seleccionado
$sql_periodo="
SELECT h.*,
    day(h.dia_atencion) as dia
 FROM ca_horarios h
WHERE h.`fk_id_sucursal` = $sucursal
AND YEAR(h.`dia_atencion`) = $pro
AND MONTH(h.`dia_atencion`) = $codigo
";

$estatus=0;
if ($result1 = mysqli_query($conexion, $sql_periodo)) {
  while($row = $result1->fetch_assoc())
  {
        $servicio = $row['fk_id_servicio'];
        $medico = $row['fk_id_medico'];
        $subrrogado = $row['subrrogado'];
        $dia=$row['dia'];

        $fecha=$anio_nuevo.'/'.$mes_nuevo.'/'.$dia;

        $hinicio= $row['hora_inicio'];
        $hfinal= $row['hora_final'];


        $query ="
        INSERT INTO `ca_horarios`
                    (`fk_id_empresa`,`fk_id_sucursal`,`fk_id_servicio`,`fk_id_medico`,`subrrogado`,`dia_atencion`,`hora_inicio`,
                     `hora_final`,`fecha_alta`,`fecha_modifica`,`fecha_baja`,`id_usuario`,`estado`)
        VALUES (1,
                $sucursal,
                $servicio,
                $medico,
                '$subrrogado',
                '$fecha',
                '$hinicio',
                '$hfinal',
                now(),
                NULL,
                NULL,
                '$id_usuario',
                'A')
        ";

// echo $query;

        $result = $conexion -> query($query);

        if ($result) {
            $estatus = 1;
        }else{
          $error = mysqli_errno($conexion); 
          $estatus = $error;
        }


  }
}

echo $estatus;


$conexion->close();



?>


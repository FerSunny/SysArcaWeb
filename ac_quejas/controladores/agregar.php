<?php 



session_start();

include ("../../controladores/conex.php");

$id_usuario = $_SESSION['id_usuario'];





$q_o_s  = $_POST['q_o_s'];

$fecha_queja = $_POST['fecha_queja'];

$origen = $_POST['origen']; 

$tipo = $_POST['tipo']; 

$medico = $_POST['medico']; 

$paciente = $_POST['paciente']; 

$empleado = $_POST['empleado']; 

$orden = $_POST['orden'];

$sucursal = $_POST['sucursal'];

$inconformidad = $_POST['inconformidad'];

$observaciones=$_POST['observaciones'];







$query ="
INSERT INTO ac_quejas
            (fk_id_empresa,
             id_queja,
             fk_id_inconformidad,
             fk_id_usuario,
             fecha_queja,
             fk_id_origen,
             fk_id_tipo_queja,
             fk_id_medicos,
             fk_id_paciente,
             fk_id_empleado,
             fk_id_sucursal,
             fk_id_folio,
             descripcion,
             observaciones,
             fk_id_procede,
             fecha_solucion,
             fk_id_estatus,
             fecha_estatus,
             estado)
VALUES (0,
        0,
        $q_o_s,
        $id_usuario,
        '$fecha_queja',
        $origen,
        $tipo,
        '$medico',
        '$paciente',
        '$empleado',
        '$sucursal',
        '$orden',
        '$inconformidad',
        '$observaciones',
        0,
        NULL,
        1,
        now(),
        'A')
";

//echo $query;

$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>


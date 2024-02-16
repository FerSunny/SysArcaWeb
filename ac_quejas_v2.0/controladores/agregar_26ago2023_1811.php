<?php 



session_start();

include ("../../controladores/conex.php");

$id_usuario = $_SESSION['id_usuario'];





$q_o_s  = $_POST['q_o_s'];

$fecha_queja = $_POST['fecha_queja'];

$origen = $_POST['origen']; 

$tipo = $_POST['tipo']; 

$medico_id = $_POST['medico_id']; 

$paciente_id = $_POST['cliente_id']; 

$empleado = $_POST['empleado']; 

$orden_id = $_POST['orden_id'];

$sucursal = $_POST['sucursal'];

$inconformidad = $_POST['inconformidad'];

$observaciones=$_POST['observaciones'];



// obtenemos el id_medico del medico
$id_medico=0;
$stmt_m="SELECT id_medico FROM so_medicos WHERE CONCAT(nombre,' ',a_paterno,' ',a_materno) = '$medico_id'";
// echo $stmt_m;
if ($result_m = mysqli_query($conexion, $stmt_m)) {
    while($row_m = $result_m->fetch_assoc())
    {
        $id_medico=$row_m['id_medico'];
    }
  }

// obtenemos el id_medico del medico
$id_paciente=0;
$stmt_p="SELECT id_cliente FROM so_clientes WHERE CONCAT(nombre,' ',a_paterno,' ',a_materno) = '$paciente_id'";
// echo $sql_max;
if ($result_p = mysqli_query($conexion, $stmt_p)) {
    while($row_p = $result_p->fetch_assoc())
    {
        $id_paciente=$row_p['id_cliente'];
    }
  }


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
             estado,
             fecha_real)
VALUES (0,
        0,
        $q_o_s,
        $id_usuario,
        '$fecha_queja',
        $origen,
        $tipo,
        '$id_medico',
        '$id_paciente',
        '$empleado',
        '$sucursal',
        '$orden_id',
        '$inconformidad',
        '$observaciones',
        0,
        NULL,
        1,
        now(),
        'A',
        now()
        )
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


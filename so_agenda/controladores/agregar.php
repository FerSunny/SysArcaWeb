<?php 



session_start();

include ("../../controladores/conex.php");

$id_usuario = $_SESSION['id_usuario'];





$fecha  = $_POST['fecha'];

$hora = $_POST['hora'];

$duracion = $_POST['duracion']; 

$sucursal = $_POST['sucursal']; 

$area = $_POST['area']; 

$observa = $_POST['observa']; 

$paciente_id = $_POST['cliente_id']; 

$estudio_id = $_POST['estudio_id'];


// obtenemos el id_medico del paciente
$id_paciente=0;
$stmt_p="SELECT id_cliente FROM so_clientes WHERE CONCAT(nombre,' ',a_paterno,' ',a_materno) = '$paciente_id'";
// echo $sql_max;
if ($result_p = mysqli_query($conexion, $stmt_p)) {
    while($row_p = $result_p->fetch_assoc())
    {
        $id_paciente=$row_p['id_cliente'];
    }
  }

// obtenemos el id_medico del estudio
$id_estudio=0;
$stmt_e="SELECT id_estudio FROM km_estudios WHERE iniciales = '$estudio_id'";
// echo $sql_max;
if ($result_e = mysqli_query($conexion, $stmt_e)) {
    while($row_e = $result_e->fetch_assoc())
    {
        $id_estudio=$row_e['id_estudio'];
    }
  }



$query ="
INSERT INTO so_agenda
            (fk_id_empresa,
             id_evento,
             fk_id_sucursal,
             fecha,
             hora,
             fk_id_paciente,
             fk_id_area,
             fk_id_estudio,
             observaciones,
             fk_id_usuario,
             estado)
VALUES (1,
        0,
        $sucursal,
        '$fecha',
        '$hora',
        $id_paciente,
        $area,
        $id_estudio,
        '$observa',
        $id_usuario,
        'A')
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


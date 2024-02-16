<?php 





session_start();

include ("../../controladores/conex.php");





$codigo  = $_POST['codigo'];

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




$query = "
UPDATE `ac_quejas`
SET
  
  fk_id_inconformidad = $q_o_s,
  fecha_queja = '$fecha_queja',
  fk_id_origen = $origen,
  fk_id_tipo_queja = $tipo,
  fk_id_medicos = '$medico',
  fk_id_paciente = $paciente,
  fk_id_empleado = $empleado,
  fk_id_sucursal = $sucursal,
  fk_id_folio = $orden,
  descripcion = '$inconformidad',
  observaciones = '$observaciones'
WHERE id_queja = $codigo;
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






































































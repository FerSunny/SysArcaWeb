<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$fecha  = $_POST['fecha'];

$hora = $_POST['hora'];

$hora_termino = $_POST['duracion']; 

$sucursal = $_POST['sucursal']; 

$area = $_POST['area']; 

$observa = $_POST['observa']; 

$paciente_id = $_POST['cliente_id']; 

$estudio_id = $_POST['estudio_id'];

// validamos si se modifico los horarios
$stmt_ag="
select 
ag.*
from so_agenda ag
where ag.id_evento = $codigo
";
// echo $sql_max;
if ($result_ag = mysqli_query($conexion, $stmt_ag)) {
    while($row_ag = $result_ag->fetch_assoc())
    {
        $hora_bd=$row_ag['hora'];
        $hora_termino_bd=$row_ag['hora_termino'];
    }
  }

if($hora <> $hora_bd){
  // validamos si existe el horario en la BD
  $existe=0;
  $stmt_ex="
  select 
  count(*) existe
  from so_agenda ag
  where ag.`fk_id_sucursal` = $sucursal
  AND ag.`fk_id_area` = $area
  and ag.`fecha` = '$fecha'
  and ag.estado = 'A'
  and '$hora' between hora and hora_termino
  ";
  // echo $sql_max;
  if ($result_ex = mysqli_query($conexion, $stmt_ex)) {
      while($row_ex = $result_ex->fetch_assoc())
      {
          $existe=$row_ex['existe'];
      }
  }
  if ($existe == 0){
    $query = "
    update so_agenda
    set 
      fk_id_sucursal = $sucursal,
      fecha = '$fecha',
      hora = '$hora',
      hora_termino = '$hora_termino',
      fk_id_area = $area,
      observaciones = '$observa' 
    where id_evento = $codigo
    ";
    $result = $conexion -> query($query);
    if ($result) {
        echo 1;
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }
  }else{
    echo 2;
  }
}else{
  $query = "
  update so_agenda
  set 
    fk_id_sucursal = $sucursal,
    fecha = '$fecha',
    hora = '$hora',
    hora_termino = '$hora_termino',
    fk_id_area = $area,
    observaciones = '$observa' 
  where id_evento = $codigo
  ";
  $result = $conexion -> query($query);
  if ($result) {
      echo 1;
  }else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
  }
}

$conexion->close();



?>






































































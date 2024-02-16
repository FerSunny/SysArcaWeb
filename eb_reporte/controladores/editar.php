<?php 





session_start();

include ("../../controladores/conex.php");







$codigo  = $_POST['codigo'];

$problema = $_POST['problema'];

$equipo = $_POST['equipo'];

$dequipo = $_POST['dequipo'];

$freporte = $_POST['fecha']; 

$prioridad = $_POST['prioridad']; 


$query = "
UPDATE eb_reportes
SET
  desc_reporte = '$problema',
  fk_id_equipo = $equipo,
  desc_equipo = '$dequipo',
  fecha_reporte = '$freporte',
  prioridad = $prioridad
WHERE id_reporte = $codigo;
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






































































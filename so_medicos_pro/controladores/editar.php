<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];


$medico=0;
$nombre = $_POST['nombre']; 
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$observaciones = $_POST['observaciones'];
$medico = $_POST['medico'];

if($medico == 1607 or $medico ==''){
  $medico =0;
}


$query = "
UPDATE so_medicos_pro
SET 

  nombre = '$nombre',
  a_paterno = '$apaterno',
  a_materno = '$amaterno',
  observaciones = '$observaciones',
  fk_id_medico = $medico

WHERE id_prospecto = $codigo;
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






































































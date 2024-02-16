<?php 





session_start();

include ("../../controladores/conex.php");









$codigo  = $_POST['codigo'];

$clave =$_POST['clave'];

$desc = $_POST['desc']; 

$servicio = $_POST['servicio'];



$query = "UPDATE km_areas
SET 
  clave = '$clave',
  desc_area = '$desc',
  fk_id_servicio = $servicio
WHERE id_area = $codigo;
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






































































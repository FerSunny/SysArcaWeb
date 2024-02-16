<?php 





session_start();

include ("../../controladores/conex.php");









$codigo  = $_POST['codigo'];

$clave =$_POST['clave'];

$desc = $_POST['desc']; 

$area = $_POST['area'];



$query = "UPDATE kg_rechazos
SET 
  clave = '$clave',
  desc_rechazo = '$desc',
  fk_id_area = $area
WHERE id_rechazo = $codigo;
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






































































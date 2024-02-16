<?php 


include ("../../controladores/conex.php");
$id_plantilla= $_POST['id_plantilla'];

$query ="UPDATE cr_plantilla_rx SET estado = 'S' WHERE id_plantilla = $id_plantilla ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}



$conexion->close();
?>
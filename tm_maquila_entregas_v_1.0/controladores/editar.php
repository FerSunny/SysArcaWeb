<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$medio =$_POST['medio'];

$equipo = $_POST['equipo']; 


$query = "UPDATE tm_tomas
SET
 fk_id_medio = '$medio',
 fk_id_equipo = '$equipo'

WHERE id_toma = '$codigo'";


$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































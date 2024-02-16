<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];



$epitelio =$_POST['epitelio'];



$query = "UPDATE km_epitelio

SET



 desc_epitelio = '$epitelio'

WHERE id_epitelio = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































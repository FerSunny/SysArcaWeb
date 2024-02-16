<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];



$zona =$_POST['zona'];



$query = "UPDATE km_zona

SET



 desc_zona = '$zona'

WHERE id_zona = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































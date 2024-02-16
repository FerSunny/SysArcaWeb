<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];



$colpo =$_POST['colpo'];



$query = "UPDATE km_colpo

SET



 desc_colpo = '$colpo'

WHERE id_colpo = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































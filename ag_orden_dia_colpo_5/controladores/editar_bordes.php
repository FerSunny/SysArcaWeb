<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];



$borde =$_POST['borde'];



$query = "UPDATE km_bordes

SET



 desc_borde = '$borde'

WHERE id_borde = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































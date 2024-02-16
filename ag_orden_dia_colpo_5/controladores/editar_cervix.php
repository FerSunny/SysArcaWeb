<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];



$cervix =$_POST['cervix'];



$query = "UPDATE km_cervix

SET



 desc_cervix = '$cervix'

WHERE id_cervix = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































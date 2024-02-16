<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$turno = $_POST['turno'];
 



$query = "
UPDATE no_turnos
SET 

  `codigo` = '$codigo',
  `desc_turno` = '$turno',

  `fecha_actualiza` = now()

WHERE `id_turno` = $pro
";

//echo $query;



$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































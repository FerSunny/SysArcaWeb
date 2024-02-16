<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$horario = $_POST['horario'];



$query = "
UPDATE no_horarios
SET 

  codigo = '$codigo',
  desc_horario = '$horario',

  fecha_actualiza =now()

WHERE `id_horario` = $pro;
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






































































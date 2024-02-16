<?php 





session_start();

include ("../../controladores/conex.php");









$codigo  = $_POST['codigo'];



$temperatura = $_POST['temperatura'];

$valor_c = $_POST['valor_c']; 

$equipo = $_POST['equipo']; 



$query = "
UPDATE iq_temperaturas
SET 
  fk_id_equipo = '$equipo',
  temperatura = $temperatura,
  valor_correccion = $valor_c,
  valor_corregido = ($temperatura-$valor_c)
WHERE id_temperatura = $codigo
";




$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo.$query;

}

$conexion->close();



?>






































































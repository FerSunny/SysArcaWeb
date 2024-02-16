<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$nota = $_POST['nota'];

$costo = $_POST['costo']; 

$gasto = $_POST['gasto']; 

$cajero = $_POST['cajero']; 



$query = "
UPDATE `ga_ingreso`
SET 
  `fk_id_usuario_caj` = $cajero,
  `fk_id_gasto` = $gasto,
  `importe` = $costo,
  `nota` = '$nota'
WHERE `id_ingreso` = $pro;

";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































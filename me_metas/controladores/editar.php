<?php 


session_start();
include ("../../controladores/conex.php");




$codigo  = $_POST['codigo'];

$anio  = $_POST['anio'];
$mes   = $_POST['mes'];

$importe = $_POST['importe'];

$notas = $_POST['notas']; 

$sucursal = $_POST['sucursal'];

$query = "
UPDATE me_metas
SET 
  fk_id_sucursal = $sucursal,
  anio = $anio,
  fk_id_mes = $mes,
  notas = $notas,
  importe = $importe
WHERE id_meta = $codigo
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



































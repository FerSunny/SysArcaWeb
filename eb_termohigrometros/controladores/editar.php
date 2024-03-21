<?php 

session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];


$fk_id_equipo       = $_POST['fk_id_equipo'];
$fecha_calibracion  = $_POST['fecha_calibracion'];
$duracion           = $_POST['duracion']; 

$temp_calibra       = $_POST['temp_calibra']; 
$humedad            = $_POST['humedad']; 
$exactitud          = $_POST['exactitud']; 

$fk_id_proveedor    = $_POST['fk_id_proveedor']; 

$temp_refere_1      = $_POST['temp_refere_1']; 
$valor_medido_1     = $_POST['valor_medido_1'];
$correccion_1       = $_POST['correccion_1'];
$incertidumbre_1    = $_POST['incertidumbre_1'];

$temp_refere_2      = $_POST['temp_refere_2']; 
$valor_medido_2     = $_POST['valor_medido_2'];
$correccion_2       = $_POST['correccion_2'];
$incertidumbre_2    = $_POST['incertidumbre_2'];

$temp_refere_3      = $_POST['temp_refere_3']; 
$valor_medido_3     = $_POST['valor_medido_3'];
$correccion_3       = $_POST['correccion_3'];
$incertidumbre_3    = $_POST['incertidumbre_3'];


$query = "
UPDATE  eb_termohigrometros 
SET   
   fk_id_equipo  = $fk_id_equipo,
   fecha_calibracion  = '$fecha_calibracion',
   duracion  = '$duracion',
   temp_calibra  = '$temp_calibra',
   humedad  = '$humedad',
   exactitud  = '$exactitud',
   fk_id_proveedor  = '$fk_id_proveedor',
   temp_refere_1  = '$temp_refere_1',
   valor_medido_1  = '$valor_medido_1',
   correccion_1  = '$correccion_1',
   incertidumbre_1  = '$incertidumbre_1',
   temp_refere_2  = '$temp_refere_2',
   valor_medido_2  = '$valor_medido_2',
   correccion_2  = '$correccion_2',
   incertidumbre_2  = '$incertidumbre_2',
   temp_refere_3  = '$temp_refere_3',
   valor_medido_3  = '$valor_medido_3',
   correccion_3  = '$correccion_3',
   incertidumbre_3  = '$incertidumbre_3'
WHERE  id_termohigrometros  = '$codigo'
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






































































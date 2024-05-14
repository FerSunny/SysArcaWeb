<?php 





session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario= $_SESSION['id_usuario'];


$codigo  = $_POST['codigo'];

$fk_id_equipo = $_POST['fk_id_equipo'];
$temperatura = $_POST['temperatura']; 


$query = "
UPDATE  iq_mediciones 
SET   
   fk_id_sucursal  = '$sucursal',
   fk_id_equipo  = '$fk_id_equipo',
   temperatura  = '$temperatura',
   fk_id_usuario  = '$id_usuario',
   valor_corregido  = '$temperatura'
WHERE  id_temperatura  = '$codigo';
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






































































<?php 


session_start();
include ("../../controladores/conex.php");



$codigo = $_POST['codigo'];
$origen  = $_POST['origen'];

     
$query ="
UPDATE km_estudios
SET fk_id_estudio_ori = '$origen'
WHERE id_estudio = $codigo
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
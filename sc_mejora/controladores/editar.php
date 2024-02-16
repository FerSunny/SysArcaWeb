<?php 





session_start();

include ("../../controladores/conex.php");

$id_usuario = $_SESSION['id_usuario'];



$codigo  = $_POST['codigo'];

$situacion = $_POST['situacion'];

$origen = $_POST['origen']; 

$area = $_POST['area']; 

$causas = $_POST['causas']; 

$objetivo = $_POST['objetivo']; 

$doc = $_POST['doc']; 

$cual = $_POST['cual'];



$query = "
UPDATE sc_mejora_pro
SET 
  situacion = '$situacion',
  origen = '$origen',
  fk_id_area = $area,
  causas = '$causas',
  objetivo = '$objetivo',
  fk_id_boleana = '$doc',
  cual = '$cual',
  fecha_actualiza = NOW(),
  fk_id_usuario_up = $id_usuario
WHERE `id_mejora` = $codigo;
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






































































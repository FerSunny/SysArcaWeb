<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_agenda = $_POST['id_agenda'];
$fk_id_medico = $_POST['fn_medico'];
$fecha = $_POST['fn_fecha'];
$hora = $_POST['fn_hora'];


//$fi_factualiza = $_POST['fn_factualiza'];
$estado = $_POST['estado'];
$fi_factualiza=date("y/m/d :H:i:s");

$query = "
UPDATE `vm_agenda`
SET 
  
  
  `fk_id_medico` = '$fk_id_medico',
  `fecha` = '$fecha',
  `hora` = '$hora',
  `estado` = '$estado'
WHERE `id_agenda` = '$id_agenda'
";

//echo $query;

$result = $conexion->query($query);

//echo $query;
if ($result) {
	$bien = 1;
    echo $bien;

}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();


 ?>

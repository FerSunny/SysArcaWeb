<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$fk_id_medico= $_SESSION['fk_id_medico'];

$id_hoja = $_POST['id_hoja'];
$edovisita = $_POST['fn_edovisita'];
$participa = $_POST['fn_participa'];
$publicidad = $_POST['fn_publicidad'];

$ordenes_i = $_POST['fn_ordenes_i'];
$ordenes_f = $_POST['fn_ordenes_f'];

$mail = $_POST['fn_mail'];
$ce = $_POST['fn_ce'];
$quejas = $_POST['fn_quejas'];
$sugiere = $_POST['fn_sugiere'];
$observaciones = $_POST['fn_observaciones'];
$falta = $_POST['fn_falta'];
$halta = $_POST['fn_halta']; 
$factualiza = date("yy/m/d H:i:s");
$estado = $_POST['estado_reg'];

$query = "
UPDATE `vm_hoja_visita`
SET 
  `id_hoja` = '$id_hoja',
  `fk_id_medico` = '$fk_id_medico',
  `fk_id_estado_visita` = '$edovisita',
  `participaciones` = '$participa',
  `publicidad` = '$publicidad',
  `ordenes_fi` = '$ordenes_i',
  `ordenes_ff` = '$ordenes_f',
  `quejas` = '$quejas',
  `observaciones` = '$observaciones',
  `sugerencias` = '$sugiere',
  `mail_resultados` = '$mail',
  `consulta_externa` = '$ce',
  `fecha_visita` = '$falta',
  `hora_visita` = '$halta',
  `fecha_actualiza` = '$factualiza',
  `estado` = '$estado'
WHERE `id_hoja` = '$id_hoja'";

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

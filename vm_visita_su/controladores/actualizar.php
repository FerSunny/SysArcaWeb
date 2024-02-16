<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');
$id_usuario=$_SESSION['id_usuario'];
$fk_id_medico= $_SESSION['fk_id_medico'];

$id_hoja = $_POST['id_hoja'];

$constante = $_POST['constante'];
$agradable = $_POST['agradable'];
$informacion = $_POST['informacion'];
$tiempo = $_POST['tiempo'];

$categoria = $_POST['categoria'];
$observaciones = $_POST['observaciones'];
$edovisita = $_POST['edovisita'];
$participaciones = $_POST['participaciones'];
$vm = $_POST['vm'];

$query = "
UPDATE `vm_hoja_visita_sup`
SET
  
  `fk_id_usuario_vm` = '$vm',
  `fk_id_medico` = '$fk_id_medico',
  `fk_id_estado_visita` = '$edovisita',
  `visita_mensual` = '$constante',
  `visita_agrado` = '$agradable',
  `satisfecho_informacion` = '$informacion',
  `tiempo_forma` = '$tiempo',
  `motivo_categoria` = '$categoria',

  `participaciones` = '$participaciones',

  `observaciones` = '$observaciones'

WHERE `id_hoja_visita_sup` = '$id_hoja'
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

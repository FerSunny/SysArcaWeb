<?php
session_start();
include("../../controladores/conex.php");
$id_usuario = $_SESSION['id_usuario'];
date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$fk_id_medico = $_POST['fn_medico'];
$fecha = $_POST['fn_fecha'];
$hora = $_POST['fn_hora'];


//$fi_factualiza = $_POST['fn_factualiza'];
$estado = $_POST['estado'];
$fi_factualiza=date("y/m/d :H:i:s");



$query= "
INSERT INTO `vm_agenda`
            (`fk_id_empresa`,
             `id_agenda`,
             `fk_id_usuario`,
             `fk_id_medico`,
             `fecha`,
             `hora`,
             `estado`)
VALUES ('$empresa',
        0,
        '$id_usuario',
        '$fk_id_medico',
        '$fecha',
        '$hora',
        '$estado')
";
// echo $query;

$result = $conexion -> query($query);
if($result){
	echo 1;
}
else{
	$codigo = mysqli_errno($conexion);
	echo $codigo;
}
$conexion->close();

?>

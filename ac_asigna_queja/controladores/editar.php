<?php 





session_start();

include ("../../controladores/conex.php");
include("../../emails/multiple.php");

$id_usuario = $_SESSION['id_usuario'];


$codigo  = $_POST['codigo'];



$si_no = $_POST['si_no'];

$fecha_asignacion = $_POST['fecha_asignacion']; 

$sucursal = $_POST['sucursal']; 

$servicio = $_POST['servicio']; 

$inconformidad = $_POST['inconformidad'];

$observaciones=$_POST['observaciones'];

$estatus=$_POST['estatus'];

$noprocede=$_POST['noprocede'];
$identifica=$_POST['identifica'];

$query = "
UPDATE `ac_quejas`
SET
  
  fk_id_procede = $si_no,
  fecha_asignacion = '$fecha_asignacion',
  fk_id_sucursal_asigna = $sucursal,
  fk_id_servicio = $servicio,
  descripcion = '$inconformidad',
  observaciones = '$observaciones',
  fk_id_usuario_asigna = $id_usuario,
  fk_id_estatus = $estatus,
  motivo_no_procede = '$noprocede',
  fecha_asignacion = NOW(),
  fk_id_identifica = $identifica
WHERE id_queja = $codigo;
";

$result = $conexion -> query($query);

if ($result) {
  $atach = '';
  $asunto="Se ha asignado una queja a traves del SYSARCAWEB";
  $contenido="Queja: ".$inconformidad."<br>"."Acciones: ".$noprocede;
  //echo $asunto;
  //echo $contenido;
	$regreso = multiple(5,$sucursal,$atach,$asunto,$contenido); //destinatario,id,adjunto,mensaje,contenido

  echo $regreso;
   // echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>






































































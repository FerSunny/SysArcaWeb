<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
include ("../../controladores/conex.php");


$emresa = 1;
$sucursal = $_SESSION['fk_id_sucursal'];
$usuario = $_SESSION['id_usuario'];
$observ = $_POST['observ'];
$fecha = date("Y-m-d H:i:s");


	$stmt = $conexion->prepare("INSERT INTO situacion_resultados (
		  	fk_id_empresa,
	  		fk_id_sucursal,
	  		fk_id_usuario,
	  		observaciones,
	  		fecha_registro) VALUES(?,?,?,?,?)");
	$stmt->bind_param('iiiss', $emresa, $sucursal, $usuario, $observ, $fecha);

	if ($stmt->execute())
	{
		echo 1;	
	}else
	{
		$codigo = mysqli_errno($conexion); 
  		echo $codigo;
	}
	$stmt->close();
?>

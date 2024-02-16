<?php

// Conexion a la base de datos
include ("../../controladores/conex.php");
session_start();
	$empresa = 1;
	$sucursal = $_SESSION['fk_id_sucursal'];
	$iduser = $_SESSION['id_usuario'];
	$title = $_POST['title'];
	$notas = $_POST['notas'];
	$start = $_POST['start'];
	$start_t = $_POST['start-time'];
	$end = $_POST['end'];
	$end_t = $_POST['end-time'];
	$color = $_POST['color-fecha'];
	$user_af = 0;//$_POST['user_af'];
	$dia_f = $_POST['dia_f'];
	
	$stmt = $conexion->prepare("INSERT INTO kg_festivos(fk_id_empresa,fk_id_sucursal,fk_id_usuario,title,notas,start,start_time,end,end_time,color,afecta_usuario,dia_festivo) values (?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param('iiisssssssii', $empresa, $sucursal, $iduser, $title, $notas, $start,$start_t, $end, $end_t ,$color, $user_af, $dia_f);
		$result = $stmt->execute();
		$stmt->close();

	if($result)
	{
		echo 1;
	}else
	{
		$codigo = mysqli_errno($conexion); 
    	echo $codigo;
	}

	
?>

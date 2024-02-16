<?php
session_start();
date_default_timezone_set('America/Mexico_City');


require_once ("../../so_factura/config/db.php");
require_once ("../../so_factura/config/conexion.php");

$id_factura = $_POST['factura'];
$fk_id_estudio = $_POST['estudio'];

$query = "SELECT COUNT(*) as validado FROM cr_plantilla_usg_re
WHERE fk_id_factura=$id_factura AND fk_id_estudio=$fk_id_estudio";
	
	$result = $con -> query($query);

	$row = $result->fetch_assoc();

	if($row['validado'] == '')
	{
		$val = 0;
		$miArray = array("val" => $val);
	}else
	if($row['validado'] == 0 || $row['validado'] == null)
	{
		$val = 1;
		$miArray = array("val" => $val);
	}else
	if($row['validado'] == 1)
	{
		$val = 2;
		$miArray = array("val" => $val);
	}else
	{
		$val = 3;
		$miArray = array("val" => $val);
	}

	echo json_encode($miArray);

	$con->close();


 ?>
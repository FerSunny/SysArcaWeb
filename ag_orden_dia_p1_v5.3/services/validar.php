<?php
session_start();
date_default_timezone_set('America/Mexico_City');


require_once ("../../so_factura/config/db.php");
require_once ("../../so_factura/config/conexion.php");

$id_factura = $_POST['id_factura'];
$fk_id_estudio = $_POST['fk_id_estudio'];

$query = "SELECT validado FROM cr_plantilla_1_re
WHERE fk_id_factura=$id_factura AND fk_id_estudio=$fk_id_estudio";
	
	$result = $con -> query($query);

	$row = $result->fetch_assoc();

	if($row['validado'] == null || $row['validado'] == 0)
	{
		$val = 0;
		$miArray = array("var" => $val);
	}else
	{
		$val = $row['validado'];
		$miArray = array("var" => $val);
	}

	echo json_encode($miArray);

	$con->close();


 ?>
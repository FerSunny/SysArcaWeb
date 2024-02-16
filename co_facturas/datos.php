<?php

include '../controladores/conex.php';

$tipo = $_GET['tipo'];
$f_inicio = $_GET['f_inicio'];
$f_final = $_GET['f_final'];
$grupo = $_GET['grupo'];

	if($tipo == 1)
	{
		;
	}else
	if($tipo == 2)
	{
		$query = "";
	}else
	if($tipo == 3)
	{
		$query = "";
	}else
	{
		$quer = "";
	}

		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	$data[] = $row;

	    }
	$results = array(
	"sEcho" => 1,
	"iTotalRecords" => count($data),
	"iTotalDisplayRecords" => count($data),
	"aaData"=>$data);
	echo json_encode($results);

 ?>
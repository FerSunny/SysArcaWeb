<?php

require './ajax/querys.php';

$ejecutar = new Query();

switch ($tipo = $_GET['tipo']) {
	case '0':
		$data = $ejecutar->query();
		break;
	case '1':
		$data = $ejecutar->query_ingresos($_GET['f_inicio'],$_GET['f_final'],$_GET['grupo']);
		break;
	case '2':
		$data = $ejecutar->query_egresos($_GET['f_inicio'],$_GET['f_final']);
		break;
	case '3':
		$data = $ejecutar->query_facturas($_GET['f_inicio'],$_GET['f_final'],$_GET['grupo']);
		break;
	case '4':
		$data = $ejecutar->query_detalle_ingresos($_GET['tp'],$_GET['fi'],$_GET['ff'],$_GET['grupo']);
		break;
	case '5':
		$data = $ejecutar->query_detalle_egresos($_GET['tp'],$_GET['fi'],$_GET['ff'],$_GET['grupo']);
		break;
	case '6':
		$data = $ejecutar->query_detalle_facturas($_GET['tp'],$_GET['fi'],$_GET['ff'],$_GET['grupo']);
		break;
	default:
		# code...
		break;
}


	$results = array(
	//Se utiliza datatables y le tenemos que enviar informacion
	"sEcho" => 1, //Informacion para el datatables
	"iTotalRecords" => count($data),//Enviamos el total de registros al datatable
	"iTotalDisplayRecords" => count($data), //Enviamos el total de registros a visualizar
	"aaData" => $data);
echo json_encode($results);


 ?>
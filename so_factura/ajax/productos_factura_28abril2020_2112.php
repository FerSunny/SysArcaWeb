<?php

	date_default_timezone_set('America/Mexico_City');
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	//Lista todas las facturas
	if($action == 'ajax'){
//que el status e
		  $sTable = "km_estudios";

			$sql="SELECT * FROM  $sTable where estatus='A' ";
			$resultado = mysqli_query($con, $sql);


			$arreglo["data"] = [];
			if ($resultado){
				while($data=mysqli_fetch_assoc($resultado)){
						$arreglo["data"][]=array_map("utf8_encode",$data);
				}
				mysqli_close($con);
				echo json_encode($arreglo);
			}else {
				mysqli_close($con);
				echo json_encode($arreglo);
			}
	}
?>

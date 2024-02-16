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

			$sql="SELECT es.* FROM km_estudios es, kg_promociones pr
WHERE es.`fk_id_promosion` = pr.`id_promocion`
AND pr.estado = 'A'
AND es.`estatus` = 'A'
AND es.grupo_estudio in (0,1)
AND ((CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_final) OR es.`fk_id_promosion` = 7)";
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

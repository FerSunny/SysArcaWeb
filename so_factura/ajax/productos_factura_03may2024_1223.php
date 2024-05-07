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
AND substr(es.desc_estudio,1,5) <> 'MAQDN' 
AND ((CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_final) OR es.`fk_id_promosion` = 7)
/*
AND es.id_estudio not in (
	151, 152, 153, 904, 905, 625, 307, 314, 628, 275, 301, 304, 876, 1155, 486, 274, 
	616, 586, 587, 217, 410, 870, 622, 412, 632, 640, 235, 720, 886, 731, 585, 
	566, 528, 130, 749, 1997, 1120, 1122, 1121, 1124, 678, 679, 661, 663, 646, 645, 
	2137, 680, 848,494
	)
*/*
";
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

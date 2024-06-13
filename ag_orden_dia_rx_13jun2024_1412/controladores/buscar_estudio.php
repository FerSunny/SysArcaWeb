<?php 
date_default_timezone_set('America/Chihuahua');
include "../../controladores/conex.php";
	$fac = $_POST["val"];
	$est = $_POST["val2"];

	$query = "SELECT rusg.fk_id_factura, rusg.fk_id_estudio, e.desc_estudio, rusg.fk_id_plantilla, pusg.nombre_plantilla, rusg.titulo_desc, rusg.descripcion, rusg.firma
		FROM cr_plantilla_rx_re rusg
		INNER JOIN km_estudios e
		ON e.id_estudio=rusg.fk_id_estudio
		INNER JOIN cr_plantilla_rx pusg
		ON pusg.id_plantilla=rusg.fk_id_plantilla
		WHERE rusg.estado='A' AND rusg.fk_id_factura = $fac AND rusg.fk_id_estudio = $est";


		$arreglo = array();
	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);

 ?>
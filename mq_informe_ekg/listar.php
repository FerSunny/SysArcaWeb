<?php

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

	$query = "
	SELECT 	YEAR(ek.`fecha_registro`) AS anioestudio,
			MONTHNAME(ek.`fecha_registro`) AS mesestudio,
			COUNT(DISTINCT fk_id_factura) notas
	FROM cr_plantilla_ekg_re ek
	WHERE ek.`estado` = 'A'
	AND ek.fecha_registro >= '2021-01-01'
	GROUP BY 
	YEAR(ek.`fecha_registro`),
	MONTHNAME(ek.`fecha_registro`)
  ";

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);

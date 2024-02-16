<?php

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

	$query = "
  SELECT 	YEAR(fa.`fecha_factura`) AS anioestudio,
	MONTHNAME(fa.`fecha_factura`) AS mesestudio,
	COUNT(DISTINCT fa.id_factura) notas
FROM so_factura fa, so_detalle_factura df, km_estudios es
	WHERE fa.estado_factura  <> 5
	AND fa.`fecha_factura` >= '2021-01-01'
	AND fa.`id_factura` = df.`id_factura`
	AND df.`fk_id_estudio` = es.`id_estudio`
	AND es.`fk_id_plantilla` = 4
	GROUP BY 
	YEAR(fa.`fecha_factura`),
	MONTHNAME(fa.`fecha_factura`)
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

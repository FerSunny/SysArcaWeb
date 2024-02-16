<?php

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

	$query = "
  SELECT 	YEAR(fa.`fecha_factura`) AS anioestudio,
	MONTHNAME(fa.`fecha_factura`) AS mesestudio,
	COUNT(fa.id_factura) notas
FROM so_factura fa
	WHERE fa.estado_factura  <> 5
	AND fa.`fecha_factura` >= '2021-01-01'
	GROUP BY YEAR(fa.`fecha_factura`), MONTHNAME(fa.`fecha_factura`)
  ";

//echo $query;

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

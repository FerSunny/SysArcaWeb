<?php

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

	$query = "
  SELECT  DATE(fa.`fecha_factura`) AS fecha,
	df.id_factura,
	es.`iniciales`,
	pl.`desc_plantilla`,
	su.`desc_corta`,
	CASE
		WHEN es.`fk_id_plantilla` = 1 THEN
			(SELECT MAX(p1.fecha_registro) FROM cr_plantilla_1_re p1
			WHERE p1.fk_id_factura = fa.id_factura
			AND p1.fk_id_estudio = df.fk_id_estudio)
	END AS registrado,

	CASE
		WHEN es.`fk_id_plantilla` = 1 THEN
			(SELECT MAX(p1.fecha_hora_entregada) FROM cr_plantilla_1_re p1
			WHERE p1.fk_id_factura = fa.id_factura
			AND p1.fk_id_estudio = df.fk_id_estudio)
	END AS entregado	
	

FROM so_detalle_factura df,
	so_factura fa,
	km_estudios es,
	cr_plantillas pl,
	kg_sucursales su
WHERE df.`id_factura` = fa.`id_factura` 
AND df.`fk_id_estudio` = es.`id_estudio`
AND es.`fk_id_plantilla` = pl.`id_plantilla`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND fa.fecha_factura BETWEEN DATE_SUB(CURDATE(), INTERVAL 20 DAY) AND DATE_ADD(CURDATE(), INTERVAL 20 DAY)
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
